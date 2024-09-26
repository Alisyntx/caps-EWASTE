<?php
include '../../../../database/conn.php';

$ewst_id = $_POST['itemId']; // Assuming you're passing the item ID for the update

$ewst_name = $_POST['itemName'];
$ewst_ctyfk = $_POST['itemCtyId'];
$ewst_gcon = $_POST['gcon'];
$ewst_pdam = $_POST['pdam'];
$ewst_fdam = $_POST['fdam'];
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
            $sql = "UPDATE tbl_ewst SET ewst_name = ?, ewst_img = ?, ewst_gcon = ?, ewst_pdam = ?, ewst_fdam = ? WHERE ewst_id = ?";
            $stmt = $conn->prepare($sql);

            if ($stmt) {
                $stmt->bind_param("ssiiii", $ewst_name, $img_new_name, $ewst_gcon, $ewst_pdam, $ewst_fdam, $ewst_id);

                if ($stmt->execute()) {
                    $response = [
                        'scs' => true,
                        'msg' => 'Successfully updated !!',
                        'ewstName' => $ewst_name,
                        'ewstImg' => $img_new_name,
                        'ewstCtyId' => $ewst_ctyfk
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
    $sql = "SELECT ewst_img FROM tbl_ewst WHERE ewst_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $ewst_id);
    $stmt->execute();
    $stmt->bind_result($current_img);
    $stmt->fetch();
    $stmt->close();

    // Update the other fields without changing the image
    $sql = "UPDATE tbl_ewst SET ewst_name = ?, ewst_gcon = ?, ewst_pdam = ?, ewst_fdam = ? WHERE ewst_id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("siiii", $ewst_name, $ewst_gcon, $ewst_pdam, $ewst_fdam, $ewst_id);

        if ($stmt->execute()) {
            $response = [
                'scs' => true,
                'msg' => 'Successfully updated !!',
                'ewstName' => $ewst_name,
                'itemId' => $ewst_id,
                'ewstImg' => $current_img, // Return the current image
                'ewstCtyId' => $ewst_ctyfk
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
