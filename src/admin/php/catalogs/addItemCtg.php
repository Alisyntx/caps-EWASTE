<?php
include '../../../../database/conn.php';

$rwd_name = $_POST['itemName'];
$rwd_ctgFk = $_POST['ctgId'];
$rwd_points = $_POST['rPoints'];
$rwd_desc = $_POST['rwdDesc'];

$response = [];

// Handle the image upload
if (
    isset($_FILES['itemImage']) && $_FILES['itemImage']['error'] === UPLOAD_ERR_OK
) {
    $img_name = $_FILES['itemImage']['name'];
    $img_tmp = $_FILES['itemImage']['tmp_name'];
    $img_ext = strtolower(pathinfo($img_name, PATHINFO_EXTENSION));

    // Validate file type
    $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
    if (in_array($img_ext, $allowed_extensions)) {
        // Set a unique name for the image
        $img_new_name = uniqid("IMG_", true) . '.' . $img_ext;
        $upload_dir = 'C:/xampp/htdocs/ewasteCapstone/storage/'; // Ensure this directory exists and is writable
        $upload_file = $upload_dir . $img_new_name;

        if (move_uploaded_file($img_tmp, $upload_file)) {
            // Image upload successful, now insert the data into the database
            $sql = "INSERT INTO tbl_rwd_items (rwd_name, rwd_img, rwd_ctg, rwd_points, rwd_desc) VALUES (?, ?, ?, ?,?)";
            $stmt = $conn->prepare($sql);

            if ($stmt) {
                $stmt->bind_param("ssiis", $rwd_name, $img_new_name, $rwd_ctgFk, $rwd_points, $rwd_desc);

                if ($stmt->execute()) {
                    $newItemQuery = "SELECT * FROM tbl_rwd_items WHERE rwd_name = ? AND rwd_img = ?";
                    $stmtNewItem = $conn->prepare($newItemQuery);
                    $stmtNewItem->bind_param("ss", $rwd_name, $img_new_name);
                    $stmtNewItem->execute();
                    $newItem = $stmtNewItem->get_result()->fetch_assoc();
                    $stmtNewItem->close();

                    // Generate HTML for the new item

                    $response = [
                        'scs' => true,
                        'msg' => 'successfully Added !!',
                        'rwdName' => $newItem['rwd_name'],
                        'rwdImg' => $newItem['rwd_img'],
                        'rwdPoints' => $newItem['rwd_points'],
                        'rwdCtgFk' => $rwd_ctgFk,
                        'rwdDesc' => $rwd_desc,
                        'rwdId' => $newItem['rwd_id']
                    ];
                } else {
                    $response = [
                        'scs' => false,
                        'msg' => 'Error inserting data'
                    ];
                }
                $stmt->close();
            } else {
                $response = [
                    'scs' => false,
                    'msg' => 'Failed to prepare statement'
                ];
            }
        } else {
            $response = [
                'scs' => false,
                'msg' => 'Failed to move uploaded file'
            ];
        }
    } else {
        $response = [
            'scs' => false,
            'msg' => 'Invalid file type. Please upload an image'
        ];
    }
} else {
    $response = [
        'scs' => false,
        'msg' => 'No image uploaded or there was an upload error'
    ];
}

$conn->close();
header('Content-Type: application/json');

// Echo the JSON-encoded response
echo json_encode($response);
