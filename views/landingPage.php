<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./output.css" rel="stylesheet">
    <link rel="stylesheet" href="../node_modules/boxicons/css/boxicons.min.css">
    <link rel="stylesheet" href="../src/landing/css/costum.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <script src="../plugin/jquery.js"></script>
    <title>landing</title>
</head>

<body>
    <div class="h-svh w-full overflow-x-hidden bg-costm">
        <div class="navbar bg-transparent">
            <div class="navbar-start">
                <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                    <div class="w-10 rounded-full">
                        <img alt="Tailwind CSS Navbar component" src="../src/img/chmsuLg.png" />
                    </div>
                </div>
                <button class="btn btn-ghost lg:text-xl hidden lg:flex p-1 text-[#001524]">Carlos Hilado Memorial State University</button>
            </div>
            <div class="navbar-end">
                <button class="btn btn-ghost text-xl font-popin font-bold text-[#001524]">
                    E-waste
                    <i class='bx bx-recycle'></i>
                </button>
            </div>
        </div>
        <!-- landing content -->
        <div class="h-[90%] w-full lg:flex lg:flex-row flex-col">
            <div class="h-full w-full lg:w-[50%]">
                <div class="Lg:w-full lg:h-full flex lg:items-center lg:justify-center max-lg:pt-28">
                    <img alt="Tailwind CSS Navbar component" src="../src/img/ewasteLand.png" />
                </div>
            </div>
            <div class="h-full lg:w-[50%] w-full flex flex-col">
                <h1 class="text-[53px] font-bold font-popin mt-[27%] text-[#001524] text-wrap">Techrecycle E-waste Management</h1>
                <h2 class="font-popin font-medium text-[30px] text-[#FDE5D4]">Welcome to Admin Panel</h2>
                <div class="flex flex-col w-auto lg:flex-row">
                    <button class="btn  btn-success w-32 grid place-items-center" onclick="my_modal_lgn.showModal()">Log-in</button>
                    <div class="divider lg:divider-horizontal"></div>
                </div>
            </div>
        </div>
    </div>
    <?php include "../src/landing/components/dialogs.php" ?>
    <script src="../src/landing/js/login.js"></script>
</body>

</html>