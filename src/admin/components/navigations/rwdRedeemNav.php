 <div class="lg:w-[17%]  h-screen rounded-md hidden bg-bgbox lg:flex items-center flex-col">
          <a href="" class="btn btn-ghost text-xl flex justify-start text-start mt-3 font-extrabold font-popin w-full">
         <img src="../src/img/rcyIcon.svg" alt="Icon" class="w-11 h-11">
         E-Waste
     </a>
     <ul class="menu menu-sm w-full mt-9">
         <li>
             <a href="adminDashboard.php" id="btncstm1" class="mt-2 text-xs justify-start flex btn-sm rounded-md font-semibold font-popin border border-bgborder">
                 <i data-lucide="candlestick-chart" class="mr-5 w-5 h-5"></i>
                 Home
             </a>
         </li>
         <li>
             <details close>
                 <summary class=" bg-white text-xs rounded-md mt-2 font-semibold font-popin border border-bgborder">
                     <i class='bx bx-recycle text-[20px] mr-5'></i>
                     E-waste
                 </summary>
                 <ul>
                     <li class="mt-2"
                     >
                         <a href="ewasteCategories.php" id="btncstm2" class="justify-start font-popin text-xs">
                             <i class='bx bx-category-alt mr-5 font-bold text-lg'></i>
                             Categories</a>
                     </li>
                     <li class="mt-2">
                         <a href="pendingRcy.php" id="btnAddItem" class="rounded-md justify-start text-xs font-popin">
                             <i data-lucide="folder-clock" class="w-4 h-4 mr-5"></i>
                             Pending Donations</a>
                     </li>
                 </ul>
             </details>
         </li>
         <li>
             <details open>
                 <summary class="bg-white text-xs rounded-md mt-2 font-semibold font-popin items-center  btn-active btn-neutral  ">
                     <i class='bx bx-gift text-[20px] mr-5'></i>
                     <span class="">Rewards </span>
                 </summary>
                 <ul>
                     <li class="mt-2">
                         <a href="redemption.php" id="btncstm2" class="justify-start font-popin text-xs border">
                             <i class='bx bx-category-alt mr-5 font-bold text-lg'></i>
                             Redemption items</a>
                     </li>
                     <li class="mt-2">
                         <a href="redeemPending.php" id="btncstm2" class="justify-start font-popin text-xs ">
                             <i data-lucide="folder-clock" class="w-4 h-4 mr-5"></i>
                             Pending Redemptions</a>
                     </li>
                
                 </ul>
             </details>
         </li>
         <li>
             <details close>
                 <summary class="bg-white text-xs rounded-md mt-2 font-semibold font-popin items-center border border-bgborder">
                     <i data-lucide="warehouse" class="mr-5 w-5 h-5"></i>
                     <span class="">Storage </span>
                 </summary>
                 <ul>
                     <li class="mt-2">
                         <a href="ewstStorage.php" id="btncstm2" class="justify-start font-popin text-xs">
                            <i class='bx bx-recycle text-[20px] mr-5'></i>
                             Ewaste Storage</a>
                     </li>
                     <li class="mt-2">
                         <a href="rwdStorage.php" id="btncstm2" class="justify-start font-popin text-xs ">
                             <i class='bx bx-gift text-[20px] mr-5'></i>
                             Redemption Record</a>
                     </li>
                     
                 </ul>
             </details>
         </li>
         <li>
            <a href="userManagement.php" id="btncstm1" class="mt-2 text-xs justify-start flex btn-sm rounded-md font-semibold font-popin border border-bgborder">
                  <i data-lucide="user-cog" class="mr-5 w-5 h-5 text-bgtext"></i>
                 User Management
             </a>
         </li>  

     </ul>
 </div>