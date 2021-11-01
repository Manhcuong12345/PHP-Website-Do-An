$(document).ready(function () {
    $(".num-order").change(function () {
        var update_cart = "";
        var num_order = $(this).val();
        var id = $(this).parent("td").parent("tr").attr("data-id");
        // var price = $(this).parent("td").prev(".price").text();

        var data = {
            update_cart: update_cart,
            id: id,
            num_order: num_order,
            // price: price,
        };

        $.ajax({
            url: "?mod=cart&action=update",
            method: "POST",
            data: data,
            dataType: "json",
            success: function (data) {
                console.log(data);
                $(data.selector_num_order).text(data.num_order);
                $(data.selector_sub_total).text(data.sub_total);
                $("#total-price > span").text(data.total);
                $("span#num").text(data.cart_num_order);
                $("div#cart-wp > div#dropdown p span").text(data.text);
            },
        });
    });

    // $("a.add-cart").click(function (){
        
    //     var add_cart_ajax = "";
    //     var id = $("div#num-order-wp > input").attr('data-id');
    //     var num_order = $("div#num-order-wp > input").val();
        
    //     var data = {
    //         id : id,
    //         num_order : num_order,
    //         add_cart_ajax: add_cart_ajax,
    //     }
        
    //     $.ajax({
    //         url:"?mod=cart&action=addCart",
    //         method: "POST",
    //         data: data,
    //         dataType : "json",
    //         success: function (data) {
    //             console.log(data);
    //         }
    //     })
        
    // })


    // Ajax Pagging Product
    $(".section").on("click", "ul.list-pagging li a", function(e) {
        e.stopPropagation(); // important
        e.preventDefault();
        
        var page = $(this).parent("li").attr('data-page');
        var cat_id = $(this).parent("li").parent("ul").parent("div").parent("div").children("ul").attr('data-type');
        var data = {
            page : page,
            cat_id : cat_id
        }

        $.ajax({
            url : "?mod=home&action=pagging",
            method : "POST",
            data : data,
            dataType : "json",
            success: function(data){
                console.log(data);
                var selector_product = "ul[data-type ='" + cat_id + "']";
                $(selector_product).html(data.list_product);
                var selector_pagging = "div[data-type ='" + cat_id + "']"
                $(selector_pagging).children("div.section-detail").children("div").html(data.pagging);
            }
        })
    })

    // Ajax Filler
    
    // $("form#filter-product table tbody tr td:nth-child(1)").click(function(){
    //     var method = $(this).children("input").attr('data-type');
    //     var data = {
    //         method : method
    //     }
    // });
});


