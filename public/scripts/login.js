
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
           datatype: "json",
           success: function(data) {
               console.log(data);
           },
           error: function(error) {
               console.log(error.responseText);
           }
       })
    });
});
