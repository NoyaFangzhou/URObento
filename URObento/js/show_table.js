$(document).ready(function(){
     $('#customer').click(view_customer);
     $('#owner').click(view_owner);
     $('#restaurant').click(view_rest);
     $('#restaurant_comm').click(view_restcomm);
     $('#dish').click(view_dish);
     $('#dish_comm').click(view_dishcomm);
     $('#order').click(view_order);
     $('#order_detail').click(view_orderdetail);
});  



var view_customer = function () {
    $("#result").html("customer");
    // $.ajax({

    // url: "../cgi-bin/sign_in.php",

    // type: "POST"

    // });
}

var view_owner = function () {
    $("#result").html("owner")
    // $.ajax({

    // url: "../cgi-bin/sign_in.php",

    // type: "POST"

    // });
}

var view_rest = function () {
    $("#result").html("restaurant")
    // $.ajax({

    // url: "../cgi-bin/sign_in.php",

    // type: "POST"

    // });
}

var view_restcomm = function () {
    $("#result").html("restaurant comment")
    // $.ajax({

    // url: "../cgi-bin/sign_in.php",

    // type: "POST"

    // });
}

var view_dish = function () {
    $("#result").html("dish")
    // $.ajax({

    // url: "../cgi-bin/sign_in.php",

    // type: "POST"

    // });
}

var view_dishcomm = function () {
    $("#result").html("dish comment")
    // $.ajax({

    // url: "../cgi-bin/sign_in.php",

    // type: "POST"

    // });
}

var view_order = function () {
    $("#result").html("order")
    // $.ajax({

    // url: "../cgi-bin/sign_in.php",

    // type: "POST"

    // });
}

var view_orderdetail = function () {
    $("#result").html("order detail")
    // $.ajax({

    // url: "../cgi-bin/sign_in.php",

    // type: "POST"

    // });
}