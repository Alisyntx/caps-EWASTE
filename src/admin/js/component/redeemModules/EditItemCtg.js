class editItemCtg{
    constructor(editItemCtgBtn,editItemCtgModalCon,editItemCtgModal,editItemCtgForm, editItemCtgUrl) {
        this.editItemCtgBtn = editItemCtgBtn;
        this.editItemCtgModalCon = editItemCtgModalCon;
        this.editItemCtgModal = editItemCtgModal;
        this.editItemCtgForm = editItemCtgForm;
        this.editItemCtgUrl = editItemCtgUrl;
        this.ediItemCtgId = null;
        
        this.bindEvent();
    }

    bindEvent() {
        $(document).on('click', this.editItemCtgBtn,(e)=> {
            this.loadEditItemCtg(e);
        })  
        $(this.editItemCtgModalCon).on("submit", this.editItemCtgForm, (e) => {
              this.submitEditCtgForm(e)
             
        }
          
        );
    }
    loadEditItemCtg(e) {
        e.preventDefault();
        this.ediItemCtgId = $(e.currentTarget).attr('id');
        $.post(this.editItemCtgModal, { getId: this.ediItemCtgId }, (response) => {
            $(this.editItemCtgModalCon).html(response); 
            this.activateImagePreview(); // Ensure preview gets re-bound
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
    submitEditCtgForm(e) {
        e.preventDefault();
        
        let formData = new FormData($(this.editItemCtgForm)[0]);
        formData.append("itemId", this.ediItemCtgId); // Add the item ID to the form data

        $.ajax({
            url: this.editItemCtgUrl, // URL to the PHP script that handles the update
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
                        $(msgAlert).appendTo("#editItemsCtgAlertMsg");
                    setTimeout(() => {
                        alertElement.fadeOut(500, function () {
                            $(this).remove();
                        });
                    }, 5000);
                    var rowCount = $(`#catalog-${response.rwdCtgFk} #itemList tr`).length + 1;
                    var itemHtml = `
                                
                                <td class=" animate__animated animate__fadeIn">
                                    <div class="flex items-center gap-3">
                                        <div class="avatar">
                                            <div class="mask mask-squircle w-10">
                                                <img src="http://localhost/ewasteCapstone/storage/${response.rwdImg}" alt="tsk" />
                                            </div>
                                        </div>
                                        <div>
                                            <div class="font-bold font-popin">${response.rwdName}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="">
                                     <div class="btn btn-ghost bg-transparent checkPoints h-auto font-poppin  rounded-md font-popin w-72" onclick="editPoints.showModal()" id="<?php echo $items['rwd_id']; ?>">
                                        <div class=" bg-mainbg border border-bgcard border-1 bg-transparent shadow-md rounded-md p-1 flex flex-col justify-between text-xs">
                                            <div class="flex flex-row  w-auto font-normal">
                                                <div class="font-popin font-bold">Points: </div>
                                                <div class=" mx-1 font-medium">${response.rwdPoints}</div>
                                            </div>
                                            <div class="flex flex-row  w-auto font-normal">
                                                <div class="font-popin font-bold">Description: </div>
                                                <div class=" mx-1 font-medium">${response.rwdDesc}</div>
                                            </div>

                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <button class="editCtgItems btn bg-mainbg shadow-md font-poppin bg-transparent btn-circle btn-xs font-popin mx-2" onclick="editItemCtg.showModal()" id="${response.rwdId}">
                                        <i data-lucide="square-pen" class="w-4 h-4 text-bgborder"></i>
                                        
                                    </button>
                                    <button class="deleteCtgItems btn bg-mainbg shadow-md bg-transparent btn-circle btn-xs font-popin" onclick="delCtgItems.showModal()" id=" ${response.rwdId}">
                                        <i data-lucide="trash-2" class="w-4 h-4 text-error"></i>
                                        
                                    </button>
                                </td>
                            `;

                    $(`#catalog-${response.rwdCtgId} #item-${response.rwdId}`).html(itemHtml);
                    lucide.createIcons();
                    // $(`#${this.ediItemCtgId}`).closest('.itemids').fadeOut(400, function() {
                    // $(this).remove(); 
                    // });
                    $(`#catalog-${response.rwdCtgId} .itemids`).each(function (index) {
                        $(this)
                            .find("th")
                            .first()
                            .text(index + 1);
                    });
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
export default editItemCtg;