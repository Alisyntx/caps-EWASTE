<?php
$query = "SELECT SUM(usr_total_rwd) AS totalPoints FROM tbl_user WHERE usr_typ != 1";
$result = $conn->query($query);
if ($result) {
    $row = $result->fetch_assoc();
    $totalPoints = $row['totalPoints'];
} else {
    $totalPoints =  0;
}
?>
<div class="stats shadow rounded-md bg-bgbox">
    <div class="stat p-2">
        <div class="stat-figure text-bgtext">
            <i data-lucide="coins"></i>
        </div>
        <div class="stat-title text-[12px]">Total Points Earn</div>
        <div class="divide-y divide-bgdevider">
            <div class="font-bold text-md"><?php echo $totalPoints; ?></div>
            <div class="flex flex-row items-center gap-1">
                <div class="stat-desc text-[10px]">by all user's</div><i data-lucide="user" class="w-3 h-3 "></i>
            </div>
        </div>
    </div>
</div>