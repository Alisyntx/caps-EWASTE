<?php
$query = "SELECT usr_fname,usr_lname,usr_total_rwd FROM tbl_user WHERE usr_typ != 1 ORDER by usr_total_rwd DESC LIMIT 10";
$result = $conn->query($query);
$topDonors = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $topDonors[] = $row;
    }
} else {
    echo "Error executing query: " . $mysqli->error;
    $topDonors = [];
}
?>
<div class="w-[50%] h-full shadow-md card rounded-md bg-bgbox">
    <div class=" flex gap-1 ">
        <div class="font-popin p-1 font-light text-[15px]">Top Donors</div>
        <i data-lucide="crown" class="w-6 h-6 text-bgtext"></i>
    </div>
    <div class="overflow-x-auto">
        <table class="table table-xs">
            <thead>
                <tr>
                    <th></th>
                    <th>name</th>
                    <th>Points</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $rank = 1;
                if ($topDonors > 0) {
                    foreach ($topDonors as $donor) {
                ?>
                        <tr>
                            <th><?php echo $rank++ ?></th>
                            <td><?php echo htmlspecialchars($donor['usr_fname']) . " " . htmlspecialchars($donor['usr_lname']); ?></td>
                            <td><?php echo htmlspecialchars($donor['usr_total_rwd']) ?></td>
                        </tr>
                <?php }
                } else {
                    echo "<tr><td> NO DATA FOUND </td></tr>";
                } ?>
            </tbody>
        </table>
    </div>
</div>