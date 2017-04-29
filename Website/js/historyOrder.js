$(document).ready(function(){
     $('#logout').click(logout);
});

function loadOrderDetail(order_id, restaurant_id) {
	console.log("Load Order Detail");

	var form = document.createElement("form");
    form.setAttribute("method", "POST");
    form.setAttribute("action", "./orderDetail.php");
	var hiddenRid = document.createElement("input");
    hiddenRid.setAttribute("type", "hidden");
    hiddenRid.setAttribute("name", "restaurant_id");
    hiddenRid.setAttribute("value", restaurant_id);
    form.appendChild(hiddenRid);
    var hiddenOid = document.createElement("input");
    hiddenOid.setAttribute("type", "hidden");
    hiddenOid.setAttribute("name", "order_id");
    hiddenOid.setAttribute("value", order_id);
    form.appendChild(hiddenOid);
    document.body.appendChild(form);
    form.submit();

}

// logout
var logout = function() {
    console.log("Log OUT!");
    $.ajax({

    url: "./userLogOutHandler.php",

    type: "POST",

    // when successfully receive response
    success: function (data) {
        console.log("Success Receive Response from userLogoutHandler.php");
        window.location.href = "../index.html";
    },

    error: function (request) {
        console.log("Error Receive Response from userLogoutHandler.php");
        window.location.href = "../index.html";
        return;
    }
    });
}