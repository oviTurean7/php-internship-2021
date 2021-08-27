console.log('loading this script');

const toggleArrow = (dataValue, op) => {
    if (op == 'asc') {
        $(`.arrow[data-value=${dataValue}]`).removeClass('arrowDown');
        $(`.arrow[data-value=${dataValue}]`).addClass('arrowUp');
    } else {
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

    // let table = $('#categories').DataTable({
    //     ajax: '/categories'
    // });

    let table = $('#categories').DataTable({
        ajax: '/categories',
    });
    var Editor = $.fn.dataTable.Editor;
    console.log(Editor)
    let editor = table.editor;

    table.on( 'click', 'tbody td:not(:first-child)', function (e) {
        editor.inline( this );
    } );
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
            console.log(data)
            let totalCost = 0
            let totalQuantity = 0
            const cartProducts = JSON.parse(data)

            cartProducts.forEach(prod => {
                totalCost += prod.price * prod.quantity
                totalQuantity += prod.quantity * 1
            })
            $('#prodNum').html(totalQuantity)
            $('#totalCost').html(totalCost)
            $('#successCart').show()
        }
    })
}

function updateQuantity(product, sign) {
    if (sign > 0) product.quantity++
    else product.quantity--

    if (product.quantity > 0) {
        $.ajax({
            url: '/update-quantity',
            type: "POST",
            data: {product},
            datatype: "json",
            success: function (data) {
                console.log('SUCCESS +')
                window.location.reload()
            }
        })
    } else {
        removeProductFromCart(product.id)
    }
}

function removeProductFromCart(id) {
    $.ajax({
        url: '/remove-cart-product?id=' + id,
        type: "GET",
        data: {},
        datatype: "json",
        success: function (data) {
            console.log('SUCCESS -')
            window.location.reload()
        }
    })
}


