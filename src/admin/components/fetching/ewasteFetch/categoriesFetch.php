<?php
include '../database/conn.php';
$category_query = $conn->query("SELECT * FROM tbl_category");
?>
<!-- Filter Buttons for Each Category -->
<div class="filter-buttons flex justify-start mb-5 bg-bgbox mt-2 p-2 rounded-md">
    <button class="filter-btn btn btn-xs mx-2 font-popin font-normal text-xs shadow-md" data-category-id="all">Show All</button>
    <?php while ($category_data = mysqli_fetch_array($category_query)) { ?>
        <button class="filter-btn btn font-popin font-normal shadow-md text-xs btn-xs mx-2" data-category-id="category-<?php echo $category_data['cty_id']; ?>">
            <?php echo $category_data['cty_name']; ?>
        </button>
    <?php } ?>

</div>

<!-- Categories List -->
<?php
$category_query = $conn->query("SELECT * FROM tbl_category");
while ($category_data = mysqli_fetch_array($category_query)) {
?>
    <div class="category-box mt-2 mb-5 bg-bgbox border border-bgcard border-1 w-full h-auto rounded-md flex flex-col gap-1 shadow-md divide-y divide-bgborder ctyIds" id="category-<?php echo $category_data['cty_id']; ?>">
        <div class="p-1 flex justify-between">
            <button class="btn bg-mainbg shadow-md font-poppin bg-transparent rounded-md btn-xs text-bgtext text-xs font-popin">
                <?php echo $category_data['cty_name']; ?>
            </button>
            <div>
                <button class="btn btn-xs btn-circle bg-mainbg shadow-md font-poppin bg-transparent text-center text-bgtext text-xs font-popin delCty" id="<?php echo $category_data['cty_id']; ?>" onclick="delCty.showModal()"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
                <button class="btn btn-xs btn-circle bg-mainbg shadow-md font-poppin bg-transparent text-center text-bgtext text-xs font-popin addItemCtyId" id="<?php echo $category_data['cty_id']; ?>" onclick="addItemCty.showModal()"><i data-lucide="list-plus" class="w-4 h-4"></i></button>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="table table-xs">
                <thead>
                    <tr>
                      
                        <th>Name</th>
                        <th>Condition</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="itemList">
                    <?php
                    $item_query = "SELECT * FROM tbl_ewst WHERE ewst_ctyfk = " . $category_data['cty_id'];
                    $result = $conn->query($item_query);
                    if ($result->num_rows > 0) {
                        $counting = 1;
                        while ($items = $result->fetch_assoc()) {
                    ?>
                            <tr class="itemids" id="item-<?php echo $items['ewst_id']; ?>">  
                                <td>
                                    <div class="flex items-center gap-3">
                                        <div class="avatar">
                                            <div class="mask mask-squircle w-10">
                                                <img src="http://localhost/ewasteCapstone/storage/<?php echo $items['ewst_img']; ?>" alt="tsk" />
                                            </div>
                                        </div>
                                        <div>
                                            <div class="font-bold font-popin"><?php echo $items['ewst_name']; ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="">
                                    <div class="btn checkPoints h-auto bg-mainbg border border-bgcard border-1 p-2 font-poppin bg-transparent rounded-md font-popin w-72" onclick="editPoints.showModal()" id="<?php echo $items['ewst_id']; ?>">
                                        <div class=" flex flex-row justify-between">
                                            <div class="flex flex-col items-start font-normal">
                                                <div>Good Condition</div>
                                                <div>Partially Damage</div>
                                                <div>Fully Damage</div>
                                            </div>
                                            <div class="mx-3">
                                                <div class="font-medium"><?php echo $items['ewst_gcon'] ?> points</div>
                                                <div class="font-medium"><?php echo $items['ewst_pdam'] ?> points</div>
                                                <div class="font-medium"><?php echo $items['ewst_fdam'] ?> points</div>
                                            </div>
                                        </div>

                                    </div>

                                </td>
                                <td>
                                    <button class="editItems btn bg-mainbg shadow-md font-poppin bg-transparent btn-circle btn-xs font-popin mx-2" onclick="editItems.showModal()" id="<?php echo $items['ewst_id']; ?>">
                                        <i data-lucide="square-pen" class="w-4 h-4 text-error"></i>
                                        
                                    </button>
                                    <button class="deleteItems btn bg-mainbg shadow-md bg-transparent btn-circle btn-xs font-popin" onclick="delItems.showModal()" id="<?php echo $items['ewst_id']; ?>">
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