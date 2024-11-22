<?php
include '../../../../database/conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get and sanitize input
    $id = intval($_POST['id']);
    $firstName = htmlspecialchars(trim($_POST['firstname']));
    $lastName = htmlspecialchars(trim($_POST['lastname']));
    $userType = intval($_POST['usertype']);
    $username = htmlspecialchars(trim($_POST['username']));
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $idNumber = htmlspecialchars(trim($_POST['idnumber']));
    $course = htmlspecialchars(trim($_POST['course']));
    $rewards = intval($_POST['rewards']);
    $totalRewards = intval($_POST['total_rewards']);
    $userStat = htmlspecialchars(trim($_POST['userStat']));

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(["msg" => "Invalid email format."]);
        exit;
    }

    // Update database
    $stmt = $conn->prepare(
        "UPDATE tbl_user SET 
        usr_fname = ?,
        usr_lname = ?,   
        usr_typ = ?, 
        usr_usrname = ?, 
        usr_email = ?, 
        usr_idnum = ?, 
        usr_course = ?, 
        usr_rwd = ?, 
        usr_total_rwd = ?, 
        usr_active = ? 
        WHERE usr_id = ?"
    );
    $stmt->bind_param(
        "ssissssissi", 
        $firstName, 
        $lastName,
        $userType, 
        $username, 
        $email, 
        $idNumber, 
        $course, 
        $rewards, 
        $totalRewards, 
        $userStat, 
        $id
    );

    if ($stmt->execute()) {
        // Fetch the updated user data to return as response
        $stmt = $conn->prepare("SELECT * FROM tbl_user WHERE usr_id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = mysqli_fetch_array($result);

        // Prepare updated row HTML
        $userType = $data['usr_typ'] == 1 ? 'Admin' : 'Student';
        $activeIcon = $data['usr_active'] == 'Active' 
            ? '<i data-lucide="user-check" class="w-4 h-4 text-bgdevider"></i>' 
            : '<i data-lucide="user-x" class="w-4 h-4 text-red-500"></i>';

        $updatedRow = "
            <tr class='hover' id='userRow{$data['usr_id']}'>
                <td class='font-popin font-medium'>{$data['usr_fname']}  {$data['usr_lname']}</td>
                <td>{$userType}</td>
                <td>{$data['usr_usrname']}</td>
                <td>{$data['usr_email']}</td>
                <td>{$data['usr_idnum']}</td>
                <td>{$data['usr_course']}</td>
                <td>{$data['usr_rwd']} points</td>
                <td>{$data['usr_total_rwd']} points</td>
                <td>{$activeIcon}</td>
                <td>
                    <button class='btn btn-circle btn-xs btn-ghost userManage' onclick='editUser.showModal()' id='{$data['usr_id']}'>
                        <i data-lucide='user-pen' class='w-4 h-4 text-bgtext'
                        ></i>
                    </button>
                </td>
            </tr>";

        // Respond with success message and the updated row HTML
        echo json_encode([
            "success" => true, 
            "msg" => "User updated successfully.",
            "updatedRow" => $updatedRow
        ]);
    } else {
        echo json_encode(["msg" => "Failed to update user."]);
    }
} else {
    echo json_encode(["msg" => "Invalid request method."]);
}

header('Content-Type: application/json');
