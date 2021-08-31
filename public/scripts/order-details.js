let products = {}

function getProductName(id) {
    $.ajax({
        url: "/products/" + id,
        type: "GET",
        success: function (data) {
            //console.log(JSON.parse(data));
            let product = JSON.parse(data)[0];
            if (product === undefined)
                return;
            products[product['id']] = product['name'];
            console.log(product['name']);
            const replaceaqble = "#name" + id;
            $(replaceaqble).text(product['name']);
            //return product['name'];
        }
    });
}

$(document).ready(function () {
    $('#myTable').dataTable({
        "processing": true,
        "serverSide": true,
        "ajax":{
            url: window.location.href + "/items",
            type: "GET"
        },
        "columns": [
            {"data": "id"},
            {"render": function ( data, type, row, meta ) {
                    //return row.id;
                    getProductName(row.product_id);
                    //console.log(row.id);
                    return `<span id="name${row.product_id}">${row.product_id}</span>`;

                }},
            {"data": "number_of_units"},
            {"data": "price"}]

    });
    //getProductName(1);
});