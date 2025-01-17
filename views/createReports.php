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

    <title>admin</title>
</head>

<body>
   <?php
    $reportType = isset($_GET['type']) ? $_GET['type'] : 'monthly';

    // Load different content based on the report type
    if ($reportType === 'mostly') {
        include '../src/admin/components/fetching/reports/rcyTableData.php';
    } elseif ($reportType === 'allRcy') {
        include '../src/admin/components/fetching/reports/rcyAllData.php';
    } elseif ($reportType === 'customRcy') {
        include '../src/admin/components/fetching/reports/rcyCustomData.php';
    } elseif ($reportType === 'allRwd') {
        include '../src/admin/components/fetching/reports/rwdAllData.php';
    } elseif ($reportType === 'mostlyRwd') {
        include '../src/admin/components/fetching/reports/rwdTableData.php';
    } elseif ($reportType === 'ewastePerStud') {
        include '../src/admin/components/fetching/reports/perStudentData.php';
    }elseif ($reportType === 'rewardPerStud') {
        include '../src/admin/components/fetching/reports/perStudentRwdData.php';
    }
?>
</body>

</html>
<script src="../src/admin/js/scriptRwd.js"></script>
<script type="module" src="../src/admin/js/main.js"></script>
<script>
    lucide.createIcons();
</script>