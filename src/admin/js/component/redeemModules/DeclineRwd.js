class declineRwd {
    constructor(declineRwdBtn, declineRwdModal, declineRwdForm, loaddeclineRwdModal, declineRwdUrl) {
        this.declineRwdBtn = declineRwdBtn;
        this.declineRwdModal = declineRwdModal;
        this.declineRwdForm = declineRwdForm;
        this.loaddeclineRwdModal = loaddeclineRwdModal;
        this.declineRwdUrl = declineRwdUrl;
        this.rwdItemsId = null;
        this.bindEvent();
    }

    bindEvent() {
        // Open modal on button click
        $(document).on("click", this.declineRwdBtn, (e) => this.loadRwdDecline(e));
        // Submit form within modal
        $(document).on("submit", this.declineRwdForm, (e) => this.submitRwdDecline(e));
    }

    loadRwdDecline(e) {
        e.preventDefault();
        this.rwdItemsId = $(e.currentTarget).attr("id");

        // Load modal content via AJAX
        $.post(this.loaddeclineRwdModal, { getId: this.rwdItemsId }, (response) => {
           
           $(this.declineRwdModal).html(response)
        });
    }
    
    submitRwdDecline(e) {
        e.preventDefault();
        const data = $(e.currentTarget).serialize();
        
        // Submit the decline form via AJAX
        $.post(this.declineRwdUrl, data, (response) => {
            if (response) {
                // Display success message
               
                const msgAlert = `
                    <div class="flex alert p-1 rounded-md bg-bgcard border border-bgborder animate__animated animate__fadeIn">
                        <span class="text-xs font-popin font-semibold">${response.msg}</span>
                        <i data-lucide="check" class="w-5 h-5 mx-0 text-bgtext"></i>
                    </div>`;
                const alertElement = $(msgAlert).appendTo("#addItemCtyAlertMsg");
                setTimeout(() => {
                    alertElement.fadeOut(500, function () {
                        $(this).remove();
                    });
                }, 5000);
                // Remove item row for declined item
                const itemId = response.itemId;
                $(`#tr_${itemId}`).fadeOut(400, function() {
                    $(this).remove();
                });
                lucide.createIcons();
            }
        });
    }

}

export default declineRwd;
