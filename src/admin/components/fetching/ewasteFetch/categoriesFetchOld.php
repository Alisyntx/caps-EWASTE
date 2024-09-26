                <?php
                $category_query = $conn->query("SELECT * FROM tbl_category");
                while ($category_data = mysqli_fetch_array($category_query)) {
                ?>
                    <div class="flex flex-col ">
                        <div>
                            <button class="btn ml-2 btn-ghost float-left btn-sm w-auto font-normal font-popin tooltip tooltip-right tooltip-info btnTbl" data-tip="view as a table" onclick="modalTableDnt.showModal()" id="<?php echo $category_data['cty_id'] ?>"><?php echo $category_data['cty_name'] ?> >></button>
                        </div>
                        <div id="itemInfo_<?php echo $category_id ?>" class=" carOverf overflow-x-auto hover:overflow-x-auto flex max-w-full p-2 gap-2   bg-neutral h-52 bg-transparent rounded-box">
                            <?php
                            // Fetch items belonging to the current category
                            $item_query = $conn->query("SELECT * FROM tbl_ewst WHERE ewst_ctyfk = " . $category_data['cty_id']);
                            while ($item_data = mysqli_fetch_array($item_query)) {
                            ?>
                                <div class=" flex space-x-4 cursor-pointer carOverf max-w-full  pb-2">

                                    <div class="card carousel-item w-auto  bg-base-100 shadow-xl">
                                        <figure class="px-2 pt-5 w-36">
                                            <img src="../src/img/kb.jpg" alt="keyboard" class="rounded-box" />
                                        </figure>
                                        <button class="btn btnItem mx-2 bg-[#FDE5D4] btn-sm mt-4 flex items-center justify-center" onclick="infoItemModal.showModal()" id="<?php echo $item_data['ewst_id'] ?>"><i class='bx bx-info-circle text-lg' style='color:#001524'></i>
                                            <?php echo $item_data['ewst_name'] ?>
                                        </button>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                <?php
                }
                ?>