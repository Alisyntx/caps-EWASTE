<?php
// Set timezone
date_default_timezone_set('Asia/Manila');



// Query to fetch all data from tbl_rwd_storage
$query = "
    SELECT 
        rwd_stg_id, 
        rwd_stg_user, 
        rwd_stg_username, 
        rwd_stg_item, 
        rwd_stg_trans, 
        rwd_stg_points, 
        rwd_stg_refnum, 
        DATE_FORMAT(rwd_stg_dateAdd, '%M %d, %Y') AS formatted_date 
    FROM tbl_rwd_storage
";
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../../../../views/output.css" rel="stylesheet">
    <title>Reward Storage Data</title>
</head>

<body>
    <div class="w-full h-full">
        <div class="h-auto w-auto mt-2 rounded-t-md font-popin text-center">
            Reward Storage Records
        </div>
        <div class="overflow-x-auto p-2">
            <table class="table table-xs">
                <!-- Table Head -->
                <thead>
                    <tr>
                        <th>#</th>
                        <th>User ID</th>
                        <th>Username</th>
                        <th>Item</th>
                        <th>Transaction</th>
                        <th>Points</th>
                        <th>Reference Number</th>
                        <th>Date Added</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                // Check if there are results
                if ($result->num_rows > 0) {
                    $rank = 1; // Initialize row counter
                    while ($row = $result->fetch_assoc()) {
                        $id = $row['rwd_stg_id'];
                        $user = $row['rwd_stg_user'];
                        $username = $row['rwd_stg_username'];
                        $item = $row['rwd_stg_item'];
                        $transaction = $row['rwd_stg_trans'];
                        $points = $row['rwd_stg_points'];
                        $refnum = $row['rwd_stg_refnum'];
                        $dateAdded = $row['formatted_date'];
                ?>
                    <tr>
                        <th><?php echo $rank++; ?></th>
                        <td><?php echo htmlspecialchars($user); ?></td>
                        <td><?php echo htmlspecialchars($username); ?></td>
                        <td><?php echo htmlspecialchars($item); ?></td>
                        <td><?php echo htmlspecialchars($transaction); ?></td>
                        <td><?php echo htmlspecialchars($points); ?></td>
                        <td><?php echo htmlspecialchars($refnum); ?></td>
                        <td><?php echo htmlspecialchars($dateAdded); ?></td>
                    </tr>
                <?php
                    }
                } else {
                    echo '<tr><td colspan="8" class="text-center">No data available</td></tr>';
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>

<?php
// Close connection
$conn->close();
?>
</body>

</html>
