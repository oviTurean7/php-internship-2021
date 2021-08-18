console.log('loading this script');

$(document).ready(function() {
    console.log("ready!");
    $("button").on('click', function(){
        let productId = this.parentNode.parentNode.firstElementChild.value;
        $.ajax({
            url: '/add-product.php?id=' + productId,
            method: 'GET',
            data: {
                pId : productId,
            },
            success: function(){
                console.log('done');
            }
        });
    });
    $(".sortBy").on('click', function(){
        let column = this.id;
        $.ajax({
            url: '/index.php',
            method: 'GET',
            data : {
              sort : column,
            },
            success: function(){
                console.log(column);
            }
        });
    })
});
