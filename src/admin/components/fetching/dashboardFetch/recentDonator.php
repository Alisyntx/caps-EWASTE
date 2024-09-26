<?php
$query = "SELECT u.usr_fname, u.usr_lname, e.ewst_name, r.rcntdnt_time FROM tbl_rcnt_dnt r INNER JOIN tbl_user u ON r.rcntdnt_user = u.usr_id INNER JOIN tbl_ewst e ON r.rcntdnt_ewst = e.ewst_id WHERE u.usr_typ != 1 ORDER BY r.rcntdnt_time DESC LIMIT 10";
$result = $conn->query($query);
$recentDonators = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        // Calculate human-readable time difference
        $rcntdnt_time = new DateTime($row['rcntdnt_time']);
        $current_time = new DateTime();
        $interval = $current_time->diff($rcntdnt_time);

        if ($interval->y > 0) {
            $time_ago = $interval->format('%y year(s) ago');
        } elseif ($interval->m > 0) {
            $time_ago = $interval->format('%m month(s) ago');
        } elseif ($interval->d > 0) {
            $time_ago = $interval->format('%d day(s) ago');
        } elseif ($interval->h > 0) {
            $time_ago = $interval->format('%h hour(s) ago');
        } elseif ($interval->i > 0) {
            $time_ago = $interval->format('%i minute(s) ago');
        } else {
            $time_ago = 'Just now';
        }
        // Append formatted time to the row
        $row['rcntdnt_time'] = $time_ago;

        $recentDonators[] = $row;
    }
} else {
    echo "ERROR EXECUTING" . $conn->error;
    $recentDonators = [];
}
?>
<div class="w-[50%] h-full shadow-md card rounded-md bg-bgbox">
    <div class=" flex gap-1 items-center ">
        <div class="font-popin p-1 font-light text-[15px]">Recent Donators</div>
        <i data-lucide="history" class="w-6 h-6 text-bgtext"></i>
    </div>
    <div class="overflow-x-auto">
        <table class="table table-xs">
            <thead>
                <tr>
                    <th></th>
                    <th>name</th>
                    <th>donate</th>
                    <th>Date/time</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $count = 1;
                foreach ($recentDonators as $rDonators) {
                ?>
                    <tr>
                        <th><?php echo $count++; ?></th>
                        <td><?php echo htmlspecialchars($rDonators['usr_fname']) . " " . htmlspecialchars($rDonators['usr_lname']); ?></td>
                        <td><?php echo htmlspecialchars($rDonators['ewst_name']) ?></td>
                        <td class="text-[10px] font-light"><?php echo htmlspecialchars($rDonators['rcntdnt_time']) ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>