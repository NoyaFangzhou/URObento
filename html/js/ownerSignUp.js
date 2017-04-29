$(document).ready(function(){
     $('#owner_signup_btn').click(signup);
});


var signup = function() {
	console.log("Owner Sign Up");
	var username = $('#username').val();
	var password = $('#password').val();
	var confirm = $('#confirm_password').val();
	if (username == "" || password == "" || confirm == "") {
		window.alert("Error! All content must be filled!");
	}
	else if (password != confirm) {
		window.alert("Sorry! Your confirm password is different with your previous input password. Please check!");
	}
	else {
		var form = document.getElementById("owner_signup_info");
		console.log(form);
	 	form.submit();
	}
}
