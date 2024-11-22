
<script>
    lucide.createIcons();
</script>

<?php
include '../../../../../database/conn.php';

if (isset($_POST['getId'])) {
    $id = intval($_POST['getId']); // Securely get user ID

    $stmt = $conn->prepare("SELECT * FROM tbl_user WHERE usr_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($data = $result->fetch_assoc()) {
        ob_start(); // Start output buffering
        $firstName = htmlspecialchars($data['usr_fname']);
        $lastName = htmlspecialchars($data['usr_lname']);
        $userImg = htmlspecialchars($data['usr_img']);
        $userType = $data['usr_typ'] == 1 ? 'Admin' : 'Student';
        $userStat = $data['usr_active'] == 'Active' ? 'Active' : 'Disable';
        $username = $data['usr_usrname'];
        $email = $data['usr_email'];
        $idNumber = $data['usr_idnum'];
        $course = $data['usr_course'];
        $rewards = $data['usr_rwd'];
        $totalRewards = $data['usr_total_rwd'];
        ?>
        <div class="modal-box bg-[#FDE5D4] border font-popin border-bgborder">
            <div class="flex justify-center flex-col items-center">
                
            <div class="avatar">
                
                <div class="w-24 rounded-full">
                   <img src="http://localhost/ewasteCapstone/storage/<?php echo $userImg ?>" alt="no image uploaded" />
                </div>
                
            </div>
            <button class="btn btn-xs mt-4 ">
                <?php if ($data['usr_active'] == 'Active') { ?>
                            <!-- Active icon -->
                             Active
                            <i data-lucide="user-check" class="w-4 h-4 text-bgdevider"></i>
                        <?php } else { ?>
                            <!-- Disabled icon -->
                             Disabled
                            <i data-lucide="user-x" class="w-4 h-4 text-red-500"></i>
                        <?php } ?>
                    </button> 
        </div>
            <!-- Modal Content Here (similar to your given modal) -->
            <form id="editUserForm">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                
                <!-- Full Name -->
            <div class="form-control">
                <label class="label">
                    <span class="label-text text-xs font-popin">First Name</span>
                </label>
                <input 
                    type="text" 
                    name="firstname" 
                    class="input input-bordered input-sm" 
                    value="<?php echo htmlspecialchars($firstName, ENT_QUOTES, 'UTF-8'); ?>" 
                    required>
            </div>
            <div class="form-control">
                <label class="label">
                    <span class="label-text text-xs font-popin">Last Name</span>
                </label>
                <input 
                    type="text" 
                    name="lastname" 
                    class="input input-bordered input-sm" 
                    value="<?php echo htmlspecialchars($lastName, ENT_QUOTES, 'UTF-8'); ?>" 
                    required>
            </div>

            <!-- User Type -->
            <div class="form-control mt-2">
                <label class="label">
                    <span class="label-text text-xs font-popin">User Type</span>
                </label>
                <select name="usertype" class="select select-bordered select-sm">
                    <option value="1" <?php echo $data['usr_typ'] == 1 ? 'selected' : ''; ?>>Admin</option>
                    <option value="2" <?php echo $data['usr_typ'] == 2 ? 'selected' : ''; ?>>Student</option>
                </select>
            </div>

            <!-- Username -->
            <div class="form-control mt-2">
                <label class="label">
                    <span class="label-text text-xs font-popin">Username</span>
                </label>
                <input 
                    type="text" 
                    name="username" 
                    class="input input-bordered input-sm" 
                    value="<?php echo htmlspecialchars($username, ENT_QUOTES, 'UTF-8'); ?>" 
                    required>
            </div>

            <!-- Email -->
            <div class="form-control mt-2">
                <label class="label">
                    <span class="label-text text-xs font-popin">Email</span>
                </label>
                <input 
                    type="email" 
                    name="email" 
                    class="input input-bordered input-sm" 
                    value="<?php echo htmlspecialchars($email, ENT_QUOTES, 'UTF-8'); ?>" 
                    required>
            </div>

            <!-- ID Number -->
            <div class="form-control mt-2">
                <label class="label">
                    <span class="label-text text-xs font-popin">ID Number</span>
                </label>
                <input 
                    type="text" 
                    name="idnumber" 
                    class="input input-bordered input-sm" 
                    value="<?php echo htmlspecialchars($idNumber, ENT_QUOTES, 'UTF-8'); ?>" 
                    required>
            </div>

            <!-- Course -->
            <div class="form-control mt-2">
                <label class="label">
                    <span class="label-text text-xs font-popin">Course</span>
                </label>
                <input 
                    type="text" 
                    name="course" 
                    class="input input-bordered input-sm" 
                    value="<?php echo htmlspecialchars($course, ENT_QUOTES, 'UTF-8'); ?>" 
                    required>
            </div>

            <!-- Rewards -->
            <div class="form-control mt-2">
                <label class="label">
                    <span class="label-text text-xs font-popin">Rewards</span>
                </label>
                <input 
                    type="number" 
                    name="rewards" 
                    class="input input-bordered input-sm" 
                    value="<?php echo htmlspecialchars($rewards, ENT_QUOTES, 'UTF-8'); ?>" 
                    required>
            </div>

            <!-- Total Rewards -->
            <div class="form-control mt-2">
                <label class="label">
                    <span class="label-text text-xs font-popin">Total Rewards</span>
                </label>
                <input 
                    type="number" 
                    name="total_rewards" 
                    class="input input-bordered input-sm" 
                    value="<?php echo htmlspecialchars($totalRewards, ENT_QUOTES, 'UTF-8'); ?>" 
                    required>
            </div>

            <!-- Account State -->
            <div class="form-control mt-2">
                <label class="label">
                    <span class="label-text text-xs font-popin">Account State</span>
                </label>
                <select name="userStat" class="select select-bordered select-sm">
                    <option value="Active" <?php echo $data['usr_active'] == 'Active' ? 'selected' : ''; ?>>Active</option>
                    <option value="Disable" <?php echo $data['usr_active'] == 'Disable' ? 'selected' : ''; ?>>Disable</option>
                </select>
            </div>
               
                <button type="submit" class="btn btn-xs mt-5 bg-[#FDE5D4] border font-popin border-bgborder">
                    Update
                </button>
            </form>
                    <form method="dialog" class="bg-bgdevider">
        <!-- if there is a button in form, it will close the modal -->
        <button class="btn btn-xs absolute right-2 top-2 btn-circle">
            <i data-lucide="x" class="w-4 h-4 text-bgtext"></i>
        </button>
        </form>
        </div>
        <?php
        $html = ob_get_clean(); // Get the buffered content
        echo $html;
    } else {
        echo "User not found.";
    }
}
?>
