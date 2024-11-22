<?php
include '../../../../../database/conn.php';

// Check if form is submitted and the date is selected
if (isset($_POST['custom_date']) && !empty($_POST['custom_date'])) {
    // Get the selected date from the form
    $selectedDate = $_POST['custom_date'];

    // Extract the year and month from the selected date
    $year = date('Y', strtotime($selectedDate));
    $month = date('m', strtotime($selectedDate));
} else {
    // Default to current date if no date is selected
    $year = date('Y');
    $month = date('m');
}

// Prepare query to fetch all recycled items for the given month and year
$query = "
    SELECT hry_rcy_item AS item_name, COUNT(*) AS total_recycled, 
           DATE_FORMAT(hry_rcy_date, '%M %Y') AS recycled_month
    FROM tbl_rcnt_hry 
    WHERE YEAR(hry_rcy_date) = ? AND MONTH(hry_rcy_date) = ? 
          AND hry_activity = 'Recycle Accepted'
    GROUP BY item_name
    ORDER BY hry_rcy_date;  -- This will display items in the order they were recycled
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
    <!-- customs css -->
    <link href="../../../../../views/output.css" rel="stylesheet">
    <!-- fontss -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <title>Reports</title>
</head>

<div class="w-full h-full">
    <div class="h-auto w-auto mt-2 rounded-t-md font-popin text-center">
        Recycled Items for <?php echo date('F Y', strtotime("$year-$month-01")); ?>
    </div>
    <div class="overflow-x-auto p-2">
        <table class="table table-xs">
            <!-- Table Head -->
            <thead>
                <tr>
                    <th>#</th>
                    <th>Item</th>
                    <th>Total Recycled</th>
                </tr>
            </thead>
            <tbody>
            <?php
            // Check if there are results
            if ($result->num_rows > 0) {
                $rank = 1; // Initialize ranking
                while ($row = $result->fetch_assoc()) {
                    $itemName = $row['item_name']; // Item name
                    $totalRecycled = $row['total_recycled']; // Monthly recycled count
            ?>
                <tr>
                    <th><?php echo $rank++; ?></th> <!-- Display rank -->
                    <td class="font-popin"><?php echo htmlspecialchars($itemName); ?></td>
                    <td class="font-popin"><?php echo htmlspecialchars($totalRecycled); ?> recycled</td>
                </tr>
            <?php
                }
            } else {
                echo '<tr><td colspan="3">No data available for this month</td></tr>';
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
<script src="../src/admin/js/scriptRwd.js"></script><script type="module" src="../src/admin/js/main.js"></script>

