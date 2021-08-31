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
        ajax: {
            url: '/categories/editor',
            success: function (data) {
                console.log('SUCCESS')
            },
            error: function (data) {
                window.location.reload()
            }
        },
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

    let categories = []
    $.ajax({
        url: '/categories',
        success: function (data) {
           categories = JSON.parse(data).data;
           console.log(categories)
        }
    })

    setTimeout(() => {
        const options = categories.map(c => ({label: c.name, value: c.id}))
        console.log(options)
        initializeProductDTE(options)
    }, 100)
});

function initializeProductDTE(categories) {
    let prodEditor = new $.fn.dataTable.Editor({
        ajax: {
            url: '/products-editor/editor',
            success: function (data) {
                console.log('SUCCESS')
            },
            error: function (data) {
                window.location.reload()
            }
        },
        table: "#products",
        idSrc: "id",
        fields: [ {
            label: "Name:",
            name: "name"
        }, {
            label: "Price:",
            name: "price"
        }, {
            label: "Description:",
            name: "description"
        }, {
            label: "Units::",
            name: "units"
        }, {
            label: "Category:",
            name:  "category_id",
            type:  "select",
            options: categories
        }
        ]
    });

    $('#products').DataTable({
        "dom": 'Bfrtip',
        "serverSide": false,
        "ajax": '/products-editor',
        "select": true,
        "columns": [
            { "data": "id" },
            { "data": "name" },
            { "data": "price" },
            { "data": "description" },
            { "data": "units" },
            {
                "data": "category_id",
                "render": function (val, type, row) {
                    const cat = categories.find(c => c.value == val)
                    return cat.label
                }
            },

        ],
        buttons: [
            { extend: "create", editor: prodEditor },
            { extend: "edit",   editor: prodEditor },
            {
                extend: "remove",
                editor: prodEditor,
                formMessage: function ( e, dt ) {
                    var rows = dt.rows( e.modifier() ).data().pluck('name');
                    return 'Are you sure you want to delete the entries for the '+
                        'following record(s)? <ul><li>'+rows.join('</li><li>')+'</li></ul>';
                }
            }
        ]
    });
}

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


