<?php
$query = "SELECT COUNT(*) AS total_Pdonations FROM tbl_pdonations";
$result = $conn->query($query);
if ($result) {
    $row = $result->fetch_assoc();
    $total_Pdonations = $row['total_Pdonations'];
} else {
    $total_Pdonations = 0;
}
?>
<div class="stats shadow rounded-md bg-bgbox">
    <div class="stat p-2">
        <div class="stat-figure text-bgtext">
            <i data-lucide="layout-list"></i>
        </div>
        <div class="stat-title text-[12px]">Pending Donations</div>
        <div class="divide-y divide-bgdevider">
            <div class="font-bold text-md"><?php echo $total_Pdonations ?></div>
            <div class="flex flex-row items-center gap-1">
                <div class="stat-desc text-[10px]">View Donations</div><i data-lucide="eye" class="w-3 h-3"></i>
            </div>
        </div>
    </div>
</div>