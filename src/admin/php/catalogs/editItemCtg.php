<?php
include '../../../../database/conn.php';

$rwd_id = $_POST['itemId']; // Assuming you're passing the item ID for the update
$rwd_name = $_POST['itemCtgName'];
$rwd_ctgFk = $_POST['itemCtgId'];
$rwd_points = $_POST['ctgPointItem'];
$rwd_desc = $_POST['rwdDesc'];
$response = [];

// Handle the image upload
if (isset($_FILES['itemImage']) && $_FILES['itemImage']['error'] === UPLOAD_ERR_OK) {
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
            // Image upload successful, update the database record
            $sql = "UPDATE tbl_rwd_items SET rwd_name = ?, rwd_img = ?, rwd_desc = ?, rwd_points = ?, rwd_ctg = ? WHERE rwd_id = ?";
            $stmt = $conn->prepare($sql);

            if ($stmt) {
                $stmt->bind_param("sssiii", $rwd_name, $img_new_name, $rwd_desc, $rwd_points, $rwd_ctgFk, $rwd_id);

                if ($stmt->execute()) {
                    $response = [
                        'scs' => true,
                        'msg' => 'Successfully updated !!',
                        'rwdName' => $rwd_name,
                        'rwdDesc' => $rwd_desc,
                        'rwdPoints' => $rwd_points,
                        'rwdImg' => $img_new_name,
                        'rwdCtgId' => $rwd_ctgFk,
                        'rwdId' => $rwd_id
                    ];
                } else {
                    $response = [
                        'scs' => false,
                        'msg' => 'Error updating data'
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
    // No new image uploaded, just update the other fields
    $sql = "SELECT rwd_img FROM tbl_rwd_items WHERE rwd_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $rwd_id);
    $stmt->execute();
    $stmt->bind_result($current_img);
    $stmt->fetch();
    $stmt->close();

    // Update the other fields without changing the image
    $sql = "UPDATE tbl_rwd_items SET rwd_name = ?, rwd_desc = ?, rwd_points = ?, rwd_ctg = ? WHERE rwd_id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ssiii", $rwd_name, $rwd_desc, $rwd_points, $rwd_ctgFk, $rwd_id);

        if ($stmt->execute()) {
            $response = [
                'scs' => true,
                'msg' => 'Successfully updated !!',
                'rwdName' => $rwd_name,
                'rwdId' => $rwd_id,
                'rwdPoints' => $rwd_points,
                'rwdDesc' => $rwd_desc,
                'rwdImg' => $current_img, // Return the current image
                'rwdCtgId' => $rwd_ctgFk
            ];
        } else {
            $response = [
                'scs' => false,
                'msg' => 'Error updating data'
            ];
        }
        $stmt->close();
    } else {
        $response = [
            'scs' => false,
            'msg' => 'Failed to prepare statement'
        ];
    }
}

$conn->close();
header('Content-Type: application/json');

// Echo the JSON-encoded response
echo json_encode($response);
