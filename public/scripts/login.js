
$(document).ready (function () {

    $("#loginForm").submit(function (event) {
        //console.log($("#password").val());
       event.preventDefault();
       let em = $("#email").val();
       let pw = $("#password").val();
       $.ajax({
           url: "/login",
           type: "POST",

           data: {
               email: em,
               password: pw
           },
           success: function(data) {
               console.log(data);
               console.log('alabala');
               localStorage.setItem('logging', 'Log out');
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
