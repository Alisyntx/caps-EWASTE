<?php 
// Include the database connection (MySQLi connection)
include '../../../../database/conn.php';

// Set the timezone to Philippine Time (PHT)
date_default_timezone_set('Asia/Manila');

// Get the current date and time
$currentDateTime = date('Y-m-d H:i:s'); // Format: YYYY-MM-DD HH:MM:SS

// Collect POST data
$rwdId = $_POST['rwdId'];// this is pending id
$prdId = $_POST['prdId'];//this item id
$rwdUser = $_POST['userId'];
$reason = empty($reason) ? 'There is a problem with this transaction.' : $reason;
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
        $stg_username = $pendingItem['usr_usrname'];
        $stg_transaction = 'Declined';
        $stg_activity = 'Redeem Declined';

        // Step 2: Log decline action into tbl_rcnt_hry
        $historyQuery = "INSERT INTO tbl_rcnt_hry (hry_rcy_item, hry_activity, hry_rcy_date, hry_user, hry_user_id, hry_transac, hry_decline_mess) VALUES (?, ?, ?, ?, ?, ?, ?)";
        if ($hstmt = $conn->prepare($historyQuery)) {
            $hstmt->bind_param('sssisss', $stg_itemname, $stg_activity, $currentDateTime, $stg_name, $rwdUser, $stg_transaction, $reason);

            if ($hstmt->execute()) {
                // Step 3: Delete the declined item from tbl_predeems
                $delqry = "DELETE FROM tbl_predeems WHERE prd_id = ?";
                if ($dstmt = $conn->prepare($delqry)) {
                    $dstmt->bind_param('i', $rwdId);

                    if ($dstmt->execute()) {
                        $response = [
                            'scs' => true,
                            'itemId' => $rwdId,
                            'msg' => 'declined successfully.'
                        ];
                    } else {
                        $response = [
                            'scs' => false,
                            'msg' => 'Failed to delete declined item from pending list.'
                        ];
                    }
                }
            } else {
                $response = [
                    'scs' => false,
                    'msg' => 'Failed to log decline in history.'
                ];
            }
            $hstmt->close();
        } else {
            $response = [
                'scs' => false,
                'msg' => 'Failed to prepare history insert query for decline.'
            ];
        }
    } else {
        $response = [
            'scs' => false,
            'msg' => 'Pending item not found.'
        ];
    }
    $pstmt->close();
} else {
    $response = [
        'scs' => false,
        'msg' => 'Failed to prepare pending item query.'
    ];
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($response);

?>
