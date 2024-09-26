 <!-- database connection -->
 <?php
    include '../../../../database/conn.php';

    $id = $_POST['rwdId'];
    echo $id;
    $query = $conn->query("SELECT * FROM tbl_catalog WHERE ctg_id = $id");
    $data = $query->fetch_assoc();
    $name = $data['ctg_name'];
    $points = $data['ctg_points'];

    ?>
 <div class="modal-box">
     <form method="dialog">
         <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
     </form>
     <h3 class="font-bold text-sm">Item Info</h3>
     <div class="flex flex-col items-center w-full lg:flex-row">
         <div class="card lg:w-56 w-full bg-base-100 shadow-xl">
             <figure class="p-5">
                 <img src="../img/gift.png" alt="keyboard" class="rounded-box" />
             </figure>
         </div>
         <div class="divider lg:divider-horizontal"></div>
         <div class="card w-56 bg-base-100 shadow-xl p-2 gap-1 bg-transparent">
             <label class="input input-bordered input-sm flex items-center gap-2">
                 Id:
                 <input type="text" value="<?php echo $data['ctg_id'] ?>" class=" input input-bordered input-xs w-full max-w-xs" disabled />
             </label>
             <label class="input input-bordered input-sm flex items-center gap-2">
                 Item:
                 <input type="text" value="<?php echo $name ?>" class="input input-bordered input-xs w-full max-w-xs" disabled />
             </label>
             <label class="input input-bordered input-sm flex items-center gap-2">
                 Points:
                 <input type="text" value="<?php echo $points ?>" class="input input-bordered input-xs w-full max-w-xs" disabled />
             </label>
         </div>
     </div>

     <!-- e wasete donations Table -->