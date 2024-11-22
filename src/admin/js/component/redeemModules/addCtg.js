class addCatalogs {
    constructor(saveFormCtg, saveUrlCtg, saveCtgHtml) {
        this.saveFormCtg = saveFormCtg;
        this.saveUrlCtg = saveUrlCtg;
        this.saveCtgHtml = saveCtgHtml
        this.bindEvent()
    }
    bindEvent() {
        $(this.saveFormCtg).on('submit', (e) => this.saveCatalogs(e));
    }
    saveCatalogs(e) {
        e.preventDefault();
        const data = $(e.currentTarget).serialize();
        $.post(this.saveUrlCtg, data, (response) => {
            var msgAlert = `
                <div class="alert p-2 rounded-md bg-bgcard border border-bgborder animate__animated animate__backInRight">
                    <span class="text-xs font-popin">${response.msg}</span>
                </div>
                `;
            var alertElement = $(msgAlert).appendTo("#alertMsg");
            setTimeout(() => {
                alertElement.fadeOut(500, function () {
                    $(this).remove();
                });
            }, 5000);
            ctgAddModal.close();
            var newCatalogHTML = `
                    <div class="animate__animated animate__backInRight category-box mt-2 mb-5 bg-bgbox border border-bgcard border-1 w-full h-auto rounded-md flex flex-col gap-1 shadow-md divide-y divide-bgborder ctgIds" id="catalog-${response.ctg_id}">
                    <div class="p-1 flex justify-between">
                        <button class="btn bg-mainbg shadow-md font-poppin bg-transparent rounded-md btn-xs text-bgtext text-xs font-popin">
                            ${response.ctg_name}
                        </button>
                        <div>
                            <button class="btn btn-xs btn-circle bg-mainbg shadow-md font-poppin bg-transparent text-center text-bgtext text-xs font-popin delCtg" id="${response.ctg_id}" onclick="delCtg.showModal()"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
                            <button class="btn btn-xs btn-circle bg-mainbg shadow-md font-poppin bg-transparent text-center text-bgtext text-xs font-popin addItemCtgId" id="${response.ctg_id}" onclick="addItemCtg.showModal()"><i data-lucide="list-plus" class="w-4 h-4"></i></button>
                        </div>
                    </div>
                        <div class=" ">
                            <div class="overflow-x-auto">
                                <table class="table table-xs" id="itemList">
                                    <!-- head -->
                                    <thead>
                                        <tr>
                                            <th>
                                            </th>
                                            <th>item</th>
                                            <th>Reward Points</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan='4' class='text-center'>No items</td>
                                        </tr>
                                    </tbody>
                                    <!-- foot -->
                                </table>
                            </div>
                        </div>
                    </div>`;
            $(this.saveCtgHtml).append(newCatalogHTML);
            lucide.createIcons();
        });
    }
}
export default addCatalogs;