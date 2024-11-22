<?php
include '../../../../../database/conn.php';
$id = $_POST['getId'];
$queryItemName = $conn->query("SELECT * FROM tbl_rwd_items WHERE rwd_id = '$id'");
$ItemName = $queryItemName->fetch_array();
?>
<div class="modal-box border border-bgborder bg-bgbox">
    <form method="dialog">
        <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
    </form>

    <form class="w-full flex flex-col justify-center items-center" id="delItemCtgForm">
        <i data-lucide="triangle-alert" class="w-10 h-10 text-warning"></i>
        <button class="btn btn-xs outline bg-transparent outline-1 rounded-md outline-bgborder text-bgtext text-xs font-popin"><?php echo $ItemName['rwd_name'] ?></button>
        <input type="text" name="delItemId" value="<?php echo $id ?>" hidden>
        <div class="text-center font-bold mt-2">Are you sure you want to delete this item?</div>
        <div class="flex items-center">
            <button class="btn w-24 mt-5 btn-sm border border-bgborder confirmDel" id="<?php echo $id ?>">Yes</button>
        </div>
    </form>
</div>
<script>
    lucide.createIcons();
</script>