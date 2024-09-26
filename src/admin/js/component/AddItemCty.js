class addItemCty{
    constructor(addCtyBtn,modalConAddCty,addItemCtyForm,loadModalAddCty,addItemCtyUrl){
        this.addCtyBtn = addCtyBtn;
        this.modalConAddCty = modalConAddCty;
        this.addItemCtyForm = addItemCtyForm;
        this.loadModalAddCty = loadModalAddCty;
        this.addItemCtyUrl = addItemCtyUrl;
        this.ctyID = null;

        this.bindEvent();
    }

    bindEvent(){
        $(document).on('click', this.addCtyBtn,(e)=>this.loadAddCtyModal(e))
        $(this.modalConAddCty).on('submit', this.addItemCtyForm,(e)=>this.submitAddItemCty(e));
    }
    loadAddCtyModal(e){
        e.preventDefault();
       this.ctyID = $(e.currentTarget).attr('id');
       $.post(this.loadModalAddCty,{getId : this.ctyID},(response) =>{
            $(this.modalConAddCty).html(response);
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

    submitAddItemCty(e) {
        e.preventDefault();
        const formData = new FormData($(e.currentTarget)[0]);
        formData.append('ctyId', this.ctyID); // Add category ID to FormData

        $.ajax({
            url: this.addItemCtyUrl,
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: (response) => {
                if (response.scs) {

                    var msgAlert = 
                        `<div class="alert p-2 rounded-md bg-bgcard border border-bgborder animate__animated animate__backInRight">
                            <span class="text-xs font-popin">${response.msg}</span>
                        </div>`;
                    
                    var alertElement = $(msgAlert).appendTo('#addItemCtyAlertMsg');
                    setTimeout(() => {
                        alertElement.fadeOut(500, function() {
                            $(this).remove();
                        });
                    }, 5000);
                    
                    var itemHtml = `<tr>
                                        <th>new</th>
                                        <td>
                                            <div class='flex items-center gap-3'>
                                                <div class='avatar'>
                                                    <div class='mask mask-squircle w-10'>
                                                        <img src='../src/admin/php/uploads/<?php echo $items['ewst_img'] ?>' alt='tsk' />
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class='font-bold'>${response.ewstName}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class='text-sm'>
                                            <button class='btn outline outline-bgdevider outline-1 bg-transparent rounded-md btn-xs font-popin' onclick='editPoints.showModal()'>
                                                <i data-lucide='folder-open-dot' class='w-4 h-4 text-bgdevider'></i>
                                                points
                                            </button>
                                        </td>
                                        <td>
                                            <button class='btn outline outline-bgdevider outline-1 bg-transparent rounded-md btn-xs font-popin mx-2' onclick='editItems.showModal()'>
                                                <i data-lucide='pencil' class='w-4 h-4 text-error'></i>
                                                Edit
                                            </button>
                                            <button class='btn outline outline-bgdevider outline-1 bg-transparent rounded-md btn-xs font-popin' onclick='editItems.showModal()'>
                                                <i data-lucide='trash-2' class='w-4 h-4 text-error'></i>
                                                Delete
                                            </button>
                                        </td>
                                    </tr>`;
                    $(`#category-${response.ewstCtyId} #itemList`).append(itemHtml);
                    lucide.createIcons();
                    $(this.modalConAddCty).find('#addItemCtyForm')[0].reset();
                    $(this.modalConAddCty).find('#imagePreview').attr('src', '');
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
export default addItemCty;