<?php require_once '../database/conn.php';
session_start();
session_regenerate_id(true);
$ses_id = $_SESSION['usr_id'];
if (empty($ses_id)) {
    header('location: ../landing/index.php');
    exit();
}
function timeAgo($datetime)
{
    // Check if $datetime is a DateTime object, convert if necessary
    if ($datetime instanceof DateTime) {
        $timestamp = $datetime->getTimestamp();
    } else {
        $timestamp = strtotime($datetime);
    }

    $time_difference = time() - $timestamp;

    if ($time_difference < 1) return 'just now';

    $units = [
        'year' => 31536000,
        'month' => 2628000,
        'week' => 604800,
        'day' => 86400,
        'hour' => 3600,
        'minute' => 60,
        'second' => 1,
    ];

    foreach ($units as $unit => $value) {
        if ($time_difference >= $value) {
            $time_value = floor($time_difference / $value);
            return $time_value . ' ' . $unit . ($time_value > 1 ? 's' : '') . ' ago';
        }
    }
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

    <script src="../plugin/datatables/datatables.min.js"></script>
    <title>admin</title>
    <style>
        div.dt-container .dt-search input {
            border: 1px solid #aaa;
            border-radius: 7px;
            padding: 2px;
            background-color: transparent;
            color: inherit;
            margin-top: 2px;
            font-size: smaller;
        }
    </style>

</head>

<body>
    <div class="w-svw h-svh bg-[#FDE5D4] flex gap-1">
        <?php include "../src/admin/components/navigations/storageNav.php" ?>
        <div class="lg:w-[83%]  w-full h-svh overflow-hidden">
            <div class="w-auto bg-[#FDE5D4]">
                <div class="w-auto sticky top-1 pt-1 pr-1 z-40">
                    <div class="navbar bg-bgbox border border-bgborder border-opacity-50 rounded-md  flex justify-between">
                        <div class="">
                            <button class="btn btn-sm mx-2 text-sm font-semibold font-popin btn-ghost " id="ctyAdd">
                                <i data-lucide="warehouse" class="w-4 h-4"></i>
                                Ewaste Storage
                            </button>
                        </div>
                        <div class="gap-2">
                            <div class="max-lg:hidden flex">
                                <a class="btn btn-ghost text-sm p-1 font-popin">Admin</a>
                            </div>
                            <div class="max-lg:hidden flex">
                                <a class="btn btn-ghost text-sm p-1 font-popin btn-circle lagout"><i data-lucide="log-out" class="text-bgtext h-5 w-5"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full contLstOvrf h-[90%] overflow-y-auto pr-1" id="ctyHtml">
                <?php include '../src/admin/components/fetching/storageFetch/ewstStorage.php' ?>
            </div>
        </div>
        <!--Ali dialogs here -->
        <dialog id="acceptRcyItem" class="modal">

        </dialog>
        <!-- <dialog id="infoItemModal" class="modal">
        </dialog>
        <dialog id="addRwdItemModal" class="modal">
            <?php include 'components/dialogs/itemsRwd.php' ?>
        </dialog>
        <dialog id="ctyAddModal" class="modal">
            <?php include 'components/dialogs/itemsRwdCtg.php' ?>
        </dialog>
        <dialog id="infoItemRwdModal" class="modal">
        </dialog> -->
</body>

</html>
<script type="module" src="../src/admin/js/main.js"></script>
<script src="../src/admin/js/scriptRwd.js"></script>
<script>
    lucide.createIcons();
</script>