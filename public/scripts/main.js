

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

    $.ajax({
        url: "/cart",
        type: "GET",
        datatype: "json",
        success: function(data){
            console.log("success");
            let result = JSON.parse(data);
            console.log(result[0]);
            for(let index = 0; index < result.length; index++)
            {
                let product = result[index];
                $('#cartContent').append(`<div class="col-lg-4 col-sm-6 mb-4">
                    <!-- Portfolio item 1-->
                    <div class="portfolio-item">
                        <a class="portfolio-link" data-bs-toggle="modal" href="#portfolioModal1">
                            <div class="portfolio-hover">
                                <!--<div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>-->
                            </div>
                            <img class="img-fluid" src="${product['url']}" alt="..."/>
                        </a>
                        <div class="portfolio-caption">
                            <div class="portfolio-caption-heading">` + product['name'] + `</div>
                            <div class="portfolio-caption-subheading text-muted">` + product['description'] + `</div>
                            <div class="portfolio-caption-subheading text-muted">${product['price']} RON</div>
                            <form class="less-button"><input type="text" value="${product['id']}" hidden>
                                <button type="submit" class="btn btn-primary text-uppercase rounded-circle">-
                                </button></form>
                            <form class="more-button"><input type="text" value="${product['id']}" hidden>
                                <button type="submit" class="btn btn-primary text-uppercase rounded-circle">+
                                </button></form>
                        </div>
                    </div>
                </div>`);

            }
        },
        error: function(msg) {
            console.log("error");
            console.log(msg);
        }
        });
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


