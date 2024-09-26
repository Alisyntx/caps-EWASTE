 <div class="w-auto sticky top-1 pt-1 pr-1 z-40">
     <div class="navbar bg-bgbox rounded-md flex justify-between border border-bgborder">
         <div class="">
             <button class="btn btn-sm mx-2 text-sm btn-ghost font-semibold font-popin" id="ctyAdd"><i class='bx bxs-dashboard'></i>Dashboard</button>
         </div>
         <div class="gap-2">
             <div class="indicator">
                 <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                 </svg>
                 <span class="badge badge-xs badge-primary indicator-item"></span>
             </div>
             <div class="dropdown dropdown-end px-0">
                 <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                     <div class="w-10 rounded-full">
                         <img alt="Tailwind CSS Navbar component" src="https://daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg" />
                     </div>
                 </div>
                 <ul tabindex="1" class="mt-3 z-10 p-2 shadow menu menu-sm dropdown-content bg-base-100 rounded-box w-52">
                     <li>
                         <a class="justify-between">
                             Profile
                             <span class="badge">New</span>
                         </a>
                     </li>
                     <li><a>Settings</a></li>
                     <li><a href="../src/admin/php/logout.php">Logout</a></li>
                 </ul>
             </div>
             <div class="max-lg:hidden flex">
                 <a class="btn btn-ghost text-sm p-1">Gorge Admin1</a>
             </div>
         </div>
     </div>
 </div>