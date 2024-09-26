<?php
include '../../../../database/conn.php';

$ctyname = $_POST['cty'];
$response = [];

$insqry = "INSERT INTO tbl_category (cty_name) VALUES (?)";
$istmt = $conn->prepare($insqry);
if ($istmt->execute([$ctyname])) {
    $newCategoryId = $conn->insert_id; // Get the ID of the newly inserted category
    $response = [
        'scs' => true,
        'msg' => 'Category Added !!',
        'cty_id' => $newCategoryId,
        'cty_name' => $ctyname
    ];
} else {
    $response = [
        'scs' => false,
        'msg' => 'Failed to add category'
    ];
}

header('Content-Type: application/json');

// Echo the JSON-encoded response
echo json_encode($response);
