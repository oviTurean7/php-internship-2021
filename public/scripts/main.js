console.log('loading this script');

$(document).ready(function () {
    console.log("ready!");

    $('.cart-button').on('click',function () {
        let productId = this.parentNode.parentNode.firstElementChild.value;
        $.ajax({
            url: '/add-product.php',
            method: 'GET',
            data: {
                pId: productId,
            },
            success: function () {
                console.log('done');
            }
        });
    });

    $('.sortBy').on('click', function () {
        let column = this.id;
        $.ajax({
            url: '/index.php',
            method: 'GET',
            data: {
                sort: column,
            },
            success: function () {
                console.log(column);
            }
        });
    });

    $('.add-button').on('click',function (cnt, id) {
        cnt = this.parentNode.parentNode.children[4].innerText;
        $.ajax({
            url: '/cart.php/' + id,
            method: 'POST',
            data: {
                productCount: parseInt(cnt)+1,
            },
            success: function () {
                window.location.reload();
            }
        });
    });
});
