<?php
include '../database/conn.php';
$category_query = $conn->query("SELECT * FROM tbl_catalog");
?>
<!-- Filter Buttons for Each catalog -->
<div class="overflow-x-auto filter-buttons flex justify-start mb-2 bg-bgbox mt-2 p-2 rounded-md">
    <button class="filter-btn btn btn-xs mx-2 font-popin font-normal text-xs shadow-md" data-category-id="all">Show All</button>

    <?php while ($category_data = mysqli_fetch_array($category_query)) { ?>
        <button class="filter-btn btn font-popin font-normal shadow-md text-xs btn-xs mx-2" data-category-id="catalog-<?php echo $category_data['ctg_id']; ?>">
            <?php echo $category_data['ctg_name']; ?>
        </button>
    <?php } ?>

</div>

<!-- catalog List -->
<?php
$category_query = $conn->query("SELECT * FROM tbl_catalog");
while ($category_data = mysqli_fetch_array($category_query)) {
?>
    <div class=" category-box mb-5 bg-bgbox border border-bgcard border-1 w-full h-auto rounded-md flex flex-col gap-1 shadow-md divide-y divide-bgborder ctgIds" id="catalog-<?php echo $category_data['ctg_id']; ?>">
        <div class="p-1 flex justify-between">
            <button class="btn bg-mainbg shadow-md font-poppin bg-transparent rounded-md btn-xs text-bgtext text-xs font-popin">
                <?php echo $category_data['ctg_name']; ?>
                
            </button>
            <div>
                <button class="btn btn-xs btn-circle bg-mainbg shadow-md font-poppin bg-transparent text-center text-bgtext text-xs font-popin delCtg" id="<?php echo $category_data['ctg_id']; ?>" onclick="delCtg.showModal()"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
                <button class="btn btn-xs btn-circle bg-mainbg shadow-md font-poppin bg-transparent text-center text-bgtext text-xs font-popin addItemCtgId" id="<?php echo $category_data['ctg_id']; ?>" onclick="addItemCtg.showModal()"><i data-lucide="list-plus" class="w-4 h-4"></i></button>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="table table-xs">
                <thead>
                    <tr>

                        <th>Item</th>
                        <th>Reward Points</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="itemList">
                    <?php
                    $item_query = "SELECT * FROM tbl_rwd_items WHERE rwd_ctg = " . $category_data['ctg_id'];
                    $result = $conn->query($item_query);
                    if ($result->num_rows > 0) {
                        $counting = 1;
                        while ($items = $result->fetch_assoc()) {
                    ?>
                            <tr class="itemids  animate__animated animate__fadeIn" id="item-<?php echo $items['rwd_id']; ?>">

                                <td>
                                    <div class="flex items-center gap-3">
                                        <div class="avatar">
                                            <div class="mask mask-squircle w-10">
                                                <img src="http://localhost/ewasteCapstone/storage/<?php echo $items['rwd_img']; ?>" alt="tsk" />
                                            </div>
                                        </div>
                                        <div>
                                            <div class="font-bold font-popin"><?php echo $items['rwd_name']; ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="">
                                    <div class="btn btn-ghost bg-transparent checkPoints h-auto font-poppin  rounded-md font-popin w-72" onclick="editPoints.showModal()" id="<?php echo $items['rwd_id']; ?>">
                                        <div class=" bg-mainbg border border-bgcard border-1 bg-transparent shadow-md rounded-md p-1 flex flex-col justify-between text-xs">
                                            <div class="flex flex-row  w-auto font-normal">
                                                <div class="font-popin font-bold">Points: </div>
                                                <div class=" mx-1 font-medium"><?php echo $items['rwd_points'] ?></div>
                                            </div>
                                            <div class="flex flex-row  w-auto font-normal">
                                                <div class="font-popin font-bold">Description: </div>
                                                <div class=" mx-1 font-medium"><?php echo $items['rwd_desc'] ?></div>
                                            </div>

                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <button class="editCtgItems btn bg-mainbg shadow-md font-poppin bg-transparent btn-circle btn-xs font-popin mx-2" onclick="editItemCtg.showModal()" id="<?php echo $items['rwd_id']; ?>">
                                        <i data-lucide="square-pen" class="w-4 h-4 text-bgborder"></i>  
                                    </button>
                                    <button class="deleteCtgItems btn bg-mainbg shadow-md bg-transparent btn-circle btn-xs font-popin" onclick="delCtgItems.showModal()" id="<?php echo $items['rwd_id']; ?>">
                                        <i data-lucide="trash-2" class="w-4 h-4 text-error"></i>        
                                    </button>

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
<?php } ?>
<script>
    lucide.createIcons(); // For rendering icons

    // Add event listener for filter buttons
    const filterButtons = document.querySelectorAll('.filter-btn');
    const categoryBoxes = document.querySelectorAll('.category-box');

    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            const categoryId = this.getAttribute('data-category-id');

            categoryBoxes.forEach(box => {
                if (categoryId === 'all') {
                    box.style.display = 'block'; // Show all categories
                } else if (box.id === categoryId) {
                    box.style.display = 'block'; // Show only the selected category
                } else {
                    box.style.display = 'none'; // Hide other categories
                }
            });
        });
    });
</script>