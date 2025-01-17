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
        <div class="lg:w-[83%] w-full h-full overflow-hidden text-bgtext">
            <div class="">
                <?php include '../src/admin/components/navigations/headerSticky.php' ?>
            </div>
            <!-- start contents here total donations total redemption -->
            <div class="lg:h-[90%] w-full overflow-x-auto">
                <!-- right content -->
                 <div class="toast toast-end z-50" id="alertMsg">
                </div>
                <div class=" w-full flex lg:flex-row mt-2 lg:flex gap-2 ">
                    <div class="w-[70%] h-auto mb-5 flex flex-col gap-2">
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
                        <div class="font-popin text-md font-semibold self-center text-center">Recycled Analysis</div> 
                        <div class="w-full h-[400px] bg-bgbox rounded-md p-4 ">
                            <canvas id="myChart"></canvas>
                        </div>
                        <div class="font-popin text-md font-semibold self-center text-center">Redeemed Analysis</div> 
                        <div class="w-full h-[400px] bg-bgbox rounded-md p-4 ">
                            <canvas id="myChartRedeem"></canvas>
                        </div>
                    </div>

                    <!-- left content Recent Activities-->
                     <div class="flex flex-col w-[30%]">
                        <div class="h-auto bg-bgcard w-full mb-2 p-2 rounded-md flex flex-col items-center">
                            <div class=" p-2 rounded-md border-opacity-50 bg-bgbox">
                                <div class="font-popin p-2 text-center font-medium">Generate Recycled Report</div>
                                <a class="btn btn-xs font-normal bg-bgbox btn-mostly" href="#">
                                    Most Recycled Items 
                                    <i data-lucide="printer" class="w-4 h-4"></i>
                                </a>
                                <a class="btn btn-xs font-normal bg-bgbox btn-All-items" href="#">
                                    All Recycled Items 
                                    <i data-lucide="printer" class="w-4 h-4"></i>
                                </a>
                                <a class="btn btn-xs font-normal bg-bgbox btn-per-student mt-2" href="#">
                                    E-waste per student 
                                    <i data-lucide="printer" class="w-4 h-4"></i>
                                </a>
                                <div class="border p-2 border-bgborder rounded-md mt-2 border-opacity-50">

                                    <div class="font-popin text-center text-sm">Cutom Date</div>
                                        <form method="POST" id="customDate" action="../src/admin/components/fetching/reports/rcyCustomData.php" target="_blank">
                                            <input id="custom-date-picker" name="custom_date" type="date" class="input input-bordered mt-2 w-full max-w-xs input-sm" />
                                            <button type="submit" class="btn btn-xs bg-bgbox mt-4" id="customDateBtn" class="font-popin font-normal">Generate <i data-lucide="printer" class="w-4 h-4"></i></button>
                                        </form>
                                </div>
                            </div>
                            <div class=" p-2 mt-2 rounded-md border-opacity-50 bg-bgbox">
                                <div class="font-popin p-2 text-center font-medium">Generate Redeemed Report</div>
                                <a class="btn btn-xs font-normal bg-bgbox btn-mostlyRwd" href="#">
                                    Most Redeem Items 
                                    <i data-lucide="printer" class="w-4 h-4"></i>
                                </a>
                                <a class="btn btn-xs font-normal bg-bgbox btn-allRwd mt-1" href="#">
                                    All Redeem Items 
                                    <i data-lucide="printer" class="w-4 h-4"></i>
                                </a>
                                <a class="btn btn-xs font-normal bg-bgbox btn-rwd-per-student mt-2" href="#">
                                    Redeemed Item per student 
                                    <i data-lucide="printer" class="w-4 h-4"></i>
                                </a>
                                <div class="border p-2 border-bgborder rounded-md mt-2 border-opacity-50">

                                    <div class="font-popin text-center text-sm">Cutom Date</div>
                                        <form method="POST" id="customDate" action="../src/admin/components/fetching/reports/rwdCustomData.php" target="_blank">
                                            <input id="custom-rwddate-picker" name="customRwdDate" type="date" class="input input-bordered mt-2 w-full max-w-xs input-sm" />
                                            <button type="submit" class="btn btn-xs bg-bgbox mt-4" id="customDateBtn" class="font-popin font-normal">Generate <i data-lucide="printer" class="w-4 h-4"></i></button>
                                        </form>
                                </div>
                            </div>
                            
                            
                        </div>
                        <div class="w-full h-[500px] rounded-md p-2 bg-[url('../src/img/dashbg1.svg')]">
                            <?php include "../src/admin/components/fetching/dashboardFetch/recentActivities.php" ?>
                        </div>
                        </div>

                     </div>
                   
                   
                </div>
            </div>
        </div>
    </div>
    <dialog id="showRcntAct" class="modal">
        
    </dialog>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            lucide.createIcons();
        });
        const dateInput = document.getElementById('custom-date-picker');
        dateInput.addEventListener('change', function() {
        const selectedDate = dateInput.value;
        console.log("Selected Date: ", selectedDate); 
        });
        const dateRwdInput = document.getElementById('custom-rwddate-picker');
        dateRwdInput.addEventListener('change', function() {
        const selectedDate = dateRwdInput.value;
         console.log("Selected RWDDate: ", selectedDate); 
        });
    </script>
    <script src="../node_modules/chart.js/dist/chart.umd.js"></script>
    <script>
        document.getElementById('printButton').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent the default link behavior

            // Open the report page in a new window
            const printWindow = window.open('rcyReports.php', '_blank');
            
            // Wait for the new window to load, then print
            printWindow.addEventListener('load', function() {
                printWindow.print();
            });
        });
    </script>
   
    <script type="module" src="ewstChart.js"></script>
    <script type="module" src="rwdChart.js"></script>
</body>

</html>
<script type="module" src="../src/admin/js/main.js"></script>
<script src="../src/admin/js/script.js"></script>