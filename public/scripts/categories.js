$(".modal-add-update").hide();
//$(".")

$(".modal-delete").hide();


function updateCategory(id) {
   // console.log(id);
    $.ajax({
        url: "/categories/" + id,
        type: "GET",
        datatype: "json",
        success: function (data) {
            //console.log(data);
            let result = JSON.parse(data)[0];
            console.log(result);
            $(".category").text("Category " + result['id'] + ":");
            $("#name").val(result['name']);
            $("#briefing").val(result['briefing']);
            $("#addUpdateButton").text("Update");
            $(".modal-add-update").show();
            $(".close-modal").click( function () {
                $(".modal-add-update").hide();
            });
            $("#categoryForm").submit(function (event) {
                event.preventDefault();
                $.ajax({
                    url: "/categories/" + id,
                    type: "PUT",
                    data: {
                        name: $("#name").val(),
                        briefing: $("#briefing").val()
                    },
                    success: function (data) {
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

function deleteCategory(id) {
    console.log(id);
    $(".delete-category").text(`Are you sure you want to delete category ${id}?`)
    $(".modal-delete").show();
    $("#noButton").click(function () {
        $(".modal-delete").hide();
    });
    $("#yesButton").click(function () {

        $.ajax({
            url: "/categories/" + id,
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

function addCategory() {
    console.log("aha");
    $(".category").text("Category:")
    $("#name").val("");
    $("#briefing").val("");
    $("#addUpdateButton").text("Add");
    $(".modal-add-update").show();
    $(".close-modal").click( function () {
        $(".modal-add-update").hide();
    });
    $("#categoryForm").submit(function (event) {
        event.preventDefault();
       $.ajax({
           url: "/categories",
           type: "POST",
           data: {
               name: $("#name").val(),
               briefing: $("#briefing").val()
           },
           success: function (data) {
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


        $('#myTable').dataTable({
            "processing": true,
            "serverSide": true,
            "ajax":{
                url: "/categories/all",
                type: "GET"
            },
               "columns": [
                {"data": "id"},
                {"data": "name"},
                   {"data": "briefing"},
                   {"render": function ( data, type, row, meta ) {
                            //return row.id;
                           return `<button onclick="updateCategory(${row.id})" id="update${row.id}" type="button" class="update-button m-2 btn btn-primary btn-lg text-uppercase">&#128393;</button><button type="button" onclick="deleteCategory(${row.id})" id="delete${row.id}" class=" delete-button m-2 btn btn-lg btn-primary  text-uppercase">&#10007;</button>`;

                       }}]

        });

        $('.categories').append(`<button onclick="addCategory()" id="add" type="button" class="add-button btn btn-primary btn-lg text-uppercase">&#43;</button>`)



    });


})(jQuery);

