<?php
include '../../../../../database/conn.php';
$id = $_POST['getId'];
$queryCtyName = $conn->query("SELECT * FROM tbl_category WHERE cty_id = '$id'");
$ctyName = $queryCtyName->fetch_array();
?>
<div class="modal-box border border-bgborder bg-bgbox">
    <form method="dialog">
        <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
    </form>

    <form class="w-full flex flex-col justify-center items-center" id="delCtyModal">
        <i data-lucide="triangle-alert" class="w-10 h-10 text-warning"></i>
        <button class="btn btn-xs outline bg-transparent outline-1 rounded-md outline-bgborder text-bgtext text-xs font-popin"><?php echo $ctyName['cty_name'] ?></button>
        <input type="text" name="ctyId" value="<?php echo $id ?>" hidden>
        <div class="text-center font-bold mt-2">Are you sure you want to delete this category? All items will be permanently deleted.</div>
        <div class="flex items-center">
            <button class="btn w-24 mt-5 btn-sm border border-bgborder confirmDel" id="<?php echo $id ?>">Yes</button>
        </div>
    </form>
</div>
<script>
    lucide.createIcons();
</script>