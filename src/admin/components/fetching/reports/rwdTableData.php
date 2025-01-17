<?php
// Set timezone to ensure consistency
date_default_timezone_set('Asia/Manila');

// Query to fetch items with the total number of times they were redeemed
$queryItems = "
    SELECT 
        rwd_stg_item AS item_name, 
        COUNT(*) AS redeem_count 
    FROM 
        tbl_rwd_storage 
    GROUP BY 
        rwd_stg_item 
    ORDER BY 
        redeem_count DESC;
";

$resultItems = $conn->query($queryItems);

if ($resultItems->num_rows > 0) {
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Custom CSS -->
        <link href="../../../../../views/output.css" rel="stylesheet">
        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        <title>Most Redeemed Items</title>
    </head>

    <body>
        <div class="w-full h-full p-2 bg-gray-100">
            <h1 class="text-2xl font-bold text-center mb-6">Most Redeemed Items</h1>

            <div class="flex flex-col gap-6">
                <?php
                // Loop through each redeemed item
                while ($item = $resultItems->fetch_assoc()) {
                    $itemName = htmlspecialchars($item['item_name']);
                    $redeemCount = $item['redeem_count'];

                    // Query to fetch users who redeemed this item
                    $queryUsers = "
                        SELECT 
                            rwd_stg_username AS username,
                            rwd_stg_user AS user, 
                            rwd_stg_refnum AS ref_num, 
                            rwd_stg_points AS points, 
                            rwd_stg_dateAdd AS date_added 
                        FROM 
                            tbl_rwd_storage 
                        WHERE 
                            rwd_stg_item = ?
                        ORDER BY 
                            date_added DESC;
                    ";
                    $stmtUsers = $conn->prepare($queryUsers);
                    $stmtUsers->bind_param("s", $itemName);
                    $stmtUsers->execute();
                    $resultUsers = $stmtUsers->get_result();

                    ?>
                    <!-- Redeemed Item Card -->
                    <div class="bg-white rounded-md border border-bgborder border-opacity-50 mt-2 p-4">
                        <div class="text-lg font-semibold border-b pb-2 mb-4">
                            <span class="font-medium">Item:</span> <?php echo $itemName; ?> 
                            <span class="text-sm text-gray-500">(Redeemed <?php echo $redeemCount; ?> times)</span>
                        </div>

                        <?php
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
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-4 py-2"><?php echo htmlspecialchars($user['user']); ?></td>
                                            <td class="px-4 py-2"><?php echo htmlspecialchars($user['ref_num']); ?></td>
                                            <td class="px-4 py-2"><?php echo htmlspecialchars($user['points']); ?> points</td>
                                            <td class="px-4 py-2"><?php echo htmlspecialchars($user['date_added']); ?></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php
                        } else {
                            echo '<p class="text-gray-500 text-sm text-center">No users have redeemed this item yet.</p>';
                        }

                        // Close the statement
                        $stmtUsers->close();
                        ?>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>

        <?php
        // Close the database connection
        $conn->close();
        ?>
    </body>

    </html>
    <?php
} else {
    echo "<p>No redeemed items found in the database.</p>";
}
?>
