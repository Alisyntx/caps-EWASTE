<div class="flex flex-col card p-2">
    <div class="toast toast-end z-50" id="addItemCtyAlertMsg">
    </div>
        <table id="dataTbl" class="table table-xs">
            <!-- head -->
            <thead>
                <tr>
                    <th>Ref Number</th>
                    <th>User Name</th>
                    <th>Recycle Item</th>
                    <th>Item Brand</th>
                    <th>Points</th>
                    <th>Quantity</th>
                    <th>Status</th>
                    <th>Request Time</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <!-- getting id from jquery shet -->
                <?php
                $stmt = $conn->prepare("SELECT pd.*, ew.*, us.* FROM tbl_pdonations pd LEFT JOIN tbl_ewst ew ON pd.pdn_ewst = ew.ewst_id LEFT JOIN tbl_user us ON pd.pdn_user = us.usr_id");
                $stmt->execute();
                $result = $stmt->get_result();


                while ($data = mysqli_fetch_array($result)) {
                    $ewst = $data['ewst_name'];
                    $userf = $data['usr_fname'];
                    $userl = $data['usr_lname'];
                    $points = $data['pdn_cdtn_pts'];
                    $stats = $data['pdn_status'];
                    $requestDate = new DateTime($data['pdn_dateAdd']);
                    $quantity = $data['pdn_qty'];
                    $ref = $data['pdn_ref'];
                    $brand = $data['pdn_brand'];
                    if ($stats == 1) {
                        $status = 'Pending';
                    } else {
                        $status = 'Approve';
                    };
                ?>
                    <tr id="tr_<?php echo $data['pdn_id'] ?>" class=" hover">
                         <td class="font-popin"><?php echo $ref ?></td>
                        <td class="font-popin font-medium"><?php echo $userf ?> <?php echo $userl ?> </td>
                        <td class="font-popin"><?php echo $ewst ?></td>
                        <td class="font-popin"><?php echo $brand ?></td>
                        <td class="font-popin"><?php echo $points ?> points</td>
                        <td class="font-popin"><?php echo $quantity ?> pcs</td>
                        <td class="font-popin"><?php echo $status ?></td>
                        <td class="font-popin"><?php echo timeAgo($requestDate); ?></td>
                        <td>
                            <div class="tooltip accept" data-tip="Accept">
                                <button class="btn btn-ghost btn-xs acceptRcy" id="<?php echo $data['pdn_id'] ?>" data-usr-id="<?php echo $data['pdn_id'] ?>" data-points="<?php echo $ewst ?>" onclick="acceptRcyItem.showModal()">
                                    <i class='text-lg bx bx-check-circle'></i>
                                </button>
                            </div>
                            <div class="tooltip decline" data-tip="Decline" id="<?php echo $data['pdn_id'] ?>" data-usr-id="<?php echo $data['pdn_id'] ?>">
                                 <button class="btn btn-ghost btn-xs declineRcy" id="<?php echo $data['pdn_id'] ?>" data-usr-id="<?php echo $data['pdn_id'] ?>" data-points="<?php echo $ewst ?>" onclick="declineRcy.showModal()">
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