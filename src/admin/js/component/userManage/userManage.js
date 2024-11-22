class userManagement {
    constructor(userManageBtn, userManageModal, userManageForm, loadManageModal, userManageUrl, userFetch) {
        this.userManageBtn = userManageBtn;
        this.userManageModal = userManageModal;
        this.userManageForm = userManageForm;
        this.loadManageModal = loadManageModal;
        this.userManageUrl = userManageUrl;
        this.userFetch = userFetch;
        this.userIds = null;
        this.bindEvents();
    }

    bindEvents() {
        $(document).on('click', this.userManageBtn, (e) => this.loadUserManageModal(e));
        $(this.userManageModal).on('submit', this.userManageForm, (e) => this.submitManageForm(e));
    }

    loadUserManageModal(e) {
        e.preventDefault();
        this.userIds = $(e.currentTarget).attr('id');
        $.post(this.loadManageModal, { getId: this.userIds }, (response) => {
            $(this.userManageModal).html(response);
        });
    }

    submitManageForm(e) {
    e.preventDefault();
    $.post(this.userManageUrl, $(this.userManageForm).serialize(), (response) => {
        if (response.success) {
            // Show success alert
            var msgAlert = `
            <div class="alert p-2 rounded-md font-popin bg-green-100 border border-green-400 animate__animated animate__backInRight">
                <span class="text-xs font-popin">${response.msg}</span>
            </div>`;
            var alertElement = $(msgAlert).appendTo("#editItemsCtgAlertMsg");

            // Remove alert after a short delay
            setTimeout(() => {
                alertElement.fadeOut(500, function () {
                    $(this).remove();
                });
            }, 5000); // 2 seconds delay to show the alert

            // Replace the row with updated data
            $("#userRow" + this.userIds).replaceWith(response.updatedRow);
            editUser.close();
            // Re-create Lucide icons
            lucide.createIcons();
        } else {
            // Show error alert
            var msgAlert = `
            <div class="alert p-2 rounded-md font-popin bg-red-100 border border-red-400 animate__animated animate__backInRight">
                <span class="text-xs font-popin">${response.msg}</span>
            </div>`;
            var alertElement = $(msgAlert).appendTo("#editItemsCtgAlertMsg");

            // Remove the alert after some time
            setTimeout(() => {
                alertElement.fadeOut(500, function () {
                    $(this).remove();
                });
            }, 5000);
        }
    }, "json"); // Ensure the server response is in JSON format
}

}

export default userManagement;
