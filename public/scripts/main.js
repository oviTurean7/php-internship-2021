

$(document).ready(function() {

    if (sessionStorage.getItem("checkbox") !== null) {
        $("#" + sessionStorage.getItem("checkbox")).prop('checked', true);
    }
    direction = sessionStorage.getItem("direction");

    if (direction === "down") {
        console.log("htttere " + direction);
        document.getElementById('sort').innerHTML = " &#5167;";
        document.getElementById('sort').classList = "down float-end";
    }
});


$(".cart-button").submit(function (event) {
    event.preventDefault();
    const productId = $(this).children(0).val();
    console.log(productId);
    $.ajax ({
        url: "/cart",
        type: "POST",
        data: {
            id: productId
        },
        datatype: "json",
        success: function(data){
            console.log("success");
            console.log(data);
        },
        error: function(msg) {
            console.log("error");
            console.log(msg);
        }
    });
});

$('#sort').click( function () {
    const direction = changeArrowsAndText(document.getElementById('sort'), "");
    //console.log(direction);

    $.ajax({
        url: "/product/sort/direction",
        type: "POST",
        data: {
            direction: direction
        },
        datatype: "json",
        success: function(data){
            // console.log("success");
            // console.log(dataChecked.attr('id'));
            //
            sessionStorage.setItem("direction", direction);

            window.location.reload();

        },
        error: function(msg) {
            console.log("error");
            console.log(msg);
        }
    });
});


function changeArrowsAndText (element, isItText) {

    if (element.classList.contains("down"))
    {
        //console.log("down");

        element.innerHTML = " &#5169;", element.classList = "up float-end";
        return "up";
    }
    else
    {
        //console.log("up");

        element.innerHTML = " &#5167;", element.classList = "down float-end";
        return "down";
    }

}

$(".radioSort").click(function () {
   let dataChecked = $(".radioSort:checked");


   $.ajax({
       url: "/product/sort/column",
       type: "POST",
       data: {
           column: dataChecked.val()
       },
       datatype: "json",
       success: function(data){
           console.log("success");
           console.log(dataChecked.attr('id'));

           sessionStorage.setItem("checkbox", dataChecked.attr('id'));

           window.location.reload();

       },
       error: function(msg) {
           console.log("error");
           console.log(msg);
       }
   });
});

$("#fileForm").submit(function (event) {
    event.preventDefault();
    let file = $("#file").prop('files')[0];
    let formData = new FormData();
    formData.append('file', file);
    if (file) {

        $.ajax({
            type: "POST",
            url: '/file',
            dataType: 'text',  // <-- what to expect back from the PHP script, if anything
            cache: false,
            contentType: false,
            processData: false,
            data: formData,
            success: function(data){
                console.log("success " + data);
                $('#submitSuccessMessage').removeClass('d-none');
            },
            error: function (message) {
                console.log(message);
            }
        })
    }
});


