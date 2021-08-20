$(document).ready(function () {
    $.ajax({
        url: "/cart/all",
        type: "GET",
        datatype: "json",
        success: function(data){
            console.log("success");
            console.log(data);
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

    let input = document.getElementById( 'upload' );
    let infoArea = document.getElementById( 'upload-label' );

    function readURL(input) {
        //alert("aqaaaaaaaaaaaaaa");
        if (input.files && input.files[0]) {
            let reader = new FileReader();
            $("#insertImage").html('<img id="imageResult" src="#" alt="" class="img-fluid rounded shadow-sm mx-auto d-block">');
            reader.onload = function (e) {
                $('#imageResult')
                    .attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

        $('#upload').change(function () {
            readURL(input);
        });

    




    $('#contactForm').submit(function (event) {
        event.preventDefault();
        if (input.files[0]) {
            emptyCart();



        }
        else {
            $('#submitError').removeClass("d-none");
        }
    })
});

function emptyCart () {
    $.ajax({
        url: "/cart",
        type: "DELETE",

        success: function(data){
            console.log(data);
            window.location.replace("http://php.local/");
        },
        error: function(msg) {
            console.log("error");
            console.log(msg);
        }
    });
}

