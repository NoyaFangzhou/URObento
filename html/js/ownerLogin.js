$(document).ready(function(){
     $('#owner_login_btn').click(signup);
});


var signup = function() {
	console.log("Owner Log In");
	var username = $('#username').val();
	var password = $('#password').val();
	if (username == "" || password == "") {
		window.alert("Error! All content must be filled!");
	}
	else {
		var form = document.getElementById("owner_login_info");
		console.log(form);
	 	form.submit();
	}
}
