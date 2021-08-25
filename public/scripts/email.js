
$(document).ready (function () {

    $("#emailForm").submit(function (event) {
        //console.log($("#password").val());
        event.preventDefault();
        let em = $("#email").val();
        $.ajax({
            url: "/login/forgot-password",
            type: "POST",

            data: {
                email: em
            },
            success: function(data) {
                console.log(data);
                if (data === "has email") {
                    $('#submitSuccess').children(0).text('You have been sent an email with the following steps');
                    $('#submitSuccess').removeClass("d-none");
                }
                else {
                    $('#submitSuccess').children(0).html('You do not have an account. <a href="http://php.local/signup">Sign up here</a>');
                    $('#submitSuccess').removeClass("d-none");
                }

            },
            error: function(error) {
                //console.log("err");
                console.log(error.responseText);
                $('#submitError').children(0).text(error.responseText);
                $('#submitError').removeClass("d-none");
            }
        })
    });
});
