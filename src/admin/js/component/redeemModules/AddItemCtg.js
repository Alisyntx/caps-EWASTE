class addItemCtg{
    constructor(addItemCtgModalCon, addItemCtgBtn, addItemCtgModal, addItemCtgUrl,addItemCtgForm) {
        this.addItemCtgModalCon = addItemCtgModalCon;
        this.addItemCtgBtn = addItemCtgBtn;
        this.addItemCtgModal = addItemCtgModal;
        this.addItemCtgUrl = addItemCtgUrl;
        this.addItemCtgForm = addItemCtgForm;
        this.ctgId = null;

        this.bindEvent();
    }
    bindEvent() {
        $(document).on('click', this.addItemCtgBtn, (e) => this.loadAddItemCtgModal(e));
        $(this.addItemCtgModalCon).on('submit', this.addItemCtgForm,(e)=>this.submitAddItemCtg(e));
    }
    loadAddItemCtgModal(e) {
        e.preventDefault();
        this.ctgId = $(e.currentTarget).attr('id');
        $.post(this.addItemCtgModal, { getId: this.ctgId }, (response) => {
            $(this.addItemCtgModalCon).html(response); 
            this.activateImagePreview();
        });
    }
    activateImagePreview() {
        $('input[name="itemImage"]').on('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    $('#imagePreview').attr('src', e.target.result);
                }
                reader.readAsDataURL(file);
            }
        });
    }
    submitAddItemCtg(e) {
    e.preventDefault();
    const formData = new FormData($(e.currentTarget)[0]);
    formData.append('ctgId', this.ctgId); // Add category ID to FormData

    $.ajax({
        url: this.addItemCtgUrl,
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: (response) => {
            if (response.scs) {
                const msgAlert = `<div class="alert p-2 rounded-md bg-bgcard border border-bgborder animate__animated animate__backInRight">
                    <span class="text-xs font-popin">${response.msg}</span>
                </div>`;
                const alertElement = $(msgAlert).appendTo("#addItemCtgAlertMsg");
                setTimeout(() => {
                    alertElement.fadeOut(500, () => {
                        $(this).remove();
                    });
                }, 5000);
                // Remove the "No items" row if it exists for this specific category
                $(`#catalog-${response.rwdCtgFk} #itemList`).find('tr:contains("No items")').remove();

                // Get the current row count for the specific category and start numbering from 1
                var rowCount = $(`#catalog-${response.rwdCtgFk} #itemList tr`).length + 1;

                var itemHtml = `
                    <tr class="itemids animate__animated animate__fadeIn" id="item-${response.rwdName}">
                        
                        <td>
                            <div class="flex items-center gap-3">
                                <div class="avatar">
                                    <div class="mask mask-squircle w-10">
                                        <img src="http://localhost/ewasteCapstone/storage/${response.rwdImg}" alt="item image" />
                                    </div>
                                </div>
                                <div>
                                    <div class="font-bold font-popin">${response.rwdName}</div>
                                </div>
                            </div>
                        </td>
                        <td class="">
                            <div class="btn btn-ghost bg-transparent checkPoints h-auto font-poppin rounded-md font-popin w-72" onclick="editPoints.showModal()" id="${response.rwdId}">
                                <div class="bg-mainbg border border-bgcard border-1 bg-transparent shadow-md rounded-md p-1 flex flex-col justify-between text-xs">
                                    <div class="flex flex-row w-auto font-normal">
                                        <div class="font-popin font-bold">Points: </div>
                                        <div class="mx-1 font-medium">${response.rwdPoints}</div>
                                    </div>
                                    <div class="flex flex-row w-auto font-normal">
                                        <div class="font-popin font-bold">Description: </div>
                                        <div class="mx-1 font-medium">${response.rwdDesc}</div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                           <button class="editCtgItems btn bg-mainbg shadow-md font-poppin bg-transparent btn-circle btn-xs font-popin mx-2" onclick="editItemCtg.showModal()" id="${response.rwdId}">
                                        <i data-lucide="square-pen" class="w-4 h-4 text-bgborder"></i>  
                                    </button>
                                    <button class="deleteCtgItems btn bg-mainbg shadow-md bg-transparent btn-circle btn-xs font-popin" onclick="delCtgItems.showModal()" id="${response.rwdId}">
                                        <i data-lucide="trash-2" class="w-4 h-4 text-error"></i>        
                                    </button>
                        </td>
                    </tr>`;

                // Append the new item row to the current category's item list
                $(`#catalog-${response.rwdCtgFk} #itemList`).append(itemHtml);

                // Recalculate the row numbers specifically for this category's items
                $(`#catalog-${response.rwdCtgFk} #itemList tr`).each(function (index) {
                    $(this).find("th").first().text(index + 1); // Numbering starts from 1 within this category
                });

                lucide.createIcons();

                // Reset the form and image preview
                $(this.addItemCtgModalCon).find('#addItemCtgForm')[0].reset();
                $(this.addItemCtgModalCon).find('#imagePreview').attr('src', '');

            } else {
                alert(response.msg);
            }
        },
        error: (jqXHR, textStatus, errorThrown) => {
            console.error('Error:', textStatus, errorThrown);
        }
    });
}

}
export default addItemCtg;