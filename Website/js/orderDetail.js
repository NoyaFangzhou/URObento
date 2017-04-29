$(document).ready(function(){
     $('#logout').click(logout);
});

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