<?php
require_once '../../../database/conn.php';

// Retrieve and sanitize POST data
$user = $conn->real_escape_string($_POST['user']);
$category = $conn->real_escape_string($_POST['category']);
$info = $conn->real_escape_string($_POST['info']);
$condition = $conn->real_escape_string($_POST['condition']);
$points = intval($_POST['points']); // Ensure points is an integer
// Prepare the response array
$response = array();

// Start transaction
$conn->begin_transaction();

try {
    // Insert into tbl_ewst
    $sql = "INSERT INTO tbl_ewst (ewst_userfk, ewst_ctyfk, ewst_name, ewst_cdtnfk, ewst_points) 
            VALUES ('$user', '$category', '$info', '$condition', '$points')";

    if ($conn->query($sql) === TRUE) {
        // Fetch the current points from tbl_user
        $select_sql = "SELECT usr_rwd FROM tbl_user WHERE usr_id = '$user'";
        $result = $conn->query($select_sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $current_points = intval($row['usr_rwd']);
            $new_points = $current_points + $points;

            // Update the points in tbl_user
            $update_sql = "UPDATE tbl_user SET usr_rwd = '$new_points' WHERE usr_id = '$user'";

            if ($conn->query($update_sql) === TRUE) {
                // Commit transaction
                $conn->commit();

                // Insertion and update successful
                $response = [
                    'msg' => 'Record inserted and points updated successfully',
                    'test' => $user . $category . $info . $condition . $points,
                    'new_points' => $new_points
                ];
            } else {
                // Rollback transaction
                $conn->rollback();
                throw new Exception('Error updating points: ' . $conn->error);
            }
        } else {
            // Rollback transaction
            $conn->rollback();
            throw new Exception('User not found');
        }
    } else {
        // Rollback transaction
        $conn->rollback();
        throw new Exception('Error inserting record: ' . $conn->error);
    }
} catch (Exception $e) {
    $response = [
        'msg' => $e->getMessage(),
        'test' => $user . $category . $info . $condition . $points
    ];
}

// Set the content type to application/json
header('Content-Type: application/json');

// Echo the JSON-encoded response
echo json_encode($response);
