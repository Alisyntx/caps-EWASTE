 <div class="lg:w-[17%] h-screen rounded-md hidden bg-sidenavbg lg:flex items-center flex-col">
     <a href="" class="btn btn-ghost text-xl text-center mt-3 text-white font-semibold font-popin">
         <i class='bx bx-recycle bx-flashing text-[27px]' style='color:#ffffff'></i>E-WASTE<i class='bx bx-recycle bx-flashing text-[27px]' style='color:#ffffff'></i>
     </a>
     <ul class="menu menu-sm w-full mt-9">
         <li>
             <a href="adminDashboard.php" id="btncstm1" class="mt-2 text-xs justify-start flex btn-sm btn-active btn-neutral rounded-md font-semibold font-popin">
                 <i data-lucide="candlestick-chart" class="mr-5 w-5 h-5"></i>
                 Home
             </a>
         </li>
         <li>
             <details close>
                 <summary class=" bg-white text-xs rounded-md mt-2 font-semibold  font-popin">
                     <i class='bx bx-recycle text-[20px] mr-5'></i>
                     E-waste
                 </summary>
                 <ul>
                     <li class="mt-2">
                         <a href="ewasteCategories.php" id="btncstm2" class="justify-start font-popin text-xs">
                             <i class='bx bx-category-alt mr-5 font-bold text-lg'></i>
                             Categories</a>
                     </li>
                     <li class="mt-2">
                         <a id="btnAddItem" class="rounded-md justify-start text-xs font-popin" onclick="addItemModal.showModal()">
                             <i class='bx bx-list-plus mr-5 font-bold text-lg'></i>
                             Add Items</a>
                     </li>
                 </ul>
             </details>
         </li>

         <li>
             <details close>
                 <summary class="bg-white text-xs rounded-md mt-2 font-semibold font-popin items-center">
                     <i class='bx bx-gift text-[20px] mr-5'></i>
                     <span class="">Rewards </span>
                 </summary>
                 <ul>
                     <li class="mt-2">
                         <a href="ewasteCategories.php" id="btncstm2" class="justify-start font-popin text-xs">
                             <i class='bx bx-category-alt mr-5 font-bold text-lg'></i>
                             Redemption items</a>
                     </li>
                     <li class="mt-2">
                         <a id="btnAddItem" class="rounded-md justify-start text-xs font-popin" onclick="addItemModal.showModal()">
                             <i class='bx bx-list-plus mr-5 font-bold text-lg'></i>
                             Add Items</a>
                     </li>
                 </ul>
             </details>
         </li>

     </ul>
 </div>