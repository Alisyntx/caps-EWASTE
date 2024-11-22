<div class="flex flex-col card p-2 mt-2">
    <div class="toast toast-end z-50 font-popin" id="editItemsCtgAlertMsg">
                    
    </div> 
    <table id="dataTbl" class="table table-xs">
        <!-- head -->
        <thead>
            <tr>
                <!-- <th>User ID</th> -->
                <th>Full Name</th>
                <th>User Type</th>
                <th>Username</th>
                <th>Email</th>
                <th>ID Number</th>
                <th>Course</th>
                <th>Rewards</th>
                <th>Gain Rewards</th>
                <th>State</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Prepare and execute the query to fetch user data
            $stmt = $conn->prepare("SELECT * FROM tbl_user");
            $stmt->execute();
            $result = $stmt->get_result();

            // Loop through the results and display them
            while ($data = mysqli_fetch_array($result)) {
                $userId = $data['usr_id'];
                $fullName = $data['usr_fname'] . ' ' . $data['usr_lname'];
                $username = $data['usr_usrname'];
                $email = $data['usr_email'];
                $idNumber = $data['usr_idnum'];
                $course = $data['usr_course'];
                $rewards = $data['usr_rwd'];
                $totalRewards = $data['usr_total_rwd'];

                // Determine user type
                $userType = $data['usr_typ'] == 1 ? 'Admin' : 'Student';
            ?>
                <tr class="hover" id="userRow<?php echo $data['usr_id']; ?>">
                    <td class="font-popin font-medium"><?php echo $fullName; ?></td>
                    <td><?php echo $userType; ?></td>
                    <td><?php echo $username; ?></td>
                    <td><?php echo $email; ?></td>
                    <td><?php echo $idNumber; ?></td>
                    <td><?php echo $course; ?></td>
                    <td><?php echo $rewards; ?> points</td>
                    <td><?php echo $totalRewards; ?> points</td>
                    <td >
                        <?php if ($data['usr_active'] == 'Active') { ?>
                            <!-- Active icon -->
                            <i data-lucide="user-check" class="w-4 h-4 text-bgdevider"></i>
                        <?php } else { ?>
                            <!-- Disabled icon -->
                            <i data-lucide="user-x" class="w-4 h-4 text-red-500"></i>
                        <?php } ?>
                    </td>
                    <td>
                        <button class="btn btn-circle btn-xs btn-ghost userManage" onclick="editUser.showModal()" id="<?php echo $data['usr_id']; ?>">
                            <i data-lucide="user-pen" class="w-4 h-4 text-bgtext"></i>
                        </button>
                    </td>
                </tr>
            <?php } ?>
        </tbody>

    </table>
</div>
