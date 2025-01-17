<?php
// Include the database connection (MySQLi connection)
include '../../../../database/conn.php';

// Set the timezone to Philippine Time (PHT)
date_default_timezone_set('Asia/Manila');

// Get the current date and time
$currentDateTime = date('Y-m-d H:i:s'); // Format: YYYY-MM-DD HH:MM:SS

// Get POST data
$rcyId = $_POST['rcyId'];
$ewstId = $_POST['ewstId'];
$rcyUser = $_POST['userId'];
$ewstBrand = $_POST['ewstBrand'];

$response = [];

// Step 1: Fetch the pending item details based on the rcyId
$pendingQuery = "
    SELECT p.*, u.usr_fname, u.usr_usrname, u.usr_lname, e.ewst_name 
    FROM tbl_pdonations p
    INNER JOIN tbl_user u ON p.pdn_user = u.usr_id
    INNER JOIN tbl_ewst e ON p.pdn_ewst = e.ewst_id
    WHERE p.pdn_id = ?
";

if ($pstmt = $conn->prepare($pendingQuery)) {
    $pstmt->bind_param('i', $rcyId);
    $pstmt->execute();
    $result = $pstmt->get_result();

    if ($pendingItem = $result->fetch_assoc()) {
        // Data for tbl_storage
        $stg_name = $pendingItem['usr_fname'] . ' ' . $pendingItem['usr_lname'];
        $stg_itemname = $pendingItem['ewst_name'];
        $stg_cdtn_points = $pendingItem['pdn_cdtn_pts'];
        $stg_username = $pendingItem['usr_usrname'];
        $stg_condition = $pendingItem['pdn_cdtn'];
        $stg_refnum = $pendingItem['pdn_ref'];
        $stg_activity = 'Recycle Accepted';
        $stg_transaction = 'Recycled';

        // Step 2: Insert data into tbl_storage
        $insqry = "
            INSERT INTO tbl_storage (stg_user, stg_item, stg_usrname, stg_points, stg_userId, stg_ewstId, stg_refnum, stg_brand) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)
        ";

        if ($istmt = $conn->prepare($insqry)) {
            $istmt->bind_param(
                'sssiiiss',
                $stg_name,
                $stg_itemname,
                $stg_username,
                $stg_cdtn_points,
                $rcyUser,
                $ewstId,
                $stg_refnum,
                $ewstBrand
            );

            if ($istmt->execute()) {
                // Step 2.1: Insert into the history table tbl_rcnt_hry
                $historyQuery = "
                    INSERT INTO tbl_rcnt_hry (hry_rcy_item, hry_rcy_cdtn, hry_activity, hry_rcy_pts, hry_rcy_date, hry_user, hry_user_id, hry_transac, hry_refnum, hry_brand) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
                ";

                if ($hstmt = $conn->prepare($historyQuery)) {
                    $hstmt->bind_param(
                        'sssississs',
                        $stg_itemname,
                        $stg_condition,
                        $stg_activity,
                        $stg_cdtn_points,
                        $currentDateTime,
                        $stg_name,
                        $rcyUser,
                        $stg_transaction,
                        $stg_refnum,
                        $ewstBrand
                    );

                    if ($hstmt->execute()) {
                        // Step 3: Update user points in tbl_user
                        $updateqry = "
                            UPDATE tbl_user 
                            SET usr_rwd = usr_rwd + ?, usr_total_rwd = usr_total_rwd + ? 
                            WHERE usr_id = ?
                        ";

                        if ($ustmt = $conn->prepare($updateqry)) {
                            $usr_id = $pendingItem['pdn_user'];
                            $ustmt->bind_param('iii', $stg_cdtn_points, $stg_cdtn_points, $usr_id);

                            if ($ustmt->execute()) {
                                // Step 4: Increment column in tbl_ewst
                                $incrementQuery = "UPDATE tbl_ewst SET ewst_recycle = ewst_recycle + 1 WHERE ewst_id = ?";

                                if ($incStmt = $conn->prepare($incrementQuery)) {
                                    $incStmt->bind_param('i', $ewstId);

                                    if ($incStmt->execute()) {
                                        // Step 5: Delete from tbl_pdonations
                                        $delqry = "DELETE FROM tbl_pdonations WHERE pdn_id = ?";
                                        if ($dstmt = $conn->prepare($delqry)) {
                                            $dstmt->bind_param('i', $rcyId);

                                            if ($dstmt->execute()) {
                                                $response = [
                                                    'scs' => true,
                                                    'itemId' => $rcyId,
                                                    'msg' => 'Accepted, processed successfully!'
                                                ];
                                            } else {
                                                $response = [
                                                    'scs' => false,
                                                    'msg' => 'Failed to delete pending item'
                                                ];
                                            }
                                        }
                                    } else {
                                        $response = [
                                            'scs' => false,
                                            'msg' => 'Failed to increment column in tbl_ewst'
                                        ];
                                    }
                                }
                            } else {
                                $response = [
                                    'scs' => false,
                                    'msg' => 'Failed to update user points'
                                ];
                            }
                        }
                    } else {
                        $response = [
                            'scs' => false,
                            'msg' => 'Failed to insert into history table'
                        ];
                    }
                }
            } else {
                $response = [
                    'scs' => false,
                    'msg' => 'Failed to insert into tbl_storage'
                ];
            }
        }
    } else {
        $response = [
            'scs' => false,
            'msg' => 'Pending item not found'
        ];
    }

    $pstmt->close();
} else {
    $response = [
        'scs' => false,
        'msg' => 'Failed to prepare pending item query'
    ];
}

$conn->close();

// Return JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>
