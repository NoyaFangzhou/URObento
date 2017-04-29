<?php
// Cookie exist
if (!empty($_COOKIE['username'])) {
	// get the username and password from the cookie
	$name = $_COOKIE['username'];
	$pwd = $_COOKIE['password'];
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
	if($result->num_rows > 0) {
		echo json_encode(array('result'=>'success','user_name'=>$name));
	}
	else {
		echo json_encode(array('result'=>'wrong info'));
	}
}
// no Cookie
else {
	echo json_encode(array('result'=>'nil'));
}
?>