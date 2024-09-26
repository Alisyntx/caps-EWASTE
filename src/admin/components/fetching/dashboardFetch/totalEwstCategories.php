<?php
$query = "SELECT COUNT(*) AS totalEwstCategories FROM tbl_category";
$result = $conn->query($query);
if ($result) {
    $row = $result->fetch_assoc();
    $totalEwstCategories = $row['totalEwstCategories'];
} else {
    $totalEwstCategories = 0;
}
?>
<div class="stats shadow rounded-md bg-bgbox">
    <div class="stat p-2">
        <div class="stat-figure text-bgtext">
            <i data-lucide="list-minus"></i>
        </div>
        <div class="stat-title text-[12px]">Total E-waste Categories</div>
        <div class="divide-y divide-bgdevider">
            <div class="font-bold text-md"><?php echo $totalEwstCategories ?></div>
            <div class="flex flex-row items-center gap-1">
                <div class="stat-desc text-[10px]">view</div><i data-lucide="eye" class="w-3 h-3 "></i>
            </div>
        </div>
    </div>
</div>