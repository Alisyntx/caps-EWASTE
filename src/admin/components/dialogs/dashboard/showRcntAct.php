<?php
include '../../../../../database/conn.php';
$id = $_POST['getId'];
$category_query = $conn->query("SELECT * FROM tbl_rcnt_hry WHERE hry_rcy_id = $id");
$item_data = mysqli_fetch_array($category_query);
?>
<div class="modal-box border border-bgborder bg-bgbox rounded-lg">
    <form method="dialog">
        <button class="xBtnChkPts btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
    </form>
    <div class="w-full flex flex-col items-center">
        <h3 class="text-lg font-bold">Activity</h3>
    </div>
    <div class="w-full">
        <div class="w-full h-7 p-2 mt-5 bg-bgcard text-xs border border-bgborder flex items-center rounded-md">
            <span class="opacity-70 mr-1"> User:</span> <?php echo $item_data['hry_user'] ?>
        </div>
        <div class="w-full h-7 p-2 mt-1 bg-bgcard text-xs border border-bgborder flex items-center rounded-md">
            <span class="opacity-70 mr-1"> Item:</span> <?php echo $item_data['hry_rcy_item'] ?>
        </div>
        <div class="w-full h-7 p-2 mt-1 bg-bgcard text-xs border border-bgborder flex items-center rounded-md">
            <span class="opacity-70 mr-1"> Brand and Model:</span> <?php echo $item_data['hry_brand'] ?>
        </div>
        <div class="w-full h-7 p-2 mt-1 bg-bgcard text-xs border border-bgborder flex items-center rounded-md">
            <span class="opacity-70 mr-1"> Condition:</span> <?php echo $item_data['hry_rcy_cdtn'] ?>
        </div>
        <div class="w-full h-7 p-2 mt-1 bg-bgcard text-xs border border-bgborder flex items-center rounded-md">
            <span class="opacity-70 mr-1"> Redeemed Points</span> <?php echo $item_data['hry_rcy_pts'] ?> points
        </div>
        <div class="w-full h-7 p-2 mt-1 bg-bgcard text-xs border border-bgborder flex items-center rounded-md">
            <span class="opacity-70 mr-1"> Activity:</span> <?php echo $item_data['hry_activity'] ?>
        </div>
    </div>
</div>