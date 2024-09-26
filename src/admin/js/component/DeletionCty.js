class DeletionCty {
    constructor(delBtn,modalConId,delFormId,loadModalDel,delCtyUrl){
        this.delBtn = delBtn;
        this.modalConId = modalConId;
        this.delFormId = delFormId;
        this.loadModalDel = loadModalDel;
        this.delCtyUrl = delCtyUrl;
        this.itemToDel = null;

        this.bindEvents();
    }

    bindEvents(){
        $(document).on('click', this.delBtn, (e) => this.loadDelModal(e));
        $(this.modalConId).on('submit', this.delFormId, (e) => this.submitDelForm(e))
    };

    loadDelModal(e){
        e.preventDefault();
        this.itemToDel = $(e.currentTarget).attr('id');
        $.post(this.loadModalDel,{getId : this.itemToDel}, (Response)=>{
            $(this.modalConId).html(Response);
        });
    }
    submitDelForm(e){
        e.preventDefault();
        const data = $(e.currentTarget).serialize();
        $.post(this.delCtyUrl,data,(response)=>{

            $(`#${this.itemToDel}`).closest('.ctyIds').fadeOut(400, function() {
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
                 delCty.close();
        });
    }
}
export default DeletionCty;