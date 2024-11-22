<?php
include '../database/conn.php';
// Get distinct items from tbl_storage
$item_query = $conn->query("SELECT DISTINCT stg_item FROM tbl_storage");
?>
<!-- Filter Buttons for Each Item -->
<div class="filter-buttons flex justify-start mb-5 bg-bgbox mt-2 p-2 rounded-md border items-center border-bgborder border-opacity-50">
    <i data-lucide="filter" class="w-5 h-5"></i>
    <button class="filter-btn btn btn-xs mx-2 font-popin font-normal text-xs shadow-sm" data-item="all">Show All</button>
    <?php while ($item_data = mysqli_fetch_array($item_query)) { ?>
        <button class="filter-btn btn font-popin font-normal shadow-md text-xs btn-xs mx-2" data-item="<?php echo $item_data['stg_item']; ?>">
            <?php echo $item_data['stg_item']; ?>
        </button>
    <?php } ?>
</div>

<!-- Item List -->
<div class="category-box mt-2 mb-5 bg-bgbox border border-bgcard border-1 w-full h-auto rounded-md flex flex-col shadow-md divide-y divide-bgborder">
    <div class="overflow-x-auto">
        <table id="dataTbl" class="table table-xs">
            <thead>
                <tr>
                    <th>Ref Num</th>
                    <th>Username</th>
                    <th>Name</th>
                    <th>Item</th>
                    <th>Points</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody id="itemList">
                <?php
                $item_query = "SELECT * FROM tbl_storage";
                $result = $conn->query($item_query);
                if ($result->num_rows > 0) {
                    while ($items = $result->fetch_assoc()) {
                        $formatted_date = date('Y-m-d', strtotime($items['stg_dateAdd']));
                ?>
                        <tr class="item-row" data-item="<?php echo $items['stg_item']; ?>">
                            <td>
                                <div class="font-semibold"><?php echo $items['stg_refnum']; ?></div>
                            </td>
                            <td>
                                <div class="font-semibold"><?php echo $items['stg_usrname']; ?></div>
                            </td>
                            <td>
                                <div class="">
                                    <div class="font-semibold"><?php echo $items['stg_user']; ?></div>
                                </div>
                            </td>
                            <td class="">
                                <div class="font-semibold"><?php echo $items['stg_item']; ?></div>
                            </td>
                            <td class="">
                                <div class="font-semibold"><?php echo $items['stg_points']; ?> points</div>
                            </td>
                            <td class="">
                                <div class="font-semibold"><?php echo $formatted_date ?></div>
                            </td>
                        </tr>
                <?php
                    }
                } else {
                    echo "<tr><td colspan='4' class='text-center'>No items</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    lucide.createIcons(); // For rendering icons

    // Add event listener for filter buttons
    const filterButtons = document.querySelectorAll('.filter-btn');
    const itemRows = document.querySelectorAll('.item-row');

    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            const selectedItem = this.getAttribute('data-item');

            itemRows.forEach(row => {
                if (selectedItem === 'all') {
                    row.style.display = ''; // Show all items
                } else if (row.getAttribute('data-item') === selectedItem) {
                    row.style.display = ''; // Show only rows with the selected item
                } else {
                    row.style.display = 'none'; // Hide rows that don't match the selected item
                }
            });
        });
    });
</script>