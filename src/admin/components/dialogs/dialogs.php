 <!-- database connection -->
 <?php
    include '../../../../database/conn.php';

    $id = $_POST['getId'];
    echo $id;
    $query = $conn->query("SELECT ewst.*,user.usr_fname, user.usr_lname, cdtn.cdtn_type, cty.cty_name FROM tbl_ewst AS ewst INNER JOIN tbl_user AS user ON ewst.ewst_userfk = user.usr_id INNER JOIN tbl_cdtn AS cdtn ON ewst.ewst_cdtnfk = cdtn.cdtn_id INNER JOIN tbl_category AS cty ON ewst.ewst_ctyfk = cty.cty_id WHERE ewst.ewst_id = '$id'");

    $data = $query->fetch_array();
    $userFname = $data['usr_fname'];
    $userLname = $data['usr_lname'];
    $condition = $data['cdtn_type'];
    $name = $data['ewst_name'];
    $points = $data['ewst_points'];
    $category = $data['cty_name'];
    ?>
 <div class="modal-box">
     <form method="dialog">
         <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
     </form>
     <h3 class="font-bold text-sm">Item Info</h3>
     <div class="flex flex-col items-center w-full lg:flex-row">
         <div class="card lg:w-56 w-full bg-base-100 shadow-xl">
             <figure class="p-5">
                 <img src="../img/kb.jpg" alt="keyboard" class="rounded-box" />
             </figure>
         </div>
         <div class="divider lg:divider-horizontal"></div>
         <div class="card w-56 bg-base-100 shadow-xl p-2 gap-1 bg-transparent">
             <label class="input input-bordered input-sm flex items-center gap-2">
                 Id:
                 <input type="text" value="<?php echo $data['ewst_id'] ?>" class=" input input-bordered input-xs w-full max-w-xs" disabled />
             </label>
             <label class="input input-bordered input-sm flex items-center gap-2">
                 User:
                 <input type="text" value="<?php echo $userFname . " " . $userLname ?>" class=" input input-bordered input-xs w-full max-w-xs" disabled />
             </label>
             <label class="input input-bordered input-sm flex items-center gap-2">
                 Category:
                 <input type="text" value="<?php echo $category ?>" class="input input-bordered input-xs w-full max-w-xs" disabled />
             </label>
             <label class="input input-bordered input-sm flex items-center gap-2">
                 Condition:
                 <input type="text" value="<?php echo $condition ?>" class="input input-bordered input-xs w-full max-w-xs" disabled />
             </label>
             <label class="input input-bordered input-sm flex items-center gap-2">
                 Points:
                 <input type="text" value="<?php echo $points ?>" class="input input-bordered input-xs w-full max-w-xs" disabled />
             </label>
             <label class="input input-bordered input-sm flex items-center gap-2">
                 Item:
                 <input type="text" value="<?php echo $name ?>" class="input input-bordered input-xs w-full max-w-xs" disabled />
             </label>
         </div>
     </div>

     <!-- e wasete donations Table -->