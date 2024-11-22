<?php
include '../../../../../database/conn.php';
$id = $_POST['getId'];
$category_query = $conn->query("SELECT * FROM tbl_category WHERE cty_id = $id");
$category_data = mysqli_fetch_array($category_query);
?>
<div class="modal-box border border-bgborder bg-bgbox rounded-md">
   
    <form method="dialog">
        <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
    </form>
    <h3 class="text-lg font-bold font-popin">
        Add Items to
        <span class="opacity-70 font-light"><?php echo $category_data['cty_name'] ?></span>
    </h3>

    <form class="w-full mt-2" id="addItemCtyForm" enctype="multipart/form-data" method="POST">
        <div class="flex gap-2 w-auto h-auto items-center">
            <div class="border border-bgborder rounded-xl
            ">
                <div class="w-40 rounded-xl overflow-hidden">
                    <img src="" id="imagePreview" class="text-xs font-thin" alt="upload" />
                </div>
            </div>
            <label class="form-control w-full max-w-xs">
                <div class="label">
                    <span class="label-text text-xs ">Change Image</span>
                </div>
                <input type="file" name="itemImage" class="file-input file-input-success file-input-xs file-input-bordered w-full border-bgborder max-w-xs" />
            </label>
        </div>
        <input type="text" name="ctyId" value="<?php echo $id ?>" hidden>
        <label class="mt-5 input input-xs input-bordered border-bgborder bg-bgcard flex items-center gap-2">
            Name:
            <input type="text" name="itemName" class="grow" placeholder="" />
        </label>
        <div class="font-popin mt-1 flex items-center gap-1 text-xs">
            <div class="w-full h-[1px] bg-bgborder"></div>
            Points
            <div class="w-full h-[1px] bg-bgborder"></div>
        </div>
        <label class="mt-1 input input-xs input-bordered border-bgborder bg-bgcard flex items-center gap-2">
            Good Condition:
            <input type="number" name="gcon" class="grow" placeholder="" />
        </label>
        <label class="mt-2 input input-xs input-bordered border-bgborder bg-bgcard flex items-center gap-2">
            Partially Damage:
            <input type="number" name="pdam" class="grow" placeholder="" />
        </label>
        <label class="mt-2 input input-xs input-bordered border-bgborder bg-bgcard flex items-center gap-2">
            Fully Damage:
            <input type="text" name="fdam" class="grow" placeholder="" />
        </label>
        <div class="font-popin mt-1 flex items-center gap-1 text-xs">
            <div class="w-full h-[1px] bg-bgborder"></div>
            Category
            <div class="w-full h-[1px] bg-bgborder"></div>
        </div>
        <label class="mt-2 input input-xs input-bordered border-bgborder bg-bgcard flex items-center gap-2">
            Category:
            <input type="text" class="grow" placeholder="<?php echo $category_data['cty_name'] ?>" disabled />
        </label>
        <button class="btn btn-xs mt-3 border border-bgborder">save</button>
    </form>