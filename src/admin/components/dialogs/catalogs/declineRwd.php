<?php
include '../../../../../database/conn.php';
$id = $_POST['getId'];
$category_query = $conn->query("SELECT * FROM tbl_predeems WHERE prd_id = $id");
$category_data = mysqli_fetch_array($category_query);
?>
<div class="modal-box border w-auto border-bgborder rounded-md">
     <form method="dialog" class="mb-5">
      <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2 ">✕</button>
    </form>
    <div class="items-center justify-center flex-col flex">
        <div class="text-center font-popin font-semibold ">Are you sure you want to decline this redeemed item request?</div>

        <div class="toast z-50" id="addItemCtyAlertMsg">
        
        </div>
        <form class="p-2 flex flex-col items-center" id="declineRwdForm">

            <input type="text" name="rwdId" value="<?php echo $id ?>" hidden>
            <input type="text" name="userId" value="<?php echo $category_data['prd_user'] ?>" hidden>
            <input type="text" name="prdId" value="<?php echo $category_data['prd_rwd_id'] ?>" hidden>
           <textarea class="textarea textarea-bordered h-20 w-96 font-popin text-xs" name="reason" placeholder="Reason for Decline"></textarea>
                <div class="label">

           <button  class="btn btn-xs bg-mainbg border border-bgborder justify-center mt-2 mx-2 font-popin font-normal">
                decline
            </button>
        </form>
    </div>
    
</div>
<script>
    lucide.createIcons();
</script>