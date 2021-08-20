$(".modal").hide();

$(document).ready(function() {

    $(".close-modal").click( function () {

        $(".modal").hide();
    });
    if (sessionStorage.getItem("checkbox") !== null) {
        $("#" + sessionStorage.getItem("checkbox")).prop('checked', true);
    }
    direction = sessionStorage.getItem("direction");

    if (direction === "down") {
        console.log("htttere " + direction);
        document.getElementById('sort').innerHTML = " &#5167;";
        document.getElementById('sort').classList = "down float-end";
    }
    console.log("aaaaaaaaaaaaaa");



});
