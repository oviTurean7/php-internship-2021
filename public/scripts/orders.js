$(".modal-add-update").hide();
//$(".")

$(".modal-delete").hide();


function deleteOrder(id) {
    console.log(id);
    $(".delete-category").text(`Are you sure you want to delete order ${id}?`)
    $(".modal-delete").show();
    $("#noButton").click(function () {
        $(".modal-delete").hide();
    });
    $("#yesButton").click(function () {

        $.ajax({
            url: "/orders/" + id,
            type: "DELETE",
            success: function (data) {
                console.log(data);
                $(".modal-delete").hide();
                //window.location.reload();
            },
            error: function (data) {
                // console.log(data);
                //$("#submitError").children(0).text(data.responseText);
                //$("#submitError").removeClass("d-none");
            }
        })
    });
    /*
    */

}


(function ($) {

    $(document).ready(function () {
        // alert("aaaaaaaaaaaaaaa");


        $('#myTable').dataTable({
            "processing": true,
            "serverSide": true,
            "ajax":{
                url: "/orders/all",
                type: "GET"
            },
               "columns": [
                   {"render": function (ata, type, row, meta) {
                            return `<a href="http://php.local/orders/${row.id}">${row.id}</a>`
                       }},

                {"data": "total_price"},
                   {"data": "first_name"},
                   {"data": "last_name"},
                   {"data": "email"},
                   {"data": "address"},
                   {"data": "image_url"},
                   {"render": function ( data, type, row, meta ) {
                            //return row.id;
                           return `<button type="button" onclick="deleteOrder(${row.id})" id="delete${row.id}" class=" delete-button m-2 btn btn-lg btn-primary  text-uppercase">&#10007;</button>`;

                       }}]

        });





    });


})(jQuery);

