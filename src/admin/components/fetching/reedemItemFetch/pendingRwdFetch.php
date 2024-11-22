<div class="flex flex-col card p-2 mt-2">
    <div class="toast toast-end z-50" id="addItemCtyAlertMsg">

    </div>
        <table id="dataTbl" class="table table-xs">
            <!-- head -->
            <thead>
                <tr>
                    <th>Ref Numbers</th>
                    <th>User Name</th>
                    <th>Redeemed Item</th>
                    <th>Redeemed Points</th>
                    <th>Quantity</th>
                    <th>Status</th>
                    <th>Request Time</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <!-- getting id from jquery shet -->
                <?php
                $stmt = $conn->prepare("SELECT pr.*, ew.*, us.* FROM tbl_predeems pr LEFT JOIN tbl_ewst ew ON pr.prd_rwd_id = ew.ewst_id LEFT JOIN tbl_user us ON pr.prd_user = us.usr_id");
                $stmt->execute();
                $result = $stmt->get_result();


                while ($data = mysqli_fetch_array($result)) {
                    $refnum = $data['prd_ref'];
                    $ewst = $data['prd_rwd_name'];
                    $userf = $data['usr_fname'];
                    $userl = $data['usr_lname'];
                    $points = $data['prd_points'];
                    $quantity = $data['prd_qty'];
                    $stats = $data['prd_status'];
                    $requestDate = new DateTime($data['prd_dateAdd']);

                    if ($stats == 1) {
                        $status = 'Pending';
                    } else {
                        $status = 'Approve';
                    };
                ?>
                    <tr id="tr_<?php echo $data['prd_id'] ?>" class=" hover">
                        <td ><?php echo $refnum ?></td>
                        <td class="font-popin font-medium"><?php echo $userf ?> <?php echo $userl ?> </td>
                        <td><?php echo $ewst ?></td>
                        <td><?php echo $points ?> points</td>
                        <td><?php echo $quantity ?> pcs</td>
                        <td><?php echo $status ?></td>
                        <td><?php echo timeAgo($requestDate); ?></td>
                        <td>
                            <div class="tooltip accept" data-tip="Accept">
                                <button class="btn btn-ghost btn-xs acceptRwd" id="<?php echo $data['prd_id'] ?>" data-usr-id="<?php echo $data['prd_id'] ?>" data-points="<?php echo $ewst ?>" onclick="acceptRwdItem.showModal()">
                                    <i class='text-lg bx bx-check-circle'></i>
                                </button>
                            </div>
                            <div class=" tooltip decline" data-tip="Decline">
                                <button class="btn btn-ghost btn-xs declineRwd" id="<?php echo $data['prd_id'] ?>" data-usr-id="<?php echo $data['prd_id'] ?>" data-points="<?php echo $ewst ?>" onclick="declineRwdItem.showModal()">
                                    <i class='bx bx-x-circle text-lg text-red-700'></i>
                                </button>
                            </div>
                        </td>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
</div>