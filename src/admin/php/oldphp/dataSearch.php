<?php
include '../../../database/conn.php';
$term = $_GET['term'];
$query = "SELECT * FROM tbl_user WHERE usr_fname LIKE '%$term%' OR usr_lname LIKE '%$term%'";
$result = $conn->query($query);

// Prepare data in JSON format
$data = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = array(
            'id' => $row['usr_id'], // Include the ID in the response
            'value' => $row['usr_fname'] . ' ' . $row['usr_lname'] // The value shown in the autocomplete suggestion
        );
    }
}
$conn->close();
// Return JSON data
header('Content-Type: application/json');
echo json_encode($data);
// Close connection
