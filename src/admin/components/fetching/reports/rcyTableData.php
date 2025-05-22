<?php
// Set timezone to ensure consistency
date_default_timezone_set('Asia/Manila');

// Query to fetch items with the total number of times they were recycled
$queryItems = "
    SELECT 
        hry_rcy_item AS item_name, 
        COUNT(*) AS recycle_count 
    FROM 
        tbl_rcnt_hry 
    WHERE 
        hry_activity = 'Recycle Accepted' 
    GROUP BY 
        hry_rcy_item 
    ORDER BY 
        recycle_count DESC;
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

        <title>Recycled Items by Students</title>
    </head>

    <body>
        <div class="w-full h-full p-2 bg-gray-100">
            <h1 class="text-2xl font-bold text-center mb-6">Most Recycled Items</h1>

            <div class="flex flex-col gap-6">
                <?php
                // Loop through each recycled item
                while ($item = $resultItems->fetch_assoc()) {
                    $itemName = htmlspecialchars($item['item_name']);
                    $recycleCount = $item['recycle_count'];

                    // Query to fetch students who recycled this item
                    $queryStudents = "
                        SELECT 
                            u.usr_fname, 
                            u.usr_lname, 
                            h.hry_refnum AS ref_num,
                            h.hry_brand AS brand, 
                            h.hry_rcy_item AS item, 
                            h.hry_rcy_pts AS points,
                            h.hry_approvers as approver,
                            h.hry_rcy_date AS date 
                        FROM 
                            tbl_user u 
                        JOIN 
                            tbl_rcnt_hry h 
                        ON 
                            u.usr_id = h.hry_user_id 
                        WHERE 
                            h.hry_rcy_item = ? 
                            AND h.hry_activity = 'Recycle Accepted'
                        ORDER BY 
                            u.usr_lname, u.usr_fname;
                    ";
                    $stmtStudents = $conn->prepare($queryStudents);
                    $stmtStudents->bind_param("s", $itemName);
                    $stmtStudents->execute();
                    $resultStudents = $stmtStudents->get_result();

                    ?>
                    <!-- Recycled Item Card -->
                    <div class="bg-white rounded-md border border-bgborder border-opacity-50 mt-2 p-4">
                        <div class="text-lg font-semibold border-b pb-2 mb-4">
                            <span class="font-medium">Item:</span> <?php echo $itemName; ?> 
                            <span class="text-sm text-gray-500">(Recycled <?php echo $recycleCount; ?> times)</span>
                        </div>

                        <?php
                        if ($resultStudents->num_rows > 0) {
                            ?>
                            <div class="overflow-x-auto">
                                <table class="table table-xs w-full text-left">
                                    <thead class="bg-gray-200">
                                        <tr>
                                            <th class="px-4 py-2">Student Name</th>
                                            <th class="px-4 py-2">Item Name</th>
                                            <th class="px-4 py-2">Brand and Model Name</th>
                                            <th class="px-4 py-2">Ref No.</th>
                                            <th class="px-4 py-2">Points</th>
                                            <th class="px-4 py-2">Approvers</th>
                                            <th class="px-4 py-2">Date Recycled</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    while ($student = $resultStudents->fetch_assoc()) {
                                        ?>
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-4 py-2"><?php echo htmlspecialchars($student['usr_fname'] . ' ' . $student['usr_lname']); ?></td>
                                            <td class="px-4 py-2"><?php echo htmlspecialchars($student['item']); ?></td>
                                            <td class="px-4 py-2"><?php echo htmlspecialchars($student['brand']); ?></td>
                                            <td class="px-4 py-2"><?php echo htmlspecialchars($student['ref_num']); ?></td>
                                            <td class="px-4 py-2"><?php echo htmlspecialchars($student['points']); ?> points</td>
                                            <td class="px-4 py-2"><?php echo htmlspecialchars($student['approver']); ?></td>
                                            <td class="px-4 py-2"><?php echo htmlspecialchars($student['date']); ?></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php
                        } else {
                            echo '<p class="text-gray-500 text-sm text-center">No students have recycled this item yet.</p>';
                        }

                        // Close the statement
                        $stmtStudents->close();
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
    echo "<p>No recycled items found in the database.</p>";
}
?>
