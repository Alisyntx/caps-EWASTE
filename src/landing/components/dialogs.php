<!-- log in Modal -->
<dialog id="my_modal_lgn" class="modal">
    <div class="modal-box">
        <form method="dialog">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
        </form>
        <h3 class="font-bold text-lg"> Welcome Admin George</h3>
        <div class="flex flex-col w-full">
            <form action="" class="w-full" id="lgnForm">
                <label class="form-control w-full">
                    <div class="label">
                        <span class="label-text-alt">Username</span>
                    </div>
                    <input type="text" placeholder="..." class="input input-bordered w-full" name="uname" required />
                    <div class="label">
                        <span class="label-text-alt"></span>
                    </div>

                    <div class="label">
                        <span class="label-text-alt">Password</span>
                        <span class="label-text-alt" id="pwordfbck"></span>
                    </div>
                    <input type="text" placeholder="..." class="input input-bordered w-full" name="password" id="pword" required />
                    <div class="label">
                        <span class="label-text-alt"></span>
                    </div>

                    <div class="label">
                        <span class="label-text-alt">Confirm Password</span>
                        <span class="label-text-alt" id="cpwordfbck"></span>
                    </div>
                    <input type="text" placeholder="..." class="input input-bordered w-full" id="cpword" required />
                    <div class="label">
                        <span class="label-text-alt"></span>
                    </div>
                </label>
                <button class="btn btn-lgn"> submit </button>
            </form>
        </div>
    </div>
</dialog>