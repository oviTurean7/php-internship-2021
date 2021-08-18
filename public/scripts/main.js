

$(document).ready(function() {

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

});


function changeArrowsAndText (element, isItText) {

    if (element.classList.contains("down"))
    {
        //console.log("down");
        let text = "";
        if (isItText !== "")
        {
            text = "Read less";
        }
        element.innerHTML = text + " &#5169;", element.classList = "up float-end";
        return "down";
    }
    else
    {
        //console.log("up");
        let text = "";
        if (isItText !== "")
        {
            text = "Read more";
        }
        element.innerHTML = text + " &#5167;", element.classList = "down float-end";
        return "up";
    }

}

$(".radioSort").click(function () {
   console.log($(".radioSort:checked").val());

});

