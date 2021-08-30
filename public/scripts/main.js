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

    let editor = new $.fn.dataTable.Editor({
        ajax: '/categories/editor',
        table: "#categories",
        idSrc: "id",
        fields: [ {
            label: "Name:",
            name: "name"
        }, {
            label: "Briefing:",
            name: "briefing"
        }
        ]
    });

    $('#categories').DataTable({
        "dom": 'Bfrtip',
        "serverSide": false,
        "ajax": '/categories',
        "select": true,
        "columns": [
            { "data": "id" },
            { "data": "name" },
            { "data": "briefing" },
        ],
        buttons: [
            { extend: "create", editor: editor },
            { extend: "edit",   editor: editor },
            {
                extend: "remove",
                editor: editor,
                formMessage: function ( e, dt ) {
                    var rows = dt.rows( e.modifier() ).data().pluck('name');
                    return 'Are you sure you want to delete the entries for the '+
                        'following record(s)? <ul><li>'+rows.join('</li><li>')+'</li></ul>';
                }
            }
        ]
    });

    // $('#categories').on( 'click', 'tbody tr', function () {
    //     editor.edit(this, {
    //         title: 'Edit record',
    //         buttons: 'Update',
    //         submit: 'allIfChanged'
    //     });
    // })
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


