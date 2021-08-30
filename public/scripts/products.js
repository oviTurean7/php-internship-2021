$(".modal-add-update").hide();
//$(".")

$(".modal-delete").hide();

let  categories = {};

function getCategories() {
    $.ajax({
        url: "/categories/all",
        type: "GET",
        success: function(data) {
           // console.log(data["data"]);
            for (let index = 0; index < data["data"].length; index++)
            {
                //console.log(data["data"][index]);

                categories[data["data"][index][0]] = [data["data"][index][1], data["data"][index][2]];
            }

            //categories = data["data"];
            //console.log(categories);
            $("select").html(`<option value="" class="gray" disabled selected hidden>Category id *</option>`);
            for (const [key, value] of Object.entries(categories)) {
                //console.log(key, value);
                let name = value[0];
                $("select").append(`<option value="${key}">${name}</option>`);
            }

            populateTable();
        }
    })
}

function updateProduct(id) {
    // console.log(id);
    $.ajax({
        url: "/products/" + id,
        type: "GET",
        datatype: "json",
        success: function (data) {
            //console.log(data);
            let result = JSON.parse(data)[0];
            console.log(result);
            $(".product").text("Product " + result['id'] + ":");
            $("#name").val(result['name']);
            $("#units").val(result['units']);
            $("#price").val(result['price']);
            $("#description").val(result['description']);
            $("#url").val(result['url']);
            $("#categoryId").val(result['category_id']);
            $("#addUpdateButton").text("Update");
            $(".modal-add-update").show();
            $(".modal-add-update").show();
            $(".close-modal").click( function () {
                $(".modal-add-update").hide();
            });
            $("#productForm").submit(function (event) {
                event.preventDefault();
                $.ajax({
                    url: "/products/" + id,
                    type: "PUT",
                    data: {
                        name: $("#name").val(),
                        units: $("#units").val(),
                        price: $("#price").val(),
                        description: $("#description").val(),
                        url: $("#url").val(),
                        categoryId: $("#categoryId").val()
                    },
                    success: function (data) {
                       // console.log(data);
                        window.location.reload();
                    },
                    error: function (data) {
                        //console.log(data);
                        $("#submitError").children(0).text(data.responseText);
                        $("#submitError").removeClass("d-none");
                    }
                })
            });
        }
    });

}

function deleteProduct(id) {
    console.log(id);
    $(".delete-product").text(`Are you sure you want to delete product ${id}?`)
    $(".modal-delete").show();
    $("#noButton").click(function () {
        $(".modal-delete").hide();
    });
    $("#yesButton").click(function () {

        $.ajax({
            url: "/products/" + id,
            type: "DELETE",
            success: function (data) {
                $(".modal-delete").hide();
                window.location.reload();
            },
            error: function (data) {
                console.log(data);
                //$("#submitError").children(0).text(data.responseText);
                //$("#submitError").removeClass("d-none");
            }
        })
    });
    /*
    */

}

function addProduct() {
    console.log("aha");
    $(".product").text("Product:")
    $("#name").val("");
    $("#units").val("");
    $("#price").val("");
    $("#description").val("");
    $("#url").val("");
    $("#categoryId").val("");
    $("#addUpdateButton").text("Add");
    $(".modal-add-update").show();
    $(".close-modal").click( function () {
        $(".modal-add-update").hide();
    });
    $("#productForm").submit(function (event) {
        event.preventDefault();
        $.ajax({
            url: "/products",
            type: "POST",
            data: {
                name: $("#name").val(),
                units: $("#units").val(),
                price: $("#price").val(),
                description: $("#description").val(),
                url: $("#url").val(),
                categoryId: $("#categoryId").val()
            },
            success: function (data) {
                //console.log(data);
                window.location.reload();
            },
            error: function (data) {
                //console.log(data);
                $("#submitError").children(0).text(data.responseText);
                $("#submitError").removeClass("d-none");
            }
        })
    });
}

(function ($) {

    $(document).ready(function () {
        // alert("aaaaaaaaaaaaaaa");
        getCategories();




    });


})(jQuery);

function populateTable() {
    $('#myTable').dataTable({
        "processing": true,
        "serverSide": true,
        "ajax":{
            url: "/products/all",
            type: "GET"
        },
        "columns": [
            {"data": "id"},
            {"data": "name"},
            {"data": "units"},
            {"data": "price"},
            {"data": "description"},
            {"data": "url"},
            {"render": function ( data, type, row, meta ) {
                    //return row.id;
                    let id = row['category_id'];
                    //console.log(row['category_id']);
                    let name = categories[id][0].toString();
                    //console.log(name);
                    return `<div>${name}</div>`;

                }},

            {"render": function ( data, type, row, meta ) {
                    //return row.id;
                    return `<button onclick="updateProduct(${row.id})" id="update${row.id}" type="button" class="update-button m-2 btn btn-primary btn-lg text-uppercase">&#128393;</button><button type="button" onclick="deleteProduct(${row.id})" id="delete${row.id}" class=" delete-button m-2 btn btn-lg btn-primary  text-uppercase">&#10007;</button>`;

                }}]

    });

    $('.products').append(`<button onclick="addProduct()" id="add" type="button" class="add-button btn btn-primary btn-lg text-uppercase">&#43;</button>`)

}