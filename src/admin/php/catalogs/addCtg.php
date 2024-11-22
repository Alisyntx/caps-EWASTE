<?php
include '../../../../database/conn.php';

$ctgname = $_POST['ctg'];
$response = [];

$insqry = "INSERT INTO tbl_catalog (ctg_name) VALUES (?)";
$istmt = $conn->prepare($insqry);
if ($istmt->execute([$ctgname])) {
    $newCatalogID = $conn->insert_id; // Get the ID of the newly inserted category
    $response = [
        'scs' => true,
        'msg' => 'Catalog Added !!',
        'ctg_id' => $newCatalogID,
        'ctg_name' => $ctgname
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
