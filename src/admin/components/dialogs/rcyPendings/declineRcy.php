<?php
include '../../../../../database/conn.php';
$id = $_POST['getId'];
$category_query = $conn->query("SELECT * FROM tbl_pdonations WHERE pdn_id = $id");
$category_data = mysqli_fetch_array($category_query);
?>
<div class="modal-box border w-auto border-bgborder rounded-md">
     <form method="dialog" class="mb-5">
      <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2 ">✕</button>
    </form>
    <div class="items-center justify-center flex-col flex">
        <div class="text-center font-popin font-semibold">Are you sure you want to decline this recycling request?</div>

        <div class="text-xs font-popin text-center"></div>
        <!-- <div class="tooltip" data-tip="Please provide a specific reason for the decline to help the requester understand the decision.">
          <button class="btn rounded-full btn-xs btn-ghost"><i data-lucide='info' class='w-4 h-4 text-error'></i></button>
        </div> -->
        <div class="toast z-50" id="addItemCtyAlertMsg">
        
        </div>
        <form class="p-2 flex flex-col items-center" id="declineRcyForm">

            <input type="text" name="rcyId" value="<?php echo $id ?>" hidden>
            <input type="text" name="userId" value="<?php echo $category_data['pdn_user'] ?>" hidden>
            <input type="text" name="ewstId" value="<?php echo $category_data['pdn_ewst'] ?>" hidden>
            <label class="form-control">
                <textarea class="textarea textarea-bordered h-20 w-96 font-popin text-xs" name="reason" placeholder="Reason for Decline"></textarea>
                <div class="label">

                </div>
            </label>
           <button  class="btn btn-xs bg-mainbg border border-bgborder justify-center mt-2 mx-2 font-popin font-normal">
                decline
            </button>
        </form>
    </div>
    
</div>
<script>
    lucide.createIcons();
</script>