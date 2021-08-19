
$(".modal").hide();

$(document).ready(function() {

    $(".close-modal").click( function () {

        $(".modal").hide();
    });
    if (sessionStorage.getItem("checkbox") !== null) {
        $("#" + sessionStorage.getItem("checkbox")).prop('checked', true);
    }
    direction = sessionStorage.getItem("direction");

    if (direction === "down") {
        console.log("htttere " + direction);
        document.getElementById('sort').innerHTML = " &#5167;";
        document.getElementById('sort').classList = "down float-end";
    }

    $.ajax({
        url: "/cart",
        type: "GET",
        datatype: "json",
        success: function(data){
            console.log("success");
            let result = JSON.parse(data);
            console.log(result[0]);
            $('#cartContent').empty();
            for(let index = 0; index < result.length; index++)
            {
                let product = result[index];
                $('#cartContent').append(`<div class="col-lg-4 col-sm-6 mb-4">
                    <!-- Portfolio item 1-->
                    <div class="portfolio-item cartItem">
                        <div class="portfolio-link" data-bs-toggle="modal" href="#portfolioModal1">
                            
                            <img class="img-fluid" src="${product['url']}" alt="..."/>
                            <form class="delete"><input type="text" value="${product['id']}" hidden>
                                <button type="submit" class="btn btn-outline-primary btn-lg trash"><i class="fa fa-trash" aria-hidden="true"></i>
                              </button></form>
                            
                        </div>
                        <div class="portfolio-caption">
                            <div class="portfolio-caption-heading">` + product['name'] + `</div>
                            <div class="portfolio-caption-subheading text-muted">${product['price']} RON</div>
                            <form class="less">
                                <input type="text" value="${product['id']}" hidden>
                                <button type="submit" class="btn btn-primary text-uppercase rounded-circle"><i class="fa fa-minus" aria-hidden="true"></i>
                                </button></form>
                            <span class="quantity" >
                                <span  class="text-uppercase"> ${product['quantity']}
                                </span></span> 
                            <form class="more"><input type="text" value="${product['id']}" hidden>
                                <button type="submit" class="btn btn-primary text-uppercase rounded-circle"><i class="fa fa-plus" aria-hidden="true"></i>
                                </button></form>
                        </div>
                    </div>
                </div>`);

            }
            $(".more").submit(function (event) {
                event.preventDefault();
                //alert("here");

                console.log($(this).children(0).val());
                changeQuantity(1, $(this).children(0).val());
            });
            $(".less").submit(function (event) {
                event.preventDefault();
                //alert("here");

                console.log($(this).children(0).val());
                changeQuantity(-1, $(this).children(0).val());
            });
            $(".delete").submit(function (event) {
                event.preventDefault();
                //alert("here");

                console.log($(this).children(0).val());
                deleteFromCart( $(this).children(0).val());
            });
        },
        error: function(msg) {
            console.log("error");
            console.log(msg);
        }
        });


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


