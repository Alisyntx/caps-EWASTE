<?php
include '../../../../database/conn.php';
$id = $_POST['itemId'];
$sql = 'DELETE FROM tbl_ewst WHERE ewst_id = ?';
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $id);

$response = [];
if ($stmt->execute()) {
    $response = [
        'scs' => true,
        'msg' => 'deleted !!'
    ];
} else {
    $response = [
        'scs' => false,
        'msg' => 'not deleted'
    ];
}


header('Content-Type: application/json');
echo json_encode($response);
