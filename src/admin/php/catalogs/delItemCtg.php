<?php
include '../../../../database/conn.php';
$id = $_POST['delItemId'];
$sql = 'DELETE FROM tbl_rwd_items WHERE rwd_id = ?';
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
