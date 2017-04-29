// when the user click the login button on the screen
// this login method will be triggeerd
function loadDishReview(restaurant_id, dishName) {
  $.ajax({

        url: './dishTagHandler.php',

        type: "POST",                  // GET or POST

        data: {
            'tag': 1,
            'restaurant_id':restaurant_id,
            'dish_name': dishName
        },

        dataType: "json",             // json format

        success: function( data ) {   // function to execute upon a successful request
            console.log("Display Dish Reviews");
            console.log(data.content);
            $('#dishReviewTag').addClass("active");
            if ($('#writeDishReviewTag').hasClass("active")) {
              $('#writeDishReviewTag').removeClass("active");
            }
            $('#tag_content').empty(); // clear the old content of this div
            $('#tag_content').html(data.content); // load the new content on the div
        },

        error: function(request) {   // function to call when the request fails, other errors
            $('#dishReviewTag').addClass("active");
            if ($('#writeDishReviewTag').hasClass("active")) {
              $('#writeDishReviewTag').removeClass("active");
            }
            error_handler();
        }
    });
}

// call when signup button clicked
function writeDishReview(restaurant_id, dishName) {
    $.ajax({

        url: './dishTagHandler.php',

        type: "POST",                  // GET or POST

        data: {
            'tag': 2,
            'restaurant_id': restaurant_id,
            'dish_name': dishName
        },

        dataType: "json",             // json format

        success: function( data ) {   // function to execute upon a successful request
            console.log("Display Write Dish Review View");
            $('#writeDishReviewTag').addClass("active");
            if ($('#dishReviewTag').hasClass("active")) {
              $('#dishReviewTag').removeClass("active");
            }
            $('#tag_content').empty(); // clear the old content of this div
            $('#tag_content').html(data.content); // load the new content on the div
        },

        error: function(request) {   // function to call when the request fails, other errors
            $('#writeDishReviewTag').addClass("active");
            if ($('#dishReviewTag').hasClass("active")) {
              $('#dishReviewTag').removeClass("active");
            }
            error_handler();
        }
    });
}

var uploadDishReview = function(restaurant_id, username, dishName) {
  
  if (username == "") {
    window.alert("You must submit the review when you login!");
    window.location.href = "../index.html";
    return;
  }
  var rate = $('#rating').val();
  var review = $('#reviewText').val();

   $.ajax({

        url: './updateDishReviewHandler.php',

        type: "POST",                  // GET or POST

        data: {
            'restaurant_id': restaurant_id,
            'dish_name': dishName,
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
    $('#tag_content').html("<p><div class='alert alert-danger' role='alert'>Error Receive Response from dishTagHandler.php</div></p>"); // load the new content on the div
}