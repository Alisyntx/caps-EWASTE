 <div class="w-auto sticky top-1 pr-1 z-40">
     <div class="navbar bg-bgbox border border-bgborder rounded-md flex justify-between">
         <div class="">
             <button class="btn btn-sm mx-1 text-sm font-semibold btn-ghost font-popin" id="ctyAdd" onclick="ctyAddModal.showModal()">
                 <i class='bx bx-category-alt'></i>Add Category
             </button>
             <button class="btn btn-sm mx-2 text-sm font-semibold btn-ghost font-popin" id="btnAddItem" onclick="addItemModal.showModal()">
                 <i class='bx bx-list-plus text-xl'></i>Add Item
             </button>
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