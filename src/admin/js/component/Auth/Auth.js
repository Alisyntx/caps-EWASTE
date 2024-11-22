class Auth {
    constructor(logoutBtn) {
        this.logoutBtn = logoutBtn;
        this.bindEvents();
    }

    bindEvents() {
        $(document).on('click', this.logoutBtn, (e) => this.logout(e));
    }

    logout(e) {
        e.preventDefault();
        const msgAlert = `
            <div class="flex alert p-1 rounded-md bg-bgcard border border-bgborder animate__animated animate__fadeIn shadow-md">
                <span class="text-xs font-popin font-semibold">Logging out...</span>
                <i data-lucide="check" class="w-5 h-5 mx-0 text-bgtext"> </i>
            </div>`;
        
        const alertElement = $(msgAlert).appendTo("#alertMsg");

        setTimeout(() => {
            alertElement.fadeOut(500, function () {
                $(this).remove();
                // Redirect to logout.php after the alert fades out
                window.location.href = 'logout.php';
            });
        }, 3000);
    }
}

export default Auth;
