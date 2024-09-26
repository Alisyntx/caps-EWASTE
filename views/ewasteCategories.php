<?php
include '../database/conn.php';
session_start();
session_regenerate_id(true);
$ses_id = $_SESSION['usr_id'];
if (empty($ses_id)) {
    header('location: landingPage.php');
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
    <!-- data tables plugin -->
    <script src="../plugin/datatables/datatables.min.js"></script>
    <title>E-waste</title>
</head>

<body>
    <div class="w-svw h-svh overflow-y-auto bg-mainbg flex gap-1">
        <?php include "../src/admin/components/navigations/ewasteCategoriesNav.php" ?>
        <div class="lg:w-[83%] w-full h-svh">
            <div class="toast toast-end z-50" id="alertMsg">

            </div>
            <?php include "../src/admin/components/navigations/headerEwasteCty.php" ?>
            <div class="w-full contLstOvrf h-[90%] overflow-y-auto pr-1" id="ctyHtml">
                <?php include '../src/admin/components/fetching/ewasteFetch/categoriesFetch.php' ?>
            </div>
        </div>
    </div>

    <!-- dialogs here -->
    <dialog id="infoItemModal" class="modal">
    </dialog>
    <dialog id="addItemModal" class="modal">
        <?php include '../src/admin/components/dialogs/categories/addItems.php' ?>
    </dialog>
    <dialog id="ctyAddModal" class="modal">
        <?php include '../src/admin/components/dialogs/categories/categorys.php' ?>
    </dialog>
    <dialog id="delCty" class="modal">

    </dialog>
    <dialog id="addItemCty" class="modal">

    </dialog>
    <dialog id="delItems" class="modal">

    </dialog>
    <dialog id="editPoints" class="modal">

    </dialog>
    <dialog id="editItems" class="modal">

    </dialog>
    <script>
        lucide.createIcons();
    </script>
</body>

</html>
<script type="module" src="../src/admin/js/main.js"></script>
<script src="../src/admin/js/script.js"></script>