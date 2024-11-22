class showRcntAct{
    constructor(viewRcntBtn, viewRcntModalCon, viewRcntModal) {
        this.viewRcntBtn = viewRcntBtn;
        this.viewRcntModalCon = viewRcntModalCon;
        this.viewRcntModal = viewRcntModal;
        this.bindEvent();
    }
    bindEvent() {
        $(document).on('click', this.viewRcntBtn, (e) => {
            this.loadViewRcntAct(e);
        });
    }
    loadViewRcntAct(e) {
        e.preventDefault
        this.viewRcnId = $(e.currentTarget).attr('id');
        $.post(this.viewRcntModal, { getId: this.viewRcnId }, (response) => {
            $(this.viewRcntModalCon).html(response);
        });
    }
}
export default showRcntAct