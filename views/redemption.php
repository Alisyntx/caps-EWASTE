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

    <!-- <script src="../../plugin/datatables/datatables.min.js"></script> -->
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
    <div class="w-svw h-svh bg-[#FDE5D4] flex gap-1">
        <?php include "../src/admin/components/navigations/rwdRedeemNav.php" ?>
        <div class="lg:w-[83%] w-full h-svh overflow-hidden">
            <div class="toast toast-end z-50" id="alertMsg">
            </div>
            <?php include '../src/admin/components/navigations/headerReedem.php' ?>
            <div class="w-full contLstOvrf h-[100%] overflow-y-auto">
                <div class="w-full contLstOvrf h-[90%] overflow-y-auto pr-1" id="ctgHtml">
                    <?php include '../src/admin/components/fetching/reedemItemFetch/rwdItemFetch.php' ?>
                </div>
            </div>
        </div>
        <!--Ali< dialogs here -->
        <dialog id="addItemCtg" class="modal">
        </dialog>
        <dialog id="editItemCtg" class="modal">
        </dialog>
        <dialog id="delCtgItems" class="modal">
        </dialog>
        <dialog id="delCtg" class="modal">
        </dialog>
        <dialog id="ctgAddModal" class="modal">
            <?php include '../src/admin/components/dialogs/catalogs/catalogs.php' ?>
        </dialog>
        <dialog id="infoItemRwdModal" class="modal">
        </dialog>
    </div>
</body>

</html>
<script src="../src/admin/js/scriptRwd.js"></script>
<script type="module" src="../src/admin/js/main.js"></script>
<script>
    lucide.createIcons();
</script>