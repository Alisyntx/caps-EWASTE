<?php
$query = "SELECT COUNT(*) AS total_redemptionItems FROM tbl_catalog";
$result = $conn->query($query);

if ($result) {
    $row = $result->fetch_assoc();
    $total_redemptionItems = $row['total_redemptionItems'];
} else {
    $total_redemptionItems = 0;
}

?>
<div class="stats shadow rounded-md bg-bgbox">
    <div class="stat p-2">
        <div class="stat-figure text-bgtext">
            <i data-lucide="gift"></i>
        </div>
        <div class="stat-title text-[12px]">Total Redemption Items</div>
        <div class="divide-y divide-bgdevider">
            <div class="font-bold text-md"><?php echo $total_redemptionItems ?></div>
            <div class="flex flex-row items-center gap-1">
                <div class="stat-desc text-[10px]">Add Items</div><i data-lucide="plus" class="w-3 h-3 "></i>
            </div>
        </div>
    </div>
</div>