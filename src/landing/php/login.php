<?php
include "../../../database/conn.php";

$username = $_POST['uname'];
$password = $_POST['password'];
$response = array();

$sql = "SELECT usr_id,usr_typ,usr_fname,usr_lname,usr_usrname,usr_usrpass FROM tbl_user WHERE usr_usrname = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$username]);
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    $usrPass = $row["usr_usrpass"];
    $usrId = $row["usr_id"];
    $usrTyp = $row["usr_typ"];

    if (password_verify($password, $usrPass)) {
        session_start();
        $_SESSION['usr_id'] = $usrId;
        if ($usrTyp === 1) {
            $response = [
                'scs' => True,
                'redirect' => '../views/adminDashboard.php',
                'msg' => 'Loging In..'
            ];
        }
    } else {
        $response = [
            'msg' => 'error password',
            'redirect' => '../index.php'
        ];
    }
} else {
    $response = [
        'scs' => False,
        'msg' => 'error username',
        'redirect' => '../index.php'

    ];
}
mysqli_close($conn);
header('Content-Type: application/json');
echo json_encode($response);
