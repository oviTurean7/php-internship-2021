
$(document).ready(function () {
    if (localStorage.getItem('logging') !== null) {
        $('#signup').hide();
        $('#logging').text(localStorage.getItem('logging'));
    }
    else {
        $('#signup').show();
    }

});

$('#logging').click(function () {
    if (localStorage.getItem('logging') !== null) {
        $.ajax({
            url: "/logout",
            type: "POST",
            success: function () {
                localStorage.removeItem('logging');
                setTimeout(()=>window.location.reload(), 100);
            },
            error: function (message) {
                console.log(message);
            }
        });

    }
    else {

        window.location.replace("http://php.local/login");
    }
});

$(".cart-button").submit(function (event) {
    console.log("alabala");

    event.preventDefault();
    event.stopImmediatePropagation();
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
            $('#numberOfProducts').innerText = data['items'];
            $('#numberOfProducts').load(document.URL +  ' #numberOfProducts');
            $('#items').innerText = data['items'];
            $('#items').load(document.URL +  ' #items');
            $('#total').innerText = data['price'];
            $('#total').load(document.URL +  ' #total');
            $(".modal").show();
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

       success: function(){
           console.log("success");
           console.log(dataChecked.attr('id'));

           sessionStorage.setItem("checkbox", dataChecked.attr('id'));

          // window.location.reload();
           $('.row').load(document.URL +  ' .row');

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
                //window.location.reload();
            },
            error: function (message) {
                console.log(message);
            }
        })
    }
});


function changeQuantity(toAdd, id) {
    $.ajax({
        type: "PUT",
        url: '/cart/' + id,
        data: {
            add: toAdd
        },
        success: function(data){
            window.location.reload();
        },
        error: function (message) {
            console.log(message);
        }
    })

}


function deleteFromCart(id) {
    $.ajax({
        type: "DELETE",
        url: '/cart/' + id,
        success: function(data){
            window.location.reload();
        },
        error: function (message) {
            console.log(message);
        }
    })
}


