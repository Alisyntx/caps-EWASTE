class deletionCtg{
    constructor(delCtgBtn, delCtgModalCon, delCtgModal, delCtgForm,delCtgUrl) {
        this.delCtgBtn = delCtgBtn;
        this.delCtgModalCon = delCtgModalCon;
        this.delCtgModal = delCtgModal;
        this.delCtgForm = delCtgForm;
        this.delCtgUrl = delCtgUrl;
        this.delCtgId = null;
        this.bindEvent();
    }

    bindEvent() {
        $(document).on('click', this.delCtgBtn, (e) => { this.loadDelCtg(e) })
        $(this.delCtgModalCon).on('submit', this.delCtgForm, (e) => {
            this.submitDelCtg(e)
        })
    }

    loadDelCtg(e) {
        e.preventDefault();
        this.delCtgId = $(e.currentTarget).attr('id');
       
        $.post(this.delCtgModal, { getId: this.delCtgId }, (response) => {
            $(this.delCtgModalCon).html(response); 
        });
    }
    submitDelCtg(e) {
       e.preventDefault();
        const data = $(e.currentTarget).serialize();
        $.post(this.delCtgUrl,data,(response)=>{
            
            $(`#catalog-${this.delCtgId}`).fadeOut(400, function() {
                $(this).remove();
            });
            console.log($(`#catalog-${this.delCtgId}`).closest('.ctgIds'));

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
                delCtg.close();
        });
    }
}
export default deletionCtg;