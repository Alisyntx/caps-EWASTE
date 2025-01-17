<?php
// Database connection
include '../../../../database/conn.php';

// Query to get the count of recycled items per item and per month
$query = "
    SELECT 
        hry_rcy_item AS item_name,
        CONCAT(MONTHNAME(hry_rcy_date), ' ', YEAR(hry_rcy_date)) AS month, 
        COUNT(*) AS recycle_count
    FROM 
        tbl_rcnt_hry
    WHERE
        hry_activity = 'Recycle Accepted'
    GROUP BY 
        hry_rcy_item, MONTH(hry_rcy_date), YEAR(hry_rcy_date)
    ORDER BY 
        hry_rcy_item, YEAR(hry_rcy_date), MONTH(hry_rcy_date);
";

$result = $conn->query($query);

// Initialize data structure for Chart.js
$labels = [];
$items = [];

// Process the result
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $itemName = $row['item_name'];  // Use 'item_name' as defined in the SELECT alias
        $month = $row['month'];
        $recycleCount = $row['recycle_count'];

        // Add month to labels if not already present
        if (!in_array($month, $labels)) {
            $labels[] = $month;
        }

        // Organize data by item name
        if (!isset($items[$itemName])) {
            $items[$itemName] = [];
        }
        $items[$itemName][$month] = $recycleCount;
    }
}

// Prepare the final dataset for Chart.js
$datasets = [];
foreach ($items as $itemName => $counts) {
    $dataset = [
        'label' => $itemName,
        'data' => [],
        'backgroundColor' => '#84da63', // Light background color for the line
        'borderColor' => '#d03839', // Line color
        'borderWidth' => 1, // Adjust thickness if needed
        'fill' => false, // Ensure the area under the line is not filled
        'borderRadius' => 20,
       
    ];

    // Populate dataset with counts per month, aligning with $labels
    foreach ($labels as $month) {
        // Only include data for months that exist in the current item
        $dataset['data'][] = isset($counts[$month]) ? $counts[$month] : 0; // Set to 0 if no data for the month
    }
    $datasets[] = $dataset;
}

// Output JSON for Chart.js
header('Content-Type: application/json');
echo json_encode(['labels' => $labels, 'datasets' => $datasets]);

$conn->close();
?>
