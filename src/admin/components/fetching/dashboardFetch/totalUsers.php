<?php
$query = "SELECT COUNT(*) AS total_users FROM tbl_user";
$result = $conn->query($query);
if ($result) {
    $row = $result->fetch_assoc();
    $total_users = $row['total_users'];
} else {
    $total_users = 0;
}
?>
<div class="stats shadow rounded-md bg-bgbox">
    <div class="stat p-2">
        <div class="stat-figure text-bgtext">
            <i data-lucide="users"></i>
        </div>
        <div class="stat-title text-[12px]">Total User</div>
        <div class="divide-y divide-bgdevider">
            <div class="font-bold text-md "><?php echo $total_users ?></div>
            <div class="flex flex-row items-center gap-1">
                <div class="stat-desc text-[10px]">1 Active accounts</div><i data-lucide="user-check" class="w-3 h-3"></i>
            </div>
        </div>
    </div>
</div>