<?php
// Include the database connection (MySQLi connection)
include '../../../../database/conn.php';
// Set the timezone to Philippine Time (PHT)
date_default_timezone_set('Asia/Manila');

// Get the current date and time
$currentDateTime = date('Y-m-d H:i:s'); // Format: YYYY-MM-DD HH:MM:SS

$rcyId = $_POST['rcyId'];
$ewstId = $_POST['ewstId'];
$rcyUser = $_POST['userId'];
$reason = empty($reason) ? 'There is a problem with this transaction.' : $reason;
$response = [];

// Step 1: Fetch the pending item details based on the rcyId
$pendingQuery = "
    SELECT p.*, u.usr_fname, u.usr_usrname, u.usr_lname, e.ewst_name
    FROM tbl_pdonations p
    INNER JOIN tbl_user u ON p.pdn_user = u.usr_id
    INNER JOIN tbl_ewst e ON p.pdn_ewst = e.ewst_id
    WHERE p.pdn_id = ?
";

// Prepare the statement using MySQLi
if ($pstmt = $conn->prepare($pendingQuery)) {
    // Bind the parameters (the 'i' specifies that it's an integer)
    $pstmt->bind_param('i', $rcyId);

    // Execute the statement
    $pstmt->execute();

    // Get the result
    $result = $pstmt->get_result();

    if ($pendingItem = $result->fetch_assoc()) {
        // Step 2: Insert the decline message into tbl_rcnt_hry
        $stg_name = $pendingItem['usr_fname'] . ' ' . $pendingItem['usr_lname'];
        $stg_itemname = $pendingItem['ewst_name'];
        $stg_activity = 'Recycle Declined';
        
        // Insert into the history table tbl_rcnt_hry
        $historyQuery = "INSERT INTO tbl_rcnt_hry (hry_rcy_item, hry_activity, hry_rcy_date, hry_user, hry_user_id, hry_decline_mess) VALUES (?, ?, ?, ?, ?, ?)";

        if ($hstmt = $conn->prepare($historyQuery)) {
            // Bind parameters, including the current date and time for hry_rcy_date and the decline reason
            $hstmt->bind_param('ssssis', $stg_itemname, $stg_activity, $currentDateTime, $stg_name, $rcyUser, $reason);

            // Execute the insert into the history table
            if ($hstmt->execute()) {
                // Step 3: Delete the record from tbl_pdonations
                $delqry = "DELETE FROM tbl_pdonations WHERE pdn_id = ?";
                if ($dstmt = $conn->prepare($delqry)) {
                    $dstmt->bind_param('i', $rcyId);

                    // Execute the delete statement
                    if ($dstmt->execute()) {
                        $response = [
                            'scs' => true,
                            'itemId' => $rcyId,
                            'msg' => 'declined successfully!'
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
                    'msg' => 'Failed to insert decline message into history'
                ];
            }
        } else {
            $response = [
                'scs' => false,
                'msg' => 'History insert query preparation failed'
            ];
        }
    } else {
        // If no pending item was found with the provided rcyId
        $response = [
            'scs' => false,
            'msg' => 'Pending item not found'
        ];
    }

    // Close the statement
    $pstmt->close();
} else {
    $response = [
        'scs' => false,
        'msg' => 'Failed to prepare pending item query'
    ];
}

// Close the connection
$conn->close();

// Send the response back as JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
