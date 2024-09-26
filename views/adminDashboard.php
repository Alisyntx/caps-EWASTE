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
    <link href="./output.css" rel="stylesheet">
    <link rel="stylesheet" href="css/costum.css">
    <!-- icons -->
    <link rel="stylesheet" href="../node_modules/boxicons/css/boxicons.min.css">
    <script src="../node_modules/lucide/dist/umd/lucide.min.js"></script>
    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <script src="../plugin/jquery.js"></script>
    <!-- custom css -->
    <link rel="stylesheet" href="../src/admin/css/costum.css">
    <title>admin</title>
</head>

<body>
    <div class="w-svw h-svh overflow-y-auto bg-mainbg flex gap-1">
        <!-- this is located in src/admin/navigations -->
        <?php include '../src/admin/components/navigations/dashboard.php' ?>
        <div class="lg:w-[83%] w-full h-full overflow-hidden">
            <div class="">
                <?php include '../src/admin/components/navigations/headerSticky.php' ?>
            </div>
            <!-- start contents here total donations total redemption -->
            <div class="lg:h-[90%] w-full overflow-x-auto">
                <!-- right content -->
                <div class=" w-full flex lg:flex-row mt-2 lg:flex gap-2 ">
                    <div class="w-[70%] h-auto flex flex-col gap-2">
                        <div class=" h-20 flex flex-row justify-between">
                            <?php include "../src/admin/components/fetching/dashboardFetch/totalUsers.php" ?>
                            <?php include "../src/admin/components/fetching/dashboardFetch/pendingRedemptions.php" ?>
                            <?php include "../src/admin/components/fetching/dashboardFetch/pendingDonations.php" ?>
                            <?php include "../src/admin/components/fetching/dashboardFetch/totalRdmItems.php" ?>
                        </div>
                        <div class="w-full h-72 flex flex-row gap-2 card rounded-md p-2 bg-bgbox bg-[url('../src/img/dashbg1.svg')]">
                            <div class="flex w-[70%] h-full gap-2">
                                <?php include "../src/admin/components/fetching/dashboardFetch/topDonor.php" ?>
                                <?php include "../src/admin/components/fetching/dashboardFetch/recentDonator.php" ?>
                            </div>
                            <div class=" flex flex-col gap-2">
                                <?php include "../src/admin/components/fetching/dashboardFetch/totalEwstCategories.php" ?>
                                <?php include "../src/admin/components/fetching/dashboardFetch/totalPoints.php" ?>
                                <!-- <div class="stats shadow rounded-md bg-bgbox">
                                    <div class="stat p-2">
                                        <div class="stat-figure text-bgtext">
                                            <i data-lucide="gift"></i>
                                        </div>
                                        <div class="stat-title text-[12px]">Total Redemption Items</div>
                                        <div class="divide-y divide-bgdevider">
                                            <div class="font-bold text-md">20</div>
                                            <div class="flex flex-row items-center gap-1">
                                                <div class="stat-desc text-[10px]">Add Items</div><i data-lucide="plus" class="w-3 h-3 "></i>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                        <div class="w-full h-[400px] bg-bgbox rounded-md p-4">
                            <canvas id="myChart" ></canvas>

                        </div>
                    </div>

                    <!-- left content Recent Activities-->
                    <div class="w-[30%] h-[500px] rounded-md p-2  bg-[url('../src/img/dashbg1.svg')]">
                        <div class=" flex gap-1 ">
                            <div class="font-popin p-1 font-light text-[15px]">Recent Activities</div>
                            <i data-lucide="history" class="w-6 h-6 text-bgtext"></i>
                        </div>
                        <div class="w-full card rounded-md flex justify-center bg-base-100 shadow">
                            <div class="overflow-x-auto bg-bgbox">
                                <table class="table table-xs">
                                    <!-- head -->
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Date</th>
                                            <th>Activity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- row 1 -->
                                        <tr>
                                            <th>1</th>
                                            <td class="font-light text-[10px]">04/20/24 12:00</td>
                                            <td class="font-light">Ashong Salongga Registered</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <dialog id="addItemModal" class="modal">
        <?php include 'components/dialogs/item.php' ?>
    </dialog>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            lucide.createIcons();
        });
    </script>
    <script src="../node_modules/chart.js/dist/chart.umd.js"></script>
   <script>

</script>

    <script src="test.js"></script>
</body>

</html>
<script src="../src/admin/js/script.js"></script>