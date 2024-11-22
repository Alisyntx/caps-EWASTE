 <?php include '../../../../database/conn.php';
    $id = $_POST['getId'];
    $query = $conn->query("SELECT ewst.*,user.usr_fname, user.usr_lname, cdtn.cdtn_type, cty.cty_name FROM tbl_ewst AS ewst INNER JOIN tbl_user AS user ON ewst.ewst_userfk = user.usr_id INNER JOIN tbl_cdtn AS cdtn ON ewst.ewst_cdtnfk = cdtn.cdtn_id INNER JOIN tbl_category AS cty ON ewst.ewst_ctyfk = cty.cty_id WHERE cty.cty_id = '$id'");
    $count = 1;
    $queryCtyName = $conn->query("SELECT * FROM tbl_category WHERE cty_id = '$id'");
    $ctyName = $queryCtyName->fetch_array();
    ?>
 <div class="modal-box w-11/12 max-w-5xl">
     <form method="dialog">
         <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
     </form>
     <button class="btn btn-ghost btn-sm font-bold text-lg"><i class='bx bx-plus-circle'></i> <?php echo $ctyName['cty_name'] ?></button>
     <div class="card mt-4">

         <div class="overflow-x-auto">
             <table class="table">
                 <!-- head -->
                 <thead>
                     <tr>
                         <th>ID</th>
                         <th>Name</th>
                         <th>Donator</th>
                         <th>Points</th>
                         <th>Date Added</th>
                         <th></th>
                     </tr>
                 </thead>
                 <tbody>
                     <!-- getting id from jquery shet -->
                     <?php
                        while ($data = mysqli_fetch_array($query)) {
                            $itemName = $data['ewst_name'];
                            $itemId = $data['ewst_id'];
                            $userFname = $data['usr_fname'];
                            $userLname = $data['usr_lname'];
                            $condition = $data['cdtn_type'];
                            $points = $data['ewst_points'];
                            $category = $data['cty_name'];
                            $dateAdd = $data['ewst_dateadd'];

                        ?>
                         <tr class="hover">
                             <th><?php echo $itemId ?></th>
                             <td><?php echo $itemName ?></td>
                             <td><?php echo $userFname ?> <?php echo $userLname ?></td>
                             <td><?php echo $points ?></td>
                             <td><?php echo $dateAdd ?></td>
                             <td><?php echo $count++ ?></td>
                         </tr>
                     <?php } ?>
                 </tbody>
             </table>
         </div>
     </div>
 </div>
 </div>