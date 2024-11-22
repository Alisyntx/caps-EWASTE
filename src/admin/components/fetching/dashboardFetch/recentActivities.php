<?php 
// Get the current date
$currentDate = date('Y-m-d');

// Query to fetch recent activities from the history table for the current day
$activityQuery = "SELECT hry_rcy_item, hry_activity, hry_rcy_date, hry_rcy_id 
                  FROM tbl_rcnt_hry 
                  WHERE DATE(hry_rcy_date) = ?";

$recentActivities = [];

if ($stmt = $conn->prepare($activityQuery)) {
    $stmt->bind_param('s', $currentDate); // Bind the current date
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $recentActivities[] = $row;
    }

    $stmt->close();
}
?>

<div class="flex gap-1">
    <div class="font-popin p-1 font-light text-[15px]">Recent Activities</div>
    <i data-lucide="history" class="w-6 h-6 text-bgtext"></i>
</div>
<div class="w-full card rounded-md flex shadow overflow-x-auto h-[90%]">
    <div class="overflow-x-auto bg-bgbox">
        <?php if (!empty($recentActivities)): ?>
            <table class="table table-xs">
                <!-- head -->
                <thead>
                    <tr>
                        <th></th>
                        <th>Date</th>
                        <th>Activity</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($recentActivities as $activity): ?>
                        <?php 
                        // Format the date
                        $formattedDate = date('m/d/y h:i A', strtotime($activity['hry_rcy_date'])); 
                        ?>
                        <tr>
                            <th>
                                <button class="btn btn-xs btn-circle btn-ghost viewRcntActBtn" 
                                        onclick="showRcntAct.showModal()" 
                                        id="<?= $activity['hry_rcy_id']; ?>">
                                    <i data-lucide="info" class="w-4 h-4 text-error"></i>
                                </button>
                            </th>
                            <td class="font-light text-[10px]"><?= $formattedDate; ?></td>
                            <td class="font-light"><?= htmlspecialchars($activity['hry_activity'], ENT_QUOTES, 'UTF-8'); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="p-2 text-center text-sm">
                No activities recorded for today.
            </div>
        <?php endif; ?>
    </div>
</div>

