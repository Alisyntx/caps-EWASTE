<?php require_once '../database/conn.php';
session_start();
session_regenerate_id(true);
$ses_id = $_SESSION['usr_id'];
if (empty($ses_id)) {
    header('location: ../landing/index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- customs css -->
    <link href="output.css" rel="stylesheet">
    <link rel="stylesheet" href="../src/admin/css/costum.css">
    <!-- fonts npm box icon -->
    <link rel="stylesheet" href="../node_modules/boxicons/css/boxicons.min.css">
    <script src="../node_modules/lucide/dist/umd/lucide.min.js"></script>
    <!-- fontss -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- jquery plugin -->
    <script src="../plugin/jquery.js"></script>
    <script src="../plugin/jquery-ui-1.13.3.custom/jquery-ui.js"></script>
    <script src="../plugin/jquery-ui-1.13.3.custom/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="../plugin/jquery-ui-1.13.3.custom/jquery-ui.css">
    <!-- datatables plugin-->
    <link rel="stylesheet" href="../plugin/datatables/datatables.min.css">
    <!-- animation.css-->
    <link rel="stylesheet" href="../node_modules/animate.css/animate.css">

    <script src="../../plugin/datatables/datatables.min.js"></script>
    <style>
        .autocomplete-items {
            border: 1px solid #d4d4d4;
            border-bottom: none;
            border-top: none;
            z-index: 99;
            position: absolute;
            max-height: 200px;
            overflow-y: auto;
        }

        .autocomplete-item {
            padding: 10px;
            cursor: pointer;
            background-color: #fff;
            border-bottom: 1px solid #d4d4d4;
        }

        .autocomplete-item:hover {
            background-color: #e9e9e9;
        }
    </style>
    <title>admin</title>
</head>

<body>
    <div class="w-svw h-svh bg-[#FDE5D4] flex">
        <div class="lg:w-[18%] h-screen rounded-r-[20px] hidden bg-green-500 lg:flex flex-col p-2">
            <a href="" class="btn btn-ghost text-xl text-center mt-3 text-white font-semibold font-popin">E-WASTE</a>
            <ul class="menu flex flex-col mt-9">
                <label class="input input-bordered input-sm flex items-center gap-2">
                    <input type="text" class="grow" placeholder="Search" />
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4 opacity-70">
                        <path fill-rule="evenodd" d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z" clip-rule="evenodd" />
                    </svg>
                </label>
                <li>
                    <a href="index.php" id="btncstm1" class="btn mt-2 justify-start font-semibold font-popin">
                        <i class='bx bx-home-alt text-[27px] mr-8' style='color:#001524'></i>
                        Home
                    </a>
                </li>

                <li>
                    <span class="menu-dropdown-toggle btn justify-start mt-2 font-semibold font-popin ">
                        <i class='bx bx-recycle text-[27px] mr-8'></i>
                        <span class="mr-8">E-waste </span>
                    </span>
                    <ul class="menu-dropdown">
                        <li class="mt-2">
                            <a href="donations.php" id="btncstm2" class="font-normal font-popin">
                                <i class='bx bx-category-alt mr-5 font-bold text-lg'></i>
                                Categories</a>
                        </li>
                        <li class="">
                            <a id="btnAddItem" class="font-normal font-popin" onclick="addItemModal.showModal()">
                                <i class='bx bx-list-plus mr-5 font-bold text-lg'></i>
                                Add Items</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <span class="btn-active btn-neutral menu-dropdown-toggle btn justify-start mt-2 font-semibold font-popin ">
                        <i class='bx bx-gift text-[27px] mr-8'></i>
                        <span class="mr-8">Rewards </span>
                    </span>
                    <ul class="menu-dropdown">
                        <li class="mt-2">
                            <a href="redemption.php" id="btncstm2" class="font-normal font-popin">
                                <i class='bx bx-category-alt mr-5 font-bold text-lg'></i>
                                Redemption items</a>
                        </li>
                        <li class="">
                            <a id="btnAddItem" class="font-normal font-popin" onclick="addRwdItemModal.showModal()">
                                <i class='bx bx-gift mr-5 font-bold text-lg'></i>
                                Add Items</a>
                        </li>
                        <li class="">
                            <a id="btnAddItem" href="pendingRwd.php" class="font-normal font-popin">
                                <i class='bx bx-revision mr-5 font-bold text-lg'></i>
                                Pending Redemption</a>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
        <div class="lg:w-[82%] w-full h-svh">
            <div class="w-auto bg-[#FDE5D4]">
                <div class="navbar bg-transparent flex justify-between">
                    <div class="">
                        <button class="btn btn-sm mx-2 text-sm font-semibold btn-ghost font-popin" id="ctyAdd" onclick="ctyAddModal.showModal()"><i class='bx bx-category-alt'></i>Add Category</button>
                        <button class="btn btn-sm mx-2 text-sm font-semibold btn-ghost font-popin" id="btnAddItem" onclick="addRwdItemModal.showModal()"><i class='bx bx-gift text-xl'></i>Add Item</button>
                    </div>
                    <div class=" gap-2">
                        <div class="indicator">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                            <span class="badge badge-xs badge-primary indicator-item"></span>
                        </div>
                        <div class="dropdown dropdown-end">
                            <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                                <div class="w-10 rounded-full">
                                    <img alt="Tailwind CSS Navbar component" src="https://daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg" />
                                </div>
                            </div>
                            <ul tabindex="0" class="mt-3 z-[1] p-2 shadow menu menu-sm dropdown-content bg-base-100 rounded-box w-52">
                                <li>
                                    <a class="justify-between">
                                        Profile
                                        <span class="badge">New</span>
                                    </a>
                                </li>
                                <li><a>Settings</a></li>
                                <li><a href="php/logout.php">Logout</a></li>
                            </ul>
                        </div>
                        <div class="max-lg:hidden flex">
                            <a class="btn btn-ghost text-sm">Gorge Admin1</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full contLstOvrf h-[90%] overflow-y-auto" id="ctyHtml">
                <div class="flex flex-col">
                    <div>
                        <button class="btn ml-2 btn-ghost float-left btn-sm w-auto font-normal font-popin tooltip tooltip-right tooltip-info btnTbl" data-tip="view as a table" onclick="modalTableDnt.showModal()" id="">Category</button>
                    </div>

                    <div id="itemInfo" class=" carousel carousel-center max-w-full p-4 gap-2 bg-neutral h-52 bg-transparent rounded-box">
                        <?php
                        // Fetch items belonging to the current category
                        // add this after category items implement
                        // WHERE ewst_ctyfk = " . $category_data['cty_id']
                        $item_query = $conn->query("SELECT * FROM tbl_catalog");
                        while ($item_data = mysqli_fetch_array($item_query)) {
                        ?>
                            <div class=" flex space-x-4 overflow-x-auto cursor-pointer carOverf max-w-full hover:overflow-x-auto pb-2">
                                <div class="card carousel-item w-32 bg-base-100 shadow-xl">
                                    <figure class="self-center w-32">
                                        <img src="../img/gift.png" alt="gift box" class="rounded-box" />
                                    </figure>
                                    <button class="btn btnRwdItem mx-2 bg-[#FDE5D4] btn-sm  flex flex-row items-center justify-center" onclick="infoItemRwdModal.showModal()" id="<?php echo $item_data['ctg_id'] ?>">
                                        <?php echo $item_data['ctg_name'] ?>
                                    </button>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <!--Ali< dialogs here -->
        <dialog id="infoItemModal" class="modal">
        </dialog>
        <dialog id="addRwdItemModal" class="modal">
            <?php include 'components/dialogs/itemsRwd.php' ?>
        </dialog>
        <dialog id="ctyAddModal" class="modal">
            <?php include 'components/dialogs/itemsRwdCtg.php' ?>
        </dialog>
        <dialog id="infoItemRwdModal" class="modal">
        </dialog>
</body>

</html>
<script src="../src/admin/js/scriptRwd.js"></script>