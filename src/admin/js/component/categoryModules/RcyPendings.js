class rcyPendings {
    constructor(
        acceptRcyBtn,
        acceptRcyModal,
        acceptRcyForm,
        loadRcyItemModal,
        acceptRcyUrl
    ) {
        this.acceptRcyBtn = acceptRcyBtn;
        this.acceptRcyModal = acceptRcyModal;
        this.acceptRcyForm = acceptRcyForm;
        this.loadRcyItemModal = loadRcyItemModal;
        this.acceptRcyUrl = acceptRcyUrl;
        this.rcyItemsId = null;
        this.bindEvent();
    }

    bindEvent() {
        $(document).on("click", this.acceptRcyBtn, (e) =>
            this.loadRcyPending(e)
        );
        $(this.acceptRcyModal).on("submit", this.acceptRcyForm, (e) =>
            this.submitAcceptRcy(e)
        );
    }
    loadRcyPending(e) {
        e.preventDefault();
        this.rcyItemsId = $(e.currentTarget).attr("id");
        // alert(this.rcyItemsId)
        $.post(
            this.loadRcyItemModal,
            { getId: this.rcyItemsId },
            (response) => {
                $(this.acceptRcyModal).html(response);
            }
        );
    }
    submitAcceptRcy(e) {
        e.preventDefault();
        acceptRcyItem.close();
        let formData = $(this.acceptRcyForm).serialize();

        $.ajax({
        url: this.acceptRcyUrl,
        type: "POST",
        data: formData,
        success: (response) => {
           
            var msgAlert = `<div class="flex alert p-2 rounded-md bg-bgcard border border-bgborder animate__animated animate__backInRight">
                <span class="text-xs font-popin">${response.msg}</span>
                <i data-lucide="check" class="w-5 h-5 text-bgtext"></i>
            </div>`;          
            // Append alert message
            var alertElement = $(msgAlert).appendTo("#addItemCtyAlertMsg");
            setTimeout(() => {
                alertElement.fadeOut(500, function () {
                    $(this).remove();
                });
            }, 5000);
            // Remove the accepted item's row from the table
            let itemId = response.itemId;  // Assuming your PHP returns the id of the accepted item
            $(`#tr_${itemId}`).fadeOut(400, function() {
                $(this).remove(); 
            });
            // Re-create Lucide icons
            lucide.createIcons();
        },
        error: (xhr, status, error) => {
            console.error("Error: " + error);
        },
    });
    }
}
export default rcyPendings;
