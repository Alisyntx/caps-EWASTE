class EditItem {
    constructor(
        editItemsBtn,
        modalConEditItems,
        editItemForm,
        loadItemModal,
        editItemUrl
    ) {
        this.editItemsBtn = editItemsBtn;
        this.modalConEditItems = modalConEditItems;
        this.editItemForm = editItemForm;
        this.loadItemModal = loadItemModal;
        this.editItemUrl = editItemUrl;
        this.ewstIds = null;
        this.toxicRelationShip();
    }

    toxicRelationShip() {
        $(document).on("click", this.editItemsBtn, (e) =>
            this.loadModalItem(e)
        );
        $(document).on("submit", this.editItemForm, (e) =>
            this.submitEditForm(e)
        );
    }

    loadModalItem(e) {
        e.preventDefault();
        this.ewstIds = $(e.currentTarget).attr("id");
        $.post(this.loadItemModal, { getId: this.ewstIds }, (response) => {
            $(this.modalConEditItems).html(response);
        });
    }

    submitEditForm(e) {
        e.preventDefault();
        let formData = new FormData($(this.editItemForm)[0]);
        formData.append("ewstId", this.ewstIds); // Add the item ID to the form data

        $.ajax({
            url: this.editItemUrl, // URL to the PHP script that handles the update
            type: "POST",
            data: formData,
            contentType: false, // Required for file upload
            processData: false, // Required for file upload
            success: (response) => {
                if (response.scs) {
                    // alert(response.ewstCtyId);
                    var msgAlert = `<div class="alert p-2 rounded-md bg-bgcard border border-bgborder animate__animated animate__backInRight">
                        <span class="text-xs font-popin">${response.msg}</span>
                    </div>`;
                    var alertElement =
                        $(msgAlert).appendTo("#editItemsAlertMsg");
                    setTimeout(() => {
                        alertElement.fadeOut(500, function () {
                            $(this).remove();
                        });
                    }, 5000);

                    var itemHtml = `<tr id="item-${response.ewstId}">
                                    <td>
                                        <div class='flex items-center gap-3'>
                                            <div class='avatar'>
                                                <div class='mask mask-squircle w-10'>
                                                    <img src='http://localhost/ewasteCapstone/storage/${response.ewstImg}' alt='tsk' />
                                                </div>
                                            </div>
                                            <div>
                                                <div class='font-bold'>${response.ewstName}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="">
                                    <div class="btn checkPoints h-auto bg-mainbg border border-bgcard border-1 p-2 shadow-md font-poppin bg-transparent rounded-md font-popin w-72" onclick="editPoints.showModal()" id="${response.ewstId}">
                                        <div class=" flex flex-row justify-between">
                                            <div class="flex flex-col items-start font-normal">
                                                <div>Good Condition</div>
                                                <div>Partially Damage</div>
                                                <div>Fully Damage</div>
                                            </div>
                                            <div class="mx-3">
                                                <div class="font-medium">${response.ewstGcon} Points</div>
                                                <div class="font-medium">${response.ewstPdam} Points</div>
                                                <div class="font-medium">${response.ewstFdam} Points</div>
                                            </div>
                                        </div>

                                    </div>

                                </td>
                                    <td>
                                    <button class="editItems btn bg-mainbg shadow-md font-poppin bg-transparent btn-circle btn-xs font-popin mx-2" onclick="editItems.showModal()" id="${response.ewstId}">
                                        <i data-lucide="square-pen" class="w-4 h-4 text-error"></i>
                                        
                                    </button>
                                    <button class="deleteItems btn bg-mainbg shadow-md bg-transparent btn-circle btn-xs font-popin" onclick="delItems.showModal()" id="${response.ewstId}">
                                        <i data-lucide="trash-2" class="w-4 h-4 text-error"></i>
                                       
                                    </button>

                                </td>
                                </tr>`;
                    $(`#item-${response.ewstId}`).replaceWith(itemHtml);
                    $("#itemList tr").each(function (index) {
                        $(this)
                            .find("th")
                            .first()
                            .text(index + 1);
                    });
                    lucide.createIcons();
                } else {
                    alert(response.msg); // Error message
                }
            },
            error: (xhr, status, error) => {
                console.error("Error: " + error); // Log any error to the console
            },
        });
    }
}
export default EditItem;
