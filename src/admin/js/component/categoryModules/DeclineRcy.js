class declineRcy {
    constructor(declineRcyBtn, declineRcyModal, declineRcyForm, loadDeclineRcyModal, declineRcyUrl) {
        this.declineRcyBtn = declineRcyBtn;
        this.declineRcyModal = declineRcyModal;
        this.declineRcyForm = declineRcyForm;
        this.loadDeclineRcyModal = loadDeclineRcyModal;
        this.declineRcyUrl = declineRcyUrl;
        this.rcyItemsId = null;
        this.bindEvent();
    }

    bindEvent() {
        // Open modal on button click
        $(document).on("click", this.declineRcyBtn, (e) => this.loadRcyDecline(e));
        
        // Submit form within modal
        $(document).on("submit", this.declineRcyForm, (e) => this.submitRcyDecline(e));
        
    }

    loadRcyDecline(e) {
        e.preventDefault();
        this.rcyItemsId = $(e.currentTarget).attr("id");
        
        // Load modal content via AJAX
        $.post(this.loadDeclineRcyModal, { getId: this.rcyItemsId }, (response) => {
            $(this.declineRcyModal).html(response).removeClass("hidden");
            $("body").addClass("modal-open"); // Prevent background scroll
        });
    }
    
    submitRcyDecline(e) {
        e.preventDefault();
       
        const data = $(e.currentTarget).serialize();
        
        // Submit the decline form via AJAX
        $.post(this.declineRcyUrl, data, (response) => {
            
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
                
                // Close modal after submission
                declineRcy.close();
            }
        });
    }

}

export default declineRcy;
