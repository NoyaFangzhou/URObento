function checkOut(sum, restaurant_id, user_id, count) {
	// body...
	var address = $('#deliver_address').val();
	var note = $('#note').val();
	var method = $('#pay_method').val();

	if (address == "") {
		window.alert("The deliver address cannot be left empty!");
		return;
	}
	if (count <= 0) {
		window.alert("Your Shop Cart is empty, please add your faviorate dishes!");
		window.location.href = "../index.html";
		return;
	}
	$.ajax({

        url: './checkOutHandler.php',

        type: "POST",                  // GET or POST

        data: {
        	'tag': 0,
            'restaurant_id':restaurant_id,
            'sum': sum,
            'user_id': user_id,
            'address': address,
            'pay_method': method,
            'requirement': note
        },

        dataType: "json",             // json format

        success: function( data ) {   // function to execute upon a successful request
            console.log("Display Dish Reviews");
            console.log(data.result);
            if (data.result == "success") {
	 			if ($('#shop_cart').hasClass("active")) {
	              $('#shop_cart').removeClass("active");
	            }
	            window.alert("You had checked out successfully!\n You will be rediret to the main page after 2s");
	            setTimeout("window.location.href ='../index.html'", 2000);
	            return;
            }
            else {
				window.alert("Check Out Failed!\nReason: " + data.result);
            }
           
        },

        error: function(request) {   // function to call when the request fails, other errors
        	window.alert("Check Out Failed!");
        }
    });
}

function deleteFromCart(dishName) {
	console.log("Delete " + dishName);
	// body...
	$.ajax({

        url: './checkOutHandler.php',

        type: "POST",                  // GET or POST

        data: {
        	'tag': 1,
            'dish_name': dishName
        },

        dataType: "json",             // json format

        success: function( data ) {   // function to execute upon a successful request
            console.log("Display Dish Reviews");
            console.log(data.result);
            if (data.result == "success") {
            	window.location.reload();
            }
            else {
				window.alert("Delete Failed!");
            }
           
        },

        error: function(request) {   // function to call when the request fails, other errors
        	window.alert("Delete Failed!");
        }
    });
}