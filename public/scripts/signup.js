
$(document).ready (function () {

    $("#signupForm").submit(function (event) {
        //console.log($("#password").val());
        event.preventDefault();
        let em = $("#email").val();
        let pw = $("#password").val();
        let cpw = $("#cpassword").val();
        let fname = $("#firstName").val();
        let lname = $("#lastName").val();
        let addr = $("#address").val();
        let phone = $("#tel").val();
        if (pw !== cpw) {
            $('#submitError').children(0).text('Passwords do not match');
            $('#submitError').removeClass("d-none");
            return;
        }
        $.ajax({
            url: "/signup",
            type: "POST",

            data: {
                email: em,
                password: pw,
                firstName: fname,
                lastName: lname,
                address: addr,
                phone: phone
            },

            success: function(data) {
                console.log(data);
                console.log('alabala');
                //localStorage.setItem('logging', 'Log out');
                window.location.replace('http://php.local');
            },
            error: function(error) {
                console.log(error.responseText);
                $('#submitError').children(0).text(error.responseText);
                $('#submitError').removeClass("d-none");
            }
        })
    });
});
