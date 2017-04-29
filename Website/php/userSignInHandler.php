<?php
// get the username and password from the cookie
$name = $_POST['username'];
$pwd = $_POST['password'];
$remember = $_POST['remember'];


// verfiy the user
require_once('db_setup.php');
$sql = 'USE ngu3;';
if ($conn->query($sql) == TRUE) {
  // connect sucessfully
}
else {
  echo json_encode(array('result'=>'db fail'));
}

// Query
$sql = "SELECT * FROM UROB_Customer WHERE username = '" . $name . "' AND password = '" . $pwd . "';";
$result = $conn->query($sql);
// return the result
// echo json_encode(array('result'=>$result->num_rows));
if($result->num_rows > 0) {
        // prepare cookies
	$row = $result->fetch_assoc();
        if ($remember == TRUE) {
			// set the cookie and the duration for the cookie is one week
			setcookie('user_id', $row['user_id'], time()+7*24*3600);
			setcookie('username', $name, time()+7*24*3600);
			setcookie('password', $pwd, time()+7*24*3600);
		}
		else {
			setcookie('user_id', $row['user_id']);
			setcookie('username', $name);
			setcookie('password',$pwd);
		}
        echo json_encode(array('result'=>'success', 'user_name'=>$name));

}
else {
        echo json_encode(array('result'=>'Wrong Username or Password, Please check your spelling!'));
}


?>
