
$(document).ready (function () {

    $("#passwordForm").submit(function (event) {
        //console.log($("#password").val());
        event.preventDefault();

        let pw = $("#password").val();
        let cpw = $("#cpassword").val();
        if (pw !== cpw) {
            $('#submitError').children(0).text('Passwords do not match');
            $('#submitError').removeClass("d-none");
            return;
        }
        token = window.location.href.substr(window.location.href.indexOf("=") + 1);
        //console.log(token);

        $.ajax({
            url: "/recover?token=" + token,
            type: "POST",

            data: {
                token: token,
                password: pw,
            },

            success: function(data) {
                console.log(data);
                console.log('alabala');
                //localStorage.setItem('logging', 'Log out');
                window.location.replace('http://php.local/login');
            },
            error: function(error) {
                console.log(error.responseText);
                $('#submitError').children(0).text(error.responseText);
                $('#submitError').removeClass("d-none");
            }
        })
    });
});
