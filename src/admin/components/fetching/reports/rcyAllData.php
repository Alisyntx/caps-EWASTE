<?php
// Set timezone to ensure date consistency
date_default_timezone_set('Asia/Manila'); // Adjust if necessary

// Prepare query to fetch all recycled items
$query = "
    SELECT hry_rcy_item AS item_name, 
           DATE_FORMAT(hry_rcy_date, '%M %d, %Y') AS recycled_date, 
           hry_rcy_pts AS item_points,
           hry_refnum as ref_num, 
           hry_user as student_name,
           hry_brand as brand_name
    FROM tbl_rcnt_hry 
    WHERE hry_activity = 'Recycle Accepted'
    ORDER BY hry_rcy_date;
";

// Prepare and execute the query
$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->get_result();
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

    <title>Recycled Items Report</title>
</head>

<body>
    <div class="w-full h-full">
        <div class="h-auto w-auto mt-2 rounded-t-md font-popin text-center">
           All Recycled Items
        </div>
        <div class="overflow-x-auto p-2">
            <table class="table table-xs">
                <!-- Table Head -->
                <thead>
                    <tr>
                        <th>Ref No.</th>
                        <th>Student</th>
                        <th>Item</th>
                        <th>Brand and Model</th>
                        <th>Points</th>
                        <th>Recycled Date</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                // Check if there are results
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $itemName = $row['item_name']; // Item name
                        $brandName = $row['brand_name']; // brand and model name
                        $itemPoints = $row['item_points']; // Item points
                        $recycledDate = $row['recycled_date']; // Recycled date
                        $studentName = $row['student_name'];
                        $refNum = $row['ref_num']; // reference number
                ?>
                    <tr>
                        <th><?php echo htmlspecialchars($refNum); ?></th>
                        <td class="font-popin"><?php echo htmlspecialchars($studentName); ?></td>
                        <td class="font-popin"><?php echo htmlspecialchars($itemName); ?></td>           
                        <td class="font-popin"><?php echo htmlspecialchars($brandName); ?></td>           
                        <td class="font-popin"><?php echo htmlspecialchars($itemPoints); ?> points</td>
                        <td class="font-popin"><?php echo htmlspecialchars($recycledDate); ?></td>
                    </tr>
                <?php
                    }
                } else {
                    echo '<tr><td colspan="5" class="text-center">No data available</td></tr>';
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>

<?php
// Close the statement and connection
$stmt->close();
$conn->close();
?>
<script>
    // Automatically trigger the print dialog when the page loads
    window.onload = function() {
        window.print();
    };
</script>
</body>

</html>
<script src="../src/admin/js/scriptRwd.js"></script>
<script type="module" src="../src/admin/js/main.js"></script>
