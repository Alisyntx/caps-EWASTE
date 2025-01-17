<?php
// Set timezone
date_default_timezone_set('Asia/Manila');

// Include database connection
include '../../../../../database/conn.php';

// Check if a custom date is submitted
if (isset($_POST['custom_date']) && !empty($_POST['custom_date'])) {
    $selectedDate = $_POST['custom_date'];
    $year = date('Y', strtotime($selectedDate));
    $month = date('m', strtotime($selectedDate));
} else {
    $year = date('Y');
    $month = date('m');
}

// Query to fetch recycled items for the selected month and year
$queryItems = "
    SELECT 
        hry_rcy_item AS item_name, 
        COUNT(*) AS total_recycled 
    FROM 
        tbl_rcnt_hry 
    WHERE 
        YEAR(hry_rcy_date) = ? 
        AND MONTH(hry_rcy_date) = ? 
        AND hry_activity = 'Recycle Accepted' 
    GROUP BY 
        hry_rcy_item 
    ORDER BY 
        total_recycled DESC;
";

$stmt = $conn->prepare($queryItems);
$stmt->bind_param("ii", $year, $month);
$stmt->execute();
$resultItems = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../../../../views/output.css" rel="stylesheet">
    <title>Custom Date Report</title>
</head>
<style>
    @media print {
    /* Hide all navigation, buttons, etc. */
    .no-print {
        display: none;
    }
}

</style>
<body>
    <div class="w-full h-full p-2 bg-gray-100">
        <h1 class="text-2xl font-bold text-center mb-6">
            Recycled Items for <?php echo date('F Y', strtotime("$year-$month-01")); ?>
        </h1>

        <div class="flex flex-col gap-6">
            <?php
            if ($resultItems->num_rows > 0) {
                while ($item = $resultItems->fetch_assoc()) {
                    $itemName = htmlspecialchars($item['item_name']);
                    $totalRecycled = $item['total_recycled'];
                    ?>
                    <div class="bg-white rounded-md border border-bgborder border-opacity-50 mt-2 p-4">
                        <div class="text-lg font-semibold border-b pb-2 mb-4">
                            <span class="font-medium">Item:</span> <?php echo $itemName; ?>
                            <span class="text-sm text-gray-500">(Recycled <?php echo $totalRecycled; ?> times)</span>
                        </div>
                        <?php
                        // Updated query to fetch students who recycled this item
                        $queryStudents = "
                            SELECT 
                                u.usr_fname, 
                                u.usr_lname, 
                                h.hry_refnum AS ref_num, 
                                h.hry_brand AS brand, 
                                h.hry_rcy_pts AS points, 
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
                                AND YEAR(h.hry_rcy_date) = ?
                                AND MONTH(h.hry_rcy_date) = ?
                            ORDER BY 
                                h.hry_rcy_date;
                        ";

                        $stmtStudents = $conn->prepare($queryStudents);
                        $stmtStudents->bind_param("sii", $itemName, $year, $month);
                        $stmtStudents->execute();
                        $resultStudents = $stmtStudents->get_result();

                        if ($resultStudents->num_rows > 0) {
                            ?>
                            <div class="overflow-x-auto">
                                <table class="table table-xs w-full text-left">
                                    <thead class="bg-gray-200">
                                        <tr>
                                            <th class="px-4 py-2">Student Name</th>
                                            <th class="px-4 py-2">Brand</th>
                                            <th class="px-4 py-2">Ref No.</th>
                                            <th class="px-4 py-2">Points</th>
                                            <th class="px-4 py-2">Date Recycled</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($student = $resultStudents->fetch_assoc()) {
                                            ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($student['usr_fname'] . ' ' . $student['usr_lname']); ?></td>
                                                <td><?php echo htmlspecialchars($student['brand']); ?></td>
                                                <td><?php echo htmlspecialchars($student['ref_num']); ?></td>
                                                <td><?php echo htmlspecialchars($student['points']); ?> points</td>
                                                <td><?php echo htmlspecialchars($student['date']); ?></td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php
                        } else {
                            echo '<p>No students have recycled this item yet.</p>';
                        }
                        $stmtStudents->close();
                        ?>
                    </div>
                    <?php
                }
            } else {
                echo '<p>No recycled items found for this month.</p>';
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
