$(document).ready(function () {
    $('#lgnForm').submit(function (e) { 
        e.preventDefault();
        var url = '../src/landing/php/login.php';
        var data = $(this).serialize();
        $.post(url, data,function (response) {
            if(response.scs){
                alert(response.msg);
                window.location.href = response.redirect
            }else{
                alert(response.msg);
                window.location.href = response.redirect
            }
            }
        );
    });
});