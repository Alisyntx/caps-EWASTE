<?php
include '../../../../../database/conn.php';
$id = $_POST['getId'];
$category_query = $conn->query("SELECT * FROM tbl_ewst WHERE ewst_id = $id");
$item_data = mysqli_fetch_array($category_query);
?>
<div class="modal-box border border-bgborder bg-bgbox rounded-lg">
    <form method="dialog">
        <button class="xBtnChkPts btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
    </form>
    <div class="w-full flex flex-col items-center">
        <h3 class="text-lg font-bold"> Condition Points</h3>
        <div class="border border-bgborder p-1 rounded-md text-bgtext text-xs font-popin"><?php echo $item_data['ewst_name'] ?></div>
    </div>


    <div class="w-full">
        <div class="w-full h-7 p-2 mt-5 bg-bgcard text-xs border border-bgborder flex items-center rounded-md">
            <span class="opacity-70 mr-1"> Good Condition:</span> <?php echo $item_data['ewst_gcon'] ?> points
        </div>
        <div class="w-full h-7 p-2 mt-1 bg-bgcard text-xs border border-bgborder flex items-center rounded-md">
            <span class="opacity-70 mr-1"> Partially Damage:</span> <?php echo $item_data['ewst_pdam'] ?> points
        </div>
        <div class="w-full h-7 p-2 mt-1 bg-bgcard text-xs border border-bgborder flex items-center rounded-md">
            <span class="opacity-70 mr-1"> Fully Damage:</span> <?php echo $item_data['ewst_fdam'] ?> points
        </div>
    </div>
</div>