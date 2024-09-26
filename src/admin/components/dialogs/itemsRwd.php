 <div class="modal-box  w-11/12 max-w-5xl ">
     <form method="dialog">
         <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
     </form>
     <button class="btn btn-ghost btn-sm font-bold text-lg mb-2"><i class='bx bx-plus-circle'></i> Add new Item</button>
     <div class="flex flex-col w-full lg:flex-row">
         <div class="grid flex-grow h-auto card bg-base-300 rounded-box p-5 shadow-xl">
             <div class="card">

                 <form id="formSaveRwdItem">
                     <!-- this is for search bar uncomment this soon -->
                     <!-- <input type="hidden" id="userId" name="user" value="" />
                     <input type="text" id="searchInput" class="select select-sm select-accent w-full mt-5" placeholder="Search User" /> -->

                     <label class="input input-sm input-bordered flex items-center gap-2 mt-2">
                         <i class='bx bx-info-circle'></i>
                         <input type="text" name="info" class="grow" placeholder="Item Info" id="info" />
                     </label>
                     <select class="select select-sm mt-2  select-accent w-full " disabled>
                         <option disabled selected>Under Development</option>
                         <option>Auto</option>
                         <option>Dark mode</option>
                         <option>Light mode</option>
                     </select>
                     <label class="input input-sm input-bordered flex items-center gap-2 mt-2">
                         <i class='bx bx-coin'></i>
                         <input type="text" class="grow" placeholder="Reward Points" name="points" id="points" />
                     </label>
                     <div class="flex items-center">
                         <button type="submit" class="btn btn-sm mt-5 mb-3 bg-[#FDE5D4] shadow-md" disabled>Save</button>
                         <div class="mt-5 mb-3 ml-2 w-full" id="error">
                         </div>
                     </div>

                 </form>
             </div>
         </div>
         <div class="divider lg:divider-horizontal"></div>
         <div class="grid flex-grow h-auto shadow-xl card bg-base-300 rounded-box p-5">
             <div class="card">
                 <div class=" font-semibold font-popin">preview:</div>

                 <form id="formSaveItem">
                     <label class="input input-bordered input-sm flex items-center gap-2 mt-2">
                         Item:
                         <input type="text" value="" class="input input-bordered input-xs w-full max-w-xs" disabled id="previewItem">
                     </label>
                     <label class="input input-bordered input-sm flex items-center gap-2 mt-2">
                         Points:
                         <input type="text" value="" class="input input-bordered input-xs w-full max-w-xs" disabled id="previewPoints">
                     </label>
                 </form>
             </div>
         </div>
     </div>

 </div>