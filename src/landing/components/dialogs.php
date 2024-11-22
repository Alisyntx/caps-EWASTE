<!-- log in Modal -->
<dialog id="my_modal_lgn" class="modal">
    <div class="modal-box">
        <form method="dialog">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
        </form>
        <h3 class="font-bold text-lg font-popin"> Welcome Admin</h3>
        <div class="flex flex-col w-full">
            <form action="" class="w-full" id="lgnForm">
                <label class="form-control w-full mb-2  ">
                    <div class="label">
                        <span class="label-text-alt font-popin">Username</span>
                    </div>
                    <input type="text" placeholder="..." class="input input-bordered w-full input-sm" name="uname" required />
                    <div class="label">
                        <span class="label-text-alt"></span>
                    </div>

                    <div class="label">
                        <span class="label-text-alt font-popin">Password</span>
                        <span class="label-text-alt" id="pwordfbck"></span>
                    </div>
                    <div class="relative">
                    <input 
                        type="password" 
                        placeholder="..." 
                        class="input input-bordered w-full input-sm" 
                        name="password" 
                        id="pword" 
                        required 
                    />
                    <button 
                        type="button" 
                        id="togglePassword" 
                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500"
                    >
                        <i data-lucide="eye" id="eyeIcon"></i>
                    </button>
                </div>
                </label>
                <button class="btn btn-lgn font-popin btn-sm mt-2"> <span class="text-xs">Submit</span>  </button>
            </form>
        </div>
    </div>
</dialog>