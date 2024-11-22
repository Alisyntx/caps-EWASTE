<?php 
// Include the database connection (MySQLi connection)
include '../../../../database/conn.php';

// Set the timezone to Philippine Time (PHT)
date_default_timezone_set('Asia/Manila');

// Get the current date and time
$currentDateTime = date('Y-m-d H:i:s'); // Format: YYYY-MM-DD HH:MM:SS

// Collect POST data
$rwdId = $_POST['rwdId'];
$prdId = $_POST['prdId'];
$rwdUser = $_POST['userId'];
$reason = isset($_POST['reason']) ? $_POST['reason'] : 'redeemed';
$response = [];

// Step 1: Fetch the pending item details based on the prdId
$pendingQuery = "
    SELECT p.*, u.usr_fname, u.usr_usrname, u.usr_lname, r.rwd_name
    FROM tbl_predeems p
    INNER JOIN tbl_user u ON p.prd_user = u.usr_id
    INNER JOIN tbl_rwd_items r ON p.prd_rwd_id = r.rwd_id
    WHERE p.prd_id = ?
";

if ($pstmt = $conn->prepare($pendingQuery)) {
    $pstmt->bind_param('i', $rwdId);
    $pstmt->execute();
    $result = $pstmt->get_result();

    if ($pendingItem = $result->fetch_assoc()) {
        $stg_name = $pendingItem['usr_fname'] . ' ' . $pendingItem['usr_lname'];
        $stg_itemname = $pendingItem['rwd_name'];
        $stg_cdtn_points = $pendingItem['prd_points'];
        $stg_username = $pendingItem['usr_usrname'];
        $stg_refnum = $pendingItem['prd_ref'];
        $stg_transaction = 'Redeemed';
        $stg_activity = 'Redeem Accepted';
        
        // Insert into tbl_rwd_storage
        $insqry = "INSERT INTO tbl_rwd_storage (rwd_stg_user, rwd_stg_item, rwd_stg_username, rwd_stg_points, rwd_stg_trans, rwd_stg_dateAdd, rwd_stg_refnum) VALUES (?, ?, ?, ?, ?, ?, ?)";
        if ($istmt = $conn->prepare($insqry)) {
            $istmt->bind_param('sssisss', $stg_name, $stg_itemname, $stg_username, $stg_cdtn_points, $stg_transaction, $currentDateTime, $stg_refnum);
            if ($istmt->execute()) {                
                // Insert into tbl_rcnt_hry
                $historyQuery = "INSERT INTO tbl_rcnt_hry (hry_rcy_item, hry_activity, hry_rcy_pts, hry_rcy_date, hry_user, hry_user_id, hry_transac) VALUES (?, ?, ?, ?, ?, ?, ?)";
                if ($hstmt = $conn->prepare($historyQuery)) {
                    $hstmt->bind_param('ssissis', $stg_itemname, $stg_activity, $stg_cdtn_points, $currentDateTime, $stg_name, $rwdUser, $stg_transaction);
                    
                    if ($hstmt->execute()) {
                       $updateqry = "
                        UPDATE tbl_user 
                        SET usr_rwd = usr_rwd - ?
                        WHERE usr_id = ? AND usr_rwd >= ?
                    ";
                    if ($ustmt = $conn->prepare($updateqry)) {
                        $usr_id = $pendingItem['prd_user'];
                        $ustmt->bind_param('iii', $stg_cdtn_points, $usr_id, $stg_cdtn_points);

                        if ($ustmt->execute()) {
                            if ($ustmt->affected_rows > 0) { // Check if any rows were affected, meaning the user had enough points
                                // Step 5: Increment redeem count in tbl_rwd_items
                                $incrementQuery = "UPDATE tbl_rwd_items SET rwd_redeemed = rwd_redeemed + 1 WHERE rwd_id = ?";
                                if ($incStmt = $conn->prepare($incrementQuery)) {
                                    $incStmt->bind_param('i', $prdId);

                                    if ($incStmt->execute()) {
                                        // Step 6: Delete the record from tbl_predeems
                                        $delqry = "DELETE FROM tbl_predeems WHERE prd_id = ?";
                                        if ($dstmt = $conn->prepare($delqry)) {
                                            $dstmt->bind_param('i', $rwdId);

                                            if ($dstmt->execute()) {
                                                $response = [
                                                    'scs' => true,
                                                    'itemId' => $rwdId,
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
                                            'msg' => 'Failed to increment redeem count in tbl_rwd_items'
                                        ];
                                    }
                                } else {
                                    $response = [
                                        'scs' => false,
                                        'msg' => 'Increment query preparation failed'
                                    ];
                                }
                            } else {
                                $response = [
                                    'scs' => false,
                                    'msg' => 'Insufficient points for deduction'
                                ];
                            }
                        } else {
                            $response = [
                                'scs' => false,
                                'msg' => 'Failed to execute decrement query for user points'
                            ];
                        }
                    } else {
                        $response = [
                            'scs' => false,
                            'msg' => 'Failed to prepare decrement query for user points'
                        ];
                    }
                    }
                } else {
                    $response = [
                        'scs' => false,
                        'msg' => 'History query preparation failed'
                    ];
                }
            } else {
                $response = [
                    'scs' => false,
                    'msg' => 'Failed to execute insert query into tbl_rwd_storage'
                ];
            }
            $istmt->close();
        } else {
            $response = [
                'scs' => false,
                'msg' => 'Insert query preparation failed'
            ];
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

header('Content-Type: application/json');
echo json_encode($response);

?>