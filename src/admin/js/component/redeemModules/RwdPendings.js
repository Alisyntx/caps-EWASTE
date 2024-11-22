class rwdPendings {
    constructor(
        acceptRwdBtn,
        acceptRwdModal,
        acceptRwdForm,
        loadRwdItemModal,
        acceptRwdUrl
    ) {
        this.acceptRwdBtn = acceptRwdBtn;
        this.acceptRwdModal = acceptRwdModal;
        this.acceptRwdForm = acceptRwdForm;
        this.loadRwdItemModal = loadRwdItemModal;
        this.acceptRwdUrl = acceptRwdUrl;
        this.rwdItemsId = null;
        this.bindEvent();
    }

    bindEvent() {
        $(document).on("click", this.acceptRwdBtn, (e) =>
            this.loadRwdPending(e)
        );
        $(this.acceptRwdModal).on("submit", this.acceptRwdForm, (e) =>
            this.submitAcceptRwd(e)
        );
    }

    loadRwdPending(e) {
        e.preventDefault();
        this.rwdItemsId = $(e.currentTarget).attr("id");

        $.post(
            this.loadRwdItemModal,
            { getId: this.rwdItemsId },
            (response) => {
                $(this.acceptRwdModal).html(response);
            }
        );
    }

    submitAcceptRwd(e) {
        e.preventDefault();
        acceptRwdItem.close();
        let formData = $(this.acceptRwdForm).serialize();

        $.ajax({
            url: this.acceptRwdUrl,
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

export default rwdPendings;
