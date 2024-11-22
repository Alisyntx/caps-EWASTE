<?php
include '../../../../../database/conn.php';
$id = $_POST['getId'];
$category_query = $conn->query("SELECT * FROM tbl_predeems WHERE prd_id = $id");
$category_data = mysqli_fetch_array($category_query);
?>
<div class="modal-box border w-auto border-bgborder rounded-md">
    <div class="items-center justify-center flex-col flex">
        <div class="text-center font-popin font-bold">Accept this recyclable item?</div>
    </div>
    <div class="flex float-right items-center">
        <form class="p-2" id="acceptRwdForm">
            <input type="text" name="rwdId" value="<?php echo $id ?>" hidden>
            <input type="text" name="userId" value="<?php echo $category_data['prd_user'] ?>" hidden>
            <input type="text" name="prdId" value="<?php echo $category_data['prd_rwd_id'] ?>" hidden>

            <button type="submit" class="btn btn-xs bg-mainbg border btn-circle border-bgborder justify-center mt-2 mx-2 font-popin font-normal">
                <i data-lucide="check" class="w-5 h-5 text-bgtext"></i>
            </button>

        </form>
        <form method="dialog">
            <button class="btn btn-xs btn-circle border bg-mainbg border-bgborder btn-ghost mt-2 font-popin font-normal">
                <i data-lucide="x" class="w-5 h-5 text-bgtext"></i>
            </button>
        </form>
    </div>
</div>
<script>
    lucide.createIcons();
</script>