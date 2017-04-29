/**
 * Created by Fangzhou Liu on 10/20/2016.
 *
 * Javascript for Login page for cookie check
 * 
 */
$(document).ready(function(){
     $('#logout').click(logout);
     $('#shop_cart').click(loadShopCart);
});




// send the cookie to the server before the page was loaded
// 
function loadMenu(restaurant_id) {
    // .ajax is the core Ajax function supported by jQuery and requires the following parameters:
    //  url: the URL of the resource to send the request to
    //  data: the data to send along with the request; encoded as a query string for GET
    //  dataType: the expected format of the data coming back in the response
    //  success: a function to execute if the request is successful
    //  error: a function to execute if the request fails for any reason
    $.ajax({

        url: './restaurantTagHandler.php',

        type: "POST",                  // GET or POST

        data: {
            'tag': 0,
            'restaurant_id':restaurant_id
        },

        dataType: "json",             // json format

        success: function( data ) {   // function to execute upon a successful request
            console.log("Display Menus");
            $('#menuTag').addClass("active");
            if ($('#reviewTag').hasClass("active")) {
              $('#reviewTag').removeClass("active");
            }
            if ($('#writeReviewTag').hasClass("active")) {
              $('#writeReviewTag').removeClass("active");
            }
            $('#tag_content').empty(); // clear the old content of this div
            $('#tag_content').html(data.content); // load the new content on the div
        },

        error: function(request) {   // function to call when the request fails, other errors
            $('#menuTag').addClass("active");
            if ($('#reviewTag').hasClass("active")) {
              $('#reviewTag').removeClass("active");
            }
            if ($('#writeReviewTag').hasClass("active")) {
              $('#writeReviewTag').removeClass("active");
            }
            error_handler();
        }
    });
}

// when the user click the login button on the screen
// this login method will be triggeerd
function loadReview(restaurant_id) {
  $.ajax({

        url: './restaurantTagHandler.php',

        type: "POST",                  // GET or POST

        data: {
            'tag': 1,
            'restaurant_id':restaurant_id
        },

        dataType: "json",             // json format

        success: function( data ) {   // function to execute upon a successful request
            console.log("Display Reviews");
            console.log(data.content);
            $('#reviewTag').addClass("active");
            if ($('#menuTag').hasClass("active")) {
              $('#menuTag').removeClass("active");
            }
            if ($('#writeReviewTag').hasClass("active")) {
              $('#writeReviewTag').removeClass("active");
            }
            $('#tag_content').empty(); // clear the old content of this div
            $('#tag_content').html(data.content); // load the new content on the div
        },

        error: function(request) {   // function to call when the request fails, other errors
            $('#reviewTag').addClass("active");
            if ($('#menuTag').hasClass("active")) {
              $('#menuTag').removeClass("active");
            }
            if ($('#writeReviewTag').hasClass("active")) {
              $('#writeReviewTag').removeClass("active");
            }
            error_handler();
        }
    });
}

// call when signup button clicked
function writeReview(restaurant_id) {
    $.ajax({

        url: './restaurantTagHandler.php',

        type: "POST",                  // GET or POST

        data: {
            'tag': 2,
            'restaurant_id': restaurant_id
        },

        dataType: "json",             // json format

        success: function( data ) {   // function to execute upon a successful request
            console.log("Display Write Review View");
            $('#writeReviewTag').addClass("active");
            if ($('#menuTag').hasClass("active")) {
              $('#menuTag').removeClass("active");
            }
            if ($('#reviewTag').hasClass("active")) {
              $('#reviewTag').removeClass("active");
            }
            $('#tag_content').empty(); // clear the old content of this div
            $('#tag_content').html(data.content); // load the new content on the div
        },

        error: function(request) {   // function to call when the request fails, other errors
            $('#writeReviewTag').addClass("active");
            if ($('#menuTag').hasClass("active")) {
              $('#menuTag').removeClass("active");
            }
            if ($('#reviewTag').hasClass("active")) {
              $('#reviewTag').removeClass("active");
            }
            error_handler();
        }
    });
}

var uploadReview = function(restaurant_id, username) {
  
  if (username == "") {
    window.alert("You must submit the review when you login!");
    window.location.href = "../index.html";
    return;
  }
  var rate = $('#rating').val();
  var review = $('#reviewText').val();

   $.ajax({

        url: './updateReviewHandler.php',

        type: "POST",                  // GET or POST

        data: {
            'restaurant_id': restaurant_id,
            'username': username,
            'rate': rate,
            'review': review
        },

        dataType: "json",             // json format

        success: function( data ) {   // function to execute upon a successful request
          console.log("Upload New Review");
          console.log(data.result);
          if (data.result == "success") {
            $('#statusPanel').html("<div class='alert alert-success' role='alert'>The review had been added successfully ^o^</div>");
            $('#reviewText').empty();
          }
          else {
            $('#statusPanel').html("<div class='alert alert-danger' role='alert'>The review failed to be added T.T\n" + data.result + "</div>");
          }
        },

        error: function(request) {   // function to call when the request fails, other errors
            $('#statusPanel').html("<div class='alert alert-danger' role='alert'>The review failed to be added T.T</div>");
        }
    });

}

var error_handler = function() {
    $('#tag_content').empty(); // clear the old content of this div
    $('#tag_content').html("<p><div class='alert alert-danger' role='alert'>Error Receive Response from restaurantTagHandler.php</div></p>"); // load the new content on the div

}

function addToChart(dishName, restaurant_id) {
   $.ajax({

        url: './sessionHandler.php',

        type: "POST",                  // GET or POST

        data: {
            'dish_name': dishName,
            'restaurant_id': restaurant_id
        },

        dataType: "json",             // json format

        success: function( data ) {   // function to execute upon a successful request
          console.log("Add to Chart");
          if (data.result == "success") {
            $('#shop_cart').html("My Cart" + "(" +data.count+ ")");
          }
          else {
            window.alert("Failed to add this dish into the Shopping Chart\nReason: "+data.result);
          }
        },

        error: function(request) {   // function to call when the request fails, other errors
            window.alert("Failed to add this dish into the Shopping Chart");
        }
    });
}

function loadDishReviews(dishName, restaurant_id) {
    console.log("Jump to Dish Detail View");
    // body...
    var form = document.createElement("form");
    form.setAttribute("method", "POST");
    form.setAttribute("action", "./dishDetail.php");
    var hiddenRid = document.createElement("input");
    hiddenRid.setAttribute("type", "hidden");
    hiddenRid.setAttribute("name", "restaurant_id");
    hiddenRid.setAttribute("value", restaurant_id);
    form.appendChild(hiddenRid);
    var hiddenDname = document.createElement("input");
    hiddenDname.setAttribute("type", "hidden");
    hiddenDname.setAttribute("name", "dish_name");
    hiddenDname.setAttribute("value", dishName);
    form.appendChild(hiddenDname);
    document.body.appendChild(form);
    form.submit();
}

var loadShopCart = function() {
    console.log("Load Shop Cart");
    $.ajax({

        url: './sessionHandler.php',

        type: "POST",                  // GET or POST

        dataType: "json",             // json format

        success: function( data ) {   // function to execute upon a successful request
          console.log("Add to Chart");
          if (data.result == "success" && data.count > 0) {
            window.location.href = "./shopCart.php";
          }
          else {
            window.alert("Your shop cart currently is empty!");
            return;
          }
        },

        error: function(request) {   // function to call when the request fails, other errors
            window.alert("Failed to add this dish into the Shopping Chart");
        }
    });

}