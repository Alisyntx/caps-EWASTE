class delItemCtg{
    constructor(delItemCtgBtn, delItemCtgModalCon, delItemCtgModal, delItemCtgForm, delItemCtgUrl) {
        this.delItemCtgBtn = delItemCtgBtn;
        this.delItemCtgModalCon = delItemCtgModalCon;
        this.delItemCtgModal = delItemCtgModal;
        this.delItemCtgForm = delItemCtgForm;
        this.delItemCtgUrl = delItemCtgUrl;
        this.delItemId = null;
        this.bindEvents();
    }

    bindEvents() {
        $(document).on('click', this.delItemCtgBtn, (e) => this.loadDelItemCtgModal(e));
        $(this.delItemCtgModalCon).on('submit', this.delItemCtgForm, (e)=> this.submitDelItemCtg(e))
    }
    loadDelItemCtgModal(e) {
        e.preventDefault();
        this.delItemId = $(e.currentTarget).attr('id');
        $.post(this.delItemCtgModal, { getId: this.delItemId }, (response) => {
            $(this.delItemCtgModalCon).html(response);
        });
    }
    submitDelItemCtg(e) {
        e.preventDefault()
        const data = $(e.currentTarget).serialize();
        $.post(this.delItemCtgUrl,data, (response)=>{
            if(response){
               
                $(`#${this.delItemId}`).closest('.itemids').fadeOut(200, function() {
                    $(this).remove(); 
                });
                var msgAlert = `
                <div class="alert
                 p-2 rounded-md bg-bgcard border border-bgborder animate__animated animate__backInRight">
                    <span class="text-xs font-popin">${response.msg}</span>
                </div>
                `;
                var alertElement = $(msgAlert).appendTo('#alertMsg');
                setTimeout(() => {
                    alertElement.fadeOut(500, function() {
                        $(this).remove();
                    });
                }, 5000);
                delCtgItems.close();
            }
        });
    }

}
export default delItemCtg;
