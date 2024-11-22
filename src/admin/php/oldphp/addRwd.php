<?php
require_once '../../../database/conn.php';

// Retrieve and sanitize POST data
$info = $conn->real_escape_string($_POST['info']);
$points = intval($_POST['points']); // Ensure points is an integer

// Prepare the response array
$response = array();

// Start transaction
$conn->begin_transaction();

try {
    // Insert into tbl_catalog
    $sql = "INSERT INTO tbl_catalog (ctg_name, ctg_points) VALUES ('$info', '$points')";

    if ($conn->query($sql) === TRUE) {
        // Commit transaction
        $conn->commit();

        // Insertion successful
        $response = [
            'msg' => 'Record inserted successfully',
            'info' => $info,
            'points' => $points
        ];
    } else {
        // Rollback transaction
        $conn->rollback();
        throw new Exception('Error inserting record: ' . $conn->error);
    }
} catch (Exception $e) {
    // Rollback transaction in case of any error
    $conn->rollback();
    $response = [
        'msg' => $e->getMessage(),
        'info' => $info,
        'points' => $points
    ];
}

// Set the content type to application/json
header('Content-Type: application/json');

// Echo the JSON-encoded response
echo json_encode($response);
