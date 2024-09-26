class EditItem{
    constructor(editItemsBtn,modalConEditItems,editItemForm,loadItemModal,editItemUrl){
        this.editItemsBtn = editItemsBtn;
        this.modalConEditItems = modalConEditItems;
        this.editItemForm = editItemForm;
        this.loadItemModal = loadItemModal;
        this.editItemUrl = editItemUrl;
        this.itemIds = null;
        this.toxicRelationShip();
    }
    
    toxicRelationShip(){
        $(document).on('click', this.editItemsBtn, (e)=> this.loadModalItem(e));
        $(document).on('submit', this.editItemForm, (e) => this.submitEditForm(e));
    }

    loadModalItem(e){
        e.preventDefault();
        this.itemIds = $(e.currentTarget).attr('id');
        $.post(this.loadItemModal,{getId : this.itemIds},(response)=>{
            $(this.modalConEditItems).html(response);
        });
    }

   submitEditForm(e){
    e.preventDefault();
    let formData = new FormData($(this.editItemForm)[0]);
    formData.append('itemId', this.itemIds); // Add the item ID to the form data

    $.ajax({
        url: this.editItemUrl, // URL to the PHP script that handles the update
        type: 'POST',
        data: formData,
        contentType: false, // Required for file upload
        processData: false, // Required for file upload
        success: (response) => {
            if (response.scs) {
                alert(response.ewstCtyId);
                var msgAlert = 
                    `<div class="alert p-2 rounded-md bg-bgcard border border-bgborder animate__animated animate__backInRight">
                        <span class="text-xs font-popin">${response.msg}</span>
                    </div>`;
                var alertElement = $(msgAlert).appendTo('#editItemsAlertMsg');
                setTimeout(() => {
                    alertElement.fadeOut(500, function() {
                        $(this).remove();
                    });
                }, 5000);

                var itemHtml = `<tr id="item-${response.itemId}">
                                    <th class="">updated</th>
                                    <td>
                                        <div class='flex items-center gap-3'>
                                            <div class='avatar'>
                                                <div class='mask mask-squircle w-10'>
                                                    <img src='../src/admin/php/uploads/${response.ewstImg}' alt='tsk' />
                                                </div>
                                            </div>
                                            <div>
                                                <div class='font-bold'>${response.ewstName}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class='text-sm'>
                                        <button class='btn checkPoints outline outline-bgdevider outline-1 bg-transparent rounded-md btn-xs font-popin' onclick='editPoints.showModal()' id='${response.itemId}'>
                                            <i data-lucide='folder-open-dot' class='w-4 h-4 text-bgdevider'></i>
                                            points
                                        </button>
                                    </td>
                                    <td>
                                        <button class='editItems btn outline outline-bgdevider outline-1 bg-transparent rounded-md btn-xs font-popin mx-2' onclick='editItems.showModal()' id='${response.itemId}'>
                                            <i data-lucide='pencil' class='w-4 h-4 text-error'></i>
                                            Edit
                                        </button>
                                        <button class='deleteItems btn outline outline-bgdevider outline-1 bg-transparent rounded-md btn-xs font-popin' onclick='delItems.showModal()' id='${response.itemId}'>
                                            <i data-lucide='trash-2' class='w-4 h-4 text-error'></i>
                                            Delete
                                        </button>
                                    </td>
                                </tr>`;
                $(`#item-${response.itemId}`).replaceWith(itemHtml);
                 $('#itemList tr').each(function(index) {
                    $(this).find('th').first().text(index + 1);
                });
                lucide.createIcons();
            } else {
                alert(response.msg); // Error message
            }
        },
        error: (xhr, status, error) => {
            console.error('Error: ' + error); // Log any error to the console
        }
    });
}

    
}
export default EditItem;