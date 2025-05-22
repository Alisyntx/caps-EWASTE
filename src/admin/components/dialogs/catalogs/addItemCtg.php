<?php
include '../../../../../database/conn.php';
$id = $_POST['getId'];

// Prepare the SQL query with a placeholder
$stmt = $conn->prepare("SELECT * FROM tbl_catalog WHERE ctg_id = ?");
$stmt->bind_param("i", $id); // Bind the integer parameter to the query
$stmt->execute();
$category_query = $stmt->get_result();
$category_data = $category_query->fetch_assoc();
?>

<div class="modal-box border border-bgborder bg-bgbox rounded-md">
    <div class="toast toast-end z-50" id="addItemCtgAlertMsg">

    </div>
    <form method="dialog">
        <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
    </form>
    <h3 class="text-lg font-bold font-popin">
        Add Items to
        <span class="opacity-70 font-light"><?php echo htmlspecialchars($category_data['ctg_name']); ?></span>
    </h3>
    <form class="w-full mt-2" id="addItemCtgForm" enctype="multipart/form-data" method="POST">
        <div class="flex gap-2 w-auto h-auto items-center">
            <div class="border border-bgborder rounded-xl">
                <div class="w-40 rounded-xl overflow-hidden">
                    <img src="" id="imagePreview" class="text-xs font-thin" alt="upload" />
                </div>
            </div>
            <label class="form-control w-full max-w-xs">
                <div class="label">
                    <span class="label-text text-xs">Change Image</span>
                </div>
                <input type="file" name="itemImage" class="file-input file-input-success file-input-xs file-input-bordered w-full border-bgborder max-w-xs" />
            </label>
        </div>
        <input type="text" name="ctgId" value="<?php echo htmlspecialchars($id); ?>" hidden>
        <input type="text" name="ctgfkId" value="<?php echo $category_data['ctg_id']; ?>" hidden>
        <label class="mt-5 input input-xs input-bordered border-bgborder bg-bgcard flex items-center font-popin gap-2">
            Item Name:
            <input type="text" name="itemName" class="grow" placeholder="" />
        </label>
        <div class="font-popin mt-1 flex items-center gap-1 text-xs">
            <div class="w-full h-[1px] bg-bgborder"></div>
            Description
            <div class="w-full h-[1px] bg-bgborder"></div>
        </div>
        <label class="mt-2 input input-xs input-bordered border-bgborder bg-bgcard flex items-center font-popin gap-2">
            Description:
            <input type="text" name="rwdDesc" class="grow" placeholder="" />
        </label>
        <div class="font-popin mt-1 flex items-center gap-1 text-xs">
            <div class="w-full h-[1px] bg-bgborder"></div>
            Points
            <div class="w-full h-[1px] bg-bgborder"></div>
        </div>
        <label class="mt-2 input input-xs input-bordered border-bgborder bg-bgcard flex items-center font-popin gap-2">
            Redeem Points:
            <input type="text" name="rPoints" class="grow" placeholder="" />
        </label>
        <div class="font-popin mt-1 flex items-center gap-1 text-xs">
            <div class="w-full h-[1px] bg-bgborder"></div>
            Catalog
            <div class="w-full h-[1px] bg-bgborder"></div>
        </div>
        <label class="mt-2 input input-xs input-bordered border-bgborder bg-bgcard flex items-center gap-2">
            Catalog:
            <input type="text" class="grow" placeholder="<?php echo htmlspecialchars($category_data['ctg_name']); ?>" disabled />
        </label>
        <button class="btn btn-xs mt-3 border border-bgborder">save</button>
    </form>
</div>