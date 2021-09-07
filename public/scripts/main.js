console.log('loading this script');

$(document).ready(function () {
    console.log("ready!");

    $('.cart-button').on('click',function () {
        let productId = this.parentNode.parentNode.firstElementChild.value;
        $.ajax({
            url: '/add-product.php',
            dataType: 'json',
            method: 'GET',
            data: {
                pId: productId,
            },
            success: function () {
                window.location.reload();
            }
        });
    });

    $('.sortBy').on('click', function () {
        let column = this.id;
        $.ajax({
            url: '/index.php',
            method: 'POST',
            data: {
                sort: column,
            },
            success: function () {
                console.log('yes');
            }
        });
    });

    $('.add-button').on('click', function () {
        let id = this.parentNode.parentNode.firstElementChild.value;
        $.ajax({
            url : "/cart.php",
            method: 'GET',
            data : {
                addId : id,
            },
            success : function() {
                alert('success');
            }
        });
    });
    $('.dec-button').on('click', function () {
        let id = this.parentNode.parentNode.firstElementChild.value;
        $.ajax({
            url : "/cart.php",
            method: 'GET',
            data : {
                decId : id,
            },
            success : function() {
                window.location.reload();
                alert('success');
            }
        });
    });

    $('.remove-button').on('click', function () {
        let id = this.parentNode.parentNode.firstElementChild.value;
        $.ajax({
            url : "/delete-cart-item",
            method: 'POST',
            data : {
                delId : id,
            },
            success : function() {
                window.location.reload();
                alert('success');
            }
        });
    });

    $('.order-button').on('click', function ($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    });

});
