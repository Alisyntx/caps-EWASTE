$(document).ready(function () {
    $('#lgnForm').submit(function (e) { 
        e.preventDefault();
        var url = '../src/landing/php/login.php';
        var data = $(this).serialize();

        $.post(url, data, function (response) {
            // Create alert message
            my_modal_lgn.close();
            const msgAlert = `
                <div class="flex alert p-1 rounded-md bg-bgcard border border-bgborder animate__animated animate__fadeIn">
                    <span class="text-xs font-popin font-semibold">${response.msg}..</span>
                    <i data-lucide="check" class="w-5 h-5 mx-0 text-bgtext"></i>
                </div>`;
            
            // Append alert to #alertMsg
            const alertElement = $(msgAlert).appendTo("#alertMsg");

            // Auto fade out the alert after 5 seconds
            setTimeout(() => {
                alertElement.fadeOut(500, function () {
                    $(this).remove();
                    // Redirect based on success or failure
                    if (response.scs) {
                        window.location.href = response.redirect;
                    }
                });
            }, 3000);
        });
    });
});
