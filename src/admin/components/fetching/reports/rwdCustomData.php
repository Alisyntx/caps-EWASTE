<?php
include '../../../../../database/conn.php';

// Check if form is submitted and the date is selected
if (isset($_POST['customRwdDate']) && !empty($_POST['customRwdDate'])) {
    // Get the selected date from the form
    $selectedDate = $_POST['customRwdDate'];

    // Extract the year and month from the selected date
    $year = date('Y', strtotime($selectedDate));
    $month = date('m', strtotime($selectedDate));
} else {
    // Default to current date if no date is selected
    $year = date('Y');
    $month = date('m');
}

// Prepare query to fetch all redeemed items for the given month and year from tbl_rwd_storage
$query = "
    SELECT rwd_stg_item AS item_name, COUNT(*) AS total_redeemed, 
           DATE_FORMAT(rwd_stg_dateAdd, '%M %Y') AS redeemed_month
    FROM tbl_rwd_storage 
    WHERE YEAR(rwd_stg_dateAdd) = ? AND MONTH(rwd_stg_dateAdd) = ?
    GROUP BY rwd_stg_item
    ORDER BY rwd_stg_dateAdd;
";

// Prepare the statement
$stmt = $conn->prepare($query);
$stmt->bind_param("ii", $year, $month);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../../../../views/output.css" rel="stylesheet">
    <title>Redeemed Items Report</title>
    <style>
        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="w-full h-full p-2 bg-gray-100">
        <h1 class="text-2xl font-bold text-center mb-6">
            Redeemed Items for <?php echo date('F Y', strtotime("$year-$month-01")); ?>
        </h1>

        <div class="flex flex-col gap-6">
            <?php
            // Check if there are results
            if ($result->num_rows > 0) {
                $rank = 1; // Initialize ranking
                while ($row = $result->fetch_assoc()) {
                    $itemName = $row['item_name']; // Item name
                    $totalRedeemed = $row['total_redeemed']; // Monthly redeemed count
                    ?>
                    <div class="bg-white rounded-md border border-bgborder border-opacity-50 mt-2 p-4">
                        <div class="text-lg font-semibold border-b pb-2 mb-4">
                            <span class="font-medium">Item:</span> <?php echo htmlspecialchars($itemName); ?>
                            <span class="text-sm text-gray-500">(Redeemed <?php echo $totalRedeemed; ?> times)</span>
                        </div>
                        <?php
                        // Updated query to fetch users who redeemed this item
                        $queryUsers = "
                            SELECT 
                                rwd_stg_user AS user_id, 
                                rwd_stg_username AS username, 
                                rwd_stg_refnum AS ref_num, 
                                rwd_stg_points AS points, 
                                rwd_stg_dateAdd AS date_redeemed 
                            FROM 
                                tbl_rwd_storage 
                            WHERE 
                                rwd_stg_item = ? 
                                AND YEAR(rwd_stg_dateAdd) = ? 
                                AND MONTH(rwd_stg_dateAdd) = ? 
                            ORDER BY 
                                rwd_stg_dateAdd;
                        ";

                        $stmtUsers = $conn->prepare($queryUsers);
                        $stmtUsers->bind_param("sii", $itemName, $year, $month);
                        $stmtUsers->execute();
                        $resultUsers = $stmtUsers->get_result();

                        if ($resultUsers->num_rows > 0) {
                            ?>
                            <div class="overflow-x-auto">
                                <table class="table table-xs w-full text-left">
                                    <thead class="bg-gray-200">
                                        <tr>
                                            <th class="px-4 py-2">Username</th>
                                            <th class="px-4 py-2">Ref No.</th>
                                            <th class="px-4 py-2">Points</th>
                                            <th class="px-4 py-2">Date Redeemed</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($user = $resultUsers->fetch_assoc()) {
                                            ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($user['username']); ?></td>
                                                <td><?php echo htmlspecialchars($user['ref_num']); ?></td>
                                                <td><?php echo htmlspecialchars($user['points']); ?> points</td>
                                                <td><?php echo htmlspecialchars($user['date_redeemed']); ?></td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php
                        } else {
                            echo '<p>No users have redeemed this item yet.</p>';
                        }
                        $stmtUsers->close();
                        ?>
                    </div>
                    <?php
                }
            } else {
                echo '<p>No redeemed items found for this month.</p>';
            }
            $stmt->close();
            $conn->close();
            ?>
        </div>
    </div>

    <script>
        // Automatically trigger the print dialog when the page loads
        window.onload = function() {
            window.print();
        };
    </script>
</body>
</html>
