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
                    
                    var itemHtml = `<tr class="itemids" id="item-${response.ewstId}">
                              
                                <td>
                                    <div class="flex items-center gap-3">
                                        <div class="avatar">
                                            <div class="mask mask-squircle w-10">
                                                <img src="http://localhost/ewasteCapstone/storage/${response.ewstImg}" alt="tsk" />
                                            </div>
                                        </div>
                                        <div>
                                            <div class="font-bold font-popin">${response.ewstName}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="">
                                    <div class="btn checkPoints h-auto bg-mainbg border border-bgcard border-1 p-2 font-poppin bg-transparent rounded-md font-popin w-72" onclick="editPoints.showModal()" id="${response.ewstId}">
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