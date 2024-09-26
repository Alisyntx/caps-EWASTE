<?php
include '../../../../../database/conn.php';
$id = $_POST['getId'];
$category_query = $conn->query("
    SELECT tbl_ewst.*, tbl_category.* 
    FROM tbl_ewst 
    INNER JOIN tbl_category ON tbl_ewst.ewst_ctyfk = tbl_category.cty_id 
    WHERE tbl_ewst.ewst_id = $id
");
$item_data = mysqli_fetch_array($category_query);
?>
<div class="modal-box border border-bgborder bg-bgbox rounded-md">
    <div class="toast toast-end z-50" id="editItemsAlertMsg">
    </div>
    <form method="dialog">
        <button class="btn  btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
    </form>
    <div class="w-full flex flex-col items-center">
        <h3 class="text-lg font-bold"> Edit Items</h3>
        <div class="border border-bgborder p-1 text-bgtext text-xs font-popin rounded-md"><?php echo $item_data['ewst_name'] ?></div>
    </div>
    <form class="w-full mt-2 editItemsForm" enctype="multipart/form-data" method="POST">
        <div class="flex gap-2 w-auto h-auto items-center">
            <div class="border border-bgborder rounded-xl
            ">
                <div class="w-40 rounded-xl overflow-hidden">
                    <img src="http://localhost/ewasteCapstone/storage/<?php echo $item_data['ewst_img'] ?>" />
                </div>
            </div>
            <input type="text" name="itemId" value="<?php echo $id ?>" hidden>
            <input type="text" name="itemCtyId" value="<?php echo $item_data['cty_id'] ?>" hidden>
            <label class="form-control w-full max-w-xs">
                <div class="label">
                    <span class="label-text">Change Image</span>
                </div>
                <input type="file" name="itemImage" class="file-input file-input-success file-input-xs file-input-bordered w-full border-bgborder max-w-xs" />
            </label>
        </div>
        <label class="mt-5 input input-xs input-bordered border-bgborder bg-bgcard flex items-center gap-2">
            Name:
            <input type="text" name="itemName" class="grow" value="<?php echo $item_data['ewst_name'] ?>" placeholder="<?php echo $item_data['ewst_name'] ?>" />
        </label>
        <div class="font-popin mt-1 flex items-center gap-1 text-xs">
            <div class="w-full h-[1px] bg-bgborder"></div>
            Points
            <div class="w-full h-[1px] bg-bgborder"></div>

        </div>
        <label class="mt-1 input input-xs input-bordered border-bgborder bg-bgcard flex items-center gap-2">
            Good Condition:
            <input type="text" name="gcon" class="grow" value="<?php echo $item_data['ewst_gcon'] ?>" placeholder="<?php echo $item_data['ewst_gcon'] ?>" />
        </label>
        <label class="mt-2 input input-xs input-bordered border-bgborder bg-bgcard flex items-center gap-2">
            Partially Damage:
            <input type="text" name="pdam" class="grow" value="<?php echo $item_data['ewst_pdam'] ?>" placeholder="<?php echo $item_data['ewst_pdam'] ?>" />
        </label>
        <label class="mt-2 input input-xs input-bordered border-bgborder bg-bgcard flex items-center gap-2">
            Fully Damage:
            <input type="text" name="fdam" class="grow" value="<?php echo $item_data['ewst_fdam'] ?>" placeholder="<?php echo $item_data['ewst_fdam'] ?>" />
        </label>
        <button class="btn btn-xs mt-3 border border-bgborder">save</button>
    </form>

</div>