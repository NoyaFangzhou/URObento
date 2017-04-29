/**
 * Created by Fangzhou Liu on 10/20/2016.
 *
 * Javascript for Login page for cookie check
 * 
 */
$(document).ready(function(){
     send_cookie();
     $('#login_btn').click(login);
     $('#logout').click(logout);
     $('#signup_btn').click(signup);
     $('#search_btn').click(search);
});




// send the cookie to the server before the page was loaded
// 
var send_cookie = function () {
    // .ajax is the core Ajax function supported by jQuery and requires the following parameters:
    //  url: the URL of the resource to send the request to
    //  data: the data to send along with the request; encoded as a query string for GET
    //  dataType: the expected format of the data coming back in the response
    //  success: a function to execute if the request is successful
    //  error: a function to execute if the request fails for any reason
    $.ajax({

        url: './php/cookieHandler.php',

        type: "POST",                  // GET or POST

        dataType: "json",             // json format

        success: function( data ) {   // function to execute upon a successful request
          console.log("Send Cookie");
          console.log(data);
                if (data.result != "nil") { // return a cookie
                    //success_handler(data)
                    login_result = data.result;
                    if (login_result == "success") {
                        success_handler(data);
                    }
                }
                else { // no cookie or error
                   error_handler();
                }
        },

        error: function(request) {   // function to call when the request fails, other errors
            error_handler();
        }
    });
}

// when the user click the login button on the screen
// this login method will be triggeerd
var login = function () {

  var user_id = $('#username').val();
  var pwd = $('#password').val();
  var remember = $('#remember_me').prop("checked");
  if (user_id == "" || pwd == "") {
    $('#error_panel_signin').html("Your Username or Password cannot be left empty!!!")
  }

  $.ajax({

    url: "./php/userSignInHandler.php",

    type: "POST",

    data: {
            'username':user_id,
            'password':pwd,
            'remember':remember
          },

    dataType: "json",

    // when successfully login
    success: function (data) {
        console.log("Success Receive Response from SignInHandler.php");
        var login_result = data.result;
        console.log(data);
        if (login_result == "success") {
          success_handler(data);
          $("#login_panel").modal('toggle');
        }
        else {
          login_error(login_result);
        }
    },

    error: function (request,status, error) {
        console.log("Error Receive Response from SignInHandler.php");
        console.log(request);
        console.log(error);
        error_handler()
    }
  });
}

// call when signup button clicked
var signup = function() {
    var username = $('#signup_username').val();
    var nickname = $('#signup_nickname').val();
    var password = $('#signup_password').val();
    var re_password = $('#re_password').val();
    var email = $('#signup_email').val();
    var phone = $('#signup_phone').val();
    var address = $('#signup_address').val();
    var email_regular_exp =/\S+@\S+\.\S+/;
    var phone_regular_exp = /[0-9]$/;
    //console.log(team);

    if(username==""||password==""||re_password==""||phone==""||address==""){
        $('#error_panel_signup').html("All content must be filled out");
        return;
    }

    console.log(re_password);
    console.log(password);

    if(re_password != password){
        $('#error_panel_signup').html("Your two passwords must be the same");
        return;
    }
    if(re_password==password){
        $('#error_panel_signup').html("");
    }
    if(email != "" && !email_regular_exp.test(email)){
        //console.log(regular_exp.test(email));
        $('#error_panel_signup').html("your email style is not valid");
        return;
    }

    if (!phone_regular_exp.test(phone)) {
        $('#error_panel_signup').html("your phone number is not valid");
        return;
    }
    $.ajax({

    url: "./php/userSignUpHandler.php",

    type: "POST",

    data: {
        'username': username,
        'password': password,
        'email': email,
        'phone': phone,
        'address': address
      },

    dataType: "json",

    // when successfully receive response
    success: function (data) {
        console.log("Success Receive Response from userSignUpHandler.php");
        signup_result = data.result;
        //success_handler(data);
        if (signup_result == "success") {
          $("#signup_panel").modal('toggle');
          success_handler(data);
        }
        else {
          $('#error_panel_signup').html(data.result);
          signup_error(signup_result);
          //$('#error_panel_signup').html(data.result);
        }
    },

    error: function (request,status, error) {
        console.log("Error Receive Response from userSignUpHandler.php");
        console.log(error);
        error_handler()
    }
    });
}

// logout
var logout = function() {
    console.log("Log OUT!");
    $.ajax({

    url: "./php/userLogOutHandler.php",

    type: "POST",

    // when successfully receive response
    success: function (data) {
        console.log("Success Receive Response from userLogoutHandler.php");
        error_handler();
    },

    error: function (request) {
        console.log("Error Receive Response from userLogoutHandler.php");
        console.log(error);
        window.location.href = "../index.html";
        return;
    }
    });

}

               
var success_handler = function(data) {
    // alert("!!!???s");
    console.log("success!");
    console.log(data);
    $('#logout').html("<a>Log Out</a>");
    $('#history_order').html("<a href='./php/historyOrder.php'>My Order</a>");
    // $('#login_panel').empty();
    $('#owner_signin').hide();
    $('#owner_join').hide();
    $('#log_in').hide();
    $('#sign_up').hide();
    $('#name_logo').html('Welcome! ' + data.user_name);
    //$('#login_panel').hide();
    //display post field by Ma Jinjian
    //$('#post-field').css("display","block")
    // console.log(data.password)

}

var login_error = function(err_msg) {
    console.log(err_msg);
    error_handler();
    $('#error_panel_signin').html(err_msg);
}

var signup_error = function(err_msg) {
    error_handler();
    $('#error_panel_signup').html(err_msg);
}


var error_handler = function() {
    $('#logout').empty();
     $('#history_order').empty();
    $('#owner_signin').show();
    $('#owner_join').show();
    $('#log_in').show();
    $('#sign_up').show();
    $('#name_logo').html("Welcome!");
}

var search = function() {
    console.log("Search Restaurant");
    var content = $('#search_restaurant').val();
    if (content == "") {
        window.alert("The restaurant name for search cannot be empty!\nIf you want to go over all registered restaurants, please clicked LOOK AROUND button.");
    }
    else {
        var form = document.getElementById("search_content");
        form.submit();
    }
}
