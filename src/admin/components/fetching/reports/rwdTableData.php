<?php
// Query to fetch all recycled items from tbl_ewst, sorted by most recycled
$query = " SELECT rwd_name, rwd_redeemed FROM tbl_rwd_items ORDER BY rwd_redeemed DESC;";

$result = $conn->query($query);

// Start outputting HTML
?>

<div class="w-full h-full">
    <div class=" h-auto w-auto mt-2 rounded-t-md font-popin text-center">Most Redeemed Item</div>
    <div class="overflow-x-auto p-2 ">
    <table class="table table-xs">
        <!-- head -->
        <thead>
        <tr>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php
        // Check if there are results
        if ($result->num_rows > 0) {
            $rank = 1;  // Initialize ranking
            while ($row = $result->fetch_assoc()) {
                $itemName = $row['rwd_name']; // Item name
                $recycledCount = $row['rwd_redeemed']; // Recycled count
        ?>
        <tr>
            <th><?php echo $rank++; ?></th> <!-- Display rank -->
            <td class="font-popin"><?php echo htmlspecialchars($itemName); ?></td>
            <td class="font-popin"><?php echo htmlspecialchars($recycledCount); ?> recycled</td>
        </tr>
        <?php
            }
        } else {
            echo '<tr><td colspan="3">No data available</td></tr>';
        }
        ?>
        </tbody>
    </table>
    </div>

    <?php
    // Close the database connection
    $conn->close();
    ?>

</div>

