console.log('loading this script');

const toggleArrow = (dataValue, op) => {
    if(op == 'asc') {
        $(`.arrow[data-value=${dataValue}]`).removeClass('arrowDown');
        $(`.arrow[data-value=${dataValue}]`).addClass('arrowUp');
    }
    else {
        $(`.arrow[data-value=${dataValue}]`).removeClass('arrowUp');
        $(`.arrow[data-value=${dataValue}]`).addClass('arrowDown');
    }
}

$(document).ready(function () {
    console.log("ready!");
    const urlSearchParams = new URLSearchParams(window.location.search);
    const params = Object.fromEntries(urlSearchParams.entries());

    if (params.column && params.operation) {
        toggleArrow(params.column, params.operation);
    }
});

function addToCart(product) {
    console.log('ADD IN CART')
    product.quantity = 1

    $.ajax({
        url: '/add-product',
        type: "POST",
        data: {product},
        datatype: "json",
        success: function (data) {
            console.log('SUCCESS')
            console.log(data)
        }
    })
}

function updateQuantity(product, sign) {
    if(sign > 0) product.quantity++
    else product.quantity--

    if(product.quantity > 0) {
        $.ajax({
            url: '/update-quantity',
            type: "PUT",
            data: {product},
            datatype: "json",
            success: function (data) {
                console.log('SUCCESS')
                console.log(data)
            }
        })
    }
    else {
        $.ajax({
            url: '/remove-cart-product?id='+product.id,
            type: "DELETE",
            data: {},
            datatype: "json",
            success: function (data) {
                console.log('SUCCESS')
                console.log(data)
            }
        })
    }
}
