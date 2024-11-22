<?php
include '../../../../database/conn.php';

$ewst_name = $_POST['itemName'];
$ewst_ctyfk = $_POST['ctyId'];
$ewst_gcon = $_POST['gcon'];
$ewst_pdam = $_POST['pdam'];
$ewst_fdam = $_POST['fdam'];
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
            $sql = "INSERT INTO tbl_ewst (ewst_name, ewst_img, ewst_ctyfk, ewst_gcon, ewst_pdam, ewst_fdam) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);

            if ($stmt) {
                $stmt->bind_param("ssiiii", $ewst_name, $img_new_name, $ewst_ctyfk, $ewst_gcon, $ewst_pdam, $ewst_fdam);

                if ($stmt->execute()) {
                    $newItemQuery = "SELECT * FROM tbl_ewst WHERE ewst_name = ? AND ewst_img = ?";
                    $stmtNewItem = $conn->prepare($newItemQuery);
                    $stmtNewItem->bind_param("ss", $ewst_name, $img_new_name);
                    $stmtNewItem->execute();
                    $newItem = $stmtNewItem->get_result()->fetch_assoc();
                    $stmtNewItem->close();

                    // Generate HTML for the new item

                    $response = [
                        'scs' => true,
                        'msg' => 'successfully Added !!',
                        'ewstName' => $ewst_name,
                        'ewstImg' => $newItem['ewst_img'],
                        'ewstCtyId' => $ewst_ctyfk,
                        'ewstId' => $newItem['ewst_id'],
                        'ewstGcon' => $ewst_gcon,    
                        'ewstPdam' => $ewst_pdam,    
                        'ewstFdam' => $ewst_fdam
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
