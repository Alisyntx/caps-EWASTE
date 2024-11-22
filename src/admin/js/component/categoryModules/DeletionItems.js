class DeletionItems{
    constructor(deleteItemsBtn,deleteItemsModal,deleteItemsForm,loadDelItemsModal,deleteItemUrl){
        this.deleteItemsBtn = deleteItemsBtn;
        this.deleteItemsModal = deleteItemsModal;
        this.deleteItemsForm = deleteItemsForm;
        this.loadDelItemsModal = loadDelItemsModal;
        this.deleteItemUrl = deleteItemUrl;
        this.itemToDelId = null;

        this.bindEvents();
    }

    bindEvents(){
        $(document).on('click', this.deleteItemsBtn, (e) => this.loadItemsModal(e));
        $(this.deleteItemsModal).on('submit', this.deleteItemsForm, (e) => this.submitDelItem(e))
    }

    loadItemsModal(e){
        e.preventDefault();
        this.itemToDelId = $(e.currentTarget).attr('id');
        $.post(this.loadDelItemsModal, {getId : this.itemToDelId}, (response)=>{
            $(this.deleteItemsModal).html(response);
        });
    }

    submitDelItem(e){
        e.preventDefault()
        const data = $(e.currentTarget).serialize();
        $.post(this.deleteItemUrl,data, (response)=>{
            if(response){
              
                $(`#${this.itemToDelId}`).closest('.itemids').fadeOut(400, function() {
                    $(this).remove(); 
                });
                var msgAlert = `
                <div class="alert p-2 rounded-md bg-bgcard border border-bgborder animate__animated animate__backInRight">
                    <span class="text-xs font-popin">${response.msg}</span>
                </div>
                `;
                var alertElement = $(msgAlert).appendTo('#alertMsg');
                setTimeout(() => {
                    alertElement.fadeOut(500, function() {
                        $(this).remove();
                    });
                }, 5000);
                delItems.close();
            }
        });
    }
}
export default DeletionItems;