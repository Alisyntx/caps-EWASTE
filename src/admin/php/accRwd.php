<?php
require_once '../../../database/conn.php';

// Retrieve the POST data
$rqsId = $_POST['akoSiID'];
$usrId = $_POST['userId'];
$rqsPoints = $_POST['points'];

// Start a transaction
$conn->begin_transaction();

try {
    // Retrieve the current points of the user
    $userPointsResult = $conn->query("SELECT usr_rwd FROM tbl_user WHERE usr_id = '$usrId'");
    if ($userPointsResult->num_rows > 0) {
        $userPointsRow = $userPointsResult->fetch_assoc();
        $currentPoints = $userPointsRow['usr_rwd'];

        // Calculate the new points
        $newPoints = $currentPoints - $rqsPoints;

        // Update the user's points
        $updateUserPoints = $conn->query("UPDATE tbl_user SET usr_rwd = '$newPoints' WHERE usr_id = '$usrId'");
        if (!$updateUserPoints) {
            throw new Exception("Failed to update user points: " . $conn->error);
        }

        // Delete the request
        $deleteRequest = $conn->query("DELETE FROM tbl_request WHERE rqs_id = '$rqsId'");
        if (!$deleteRequest) {
            throw new Exception("Failed to delete request: " . $conn->error);
        }

        // Commit the transaction
        $conn->commit();

        // Return success response
        echo json_encode(['status' => 'success', 'message' => 'Successfully Approve this Request']);
    } else {
        throw new Exception("User not found");
    }
} catch (Exception $e) {
    // Rollback the transaction
    $conn->rollback();

    // Return error response
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
