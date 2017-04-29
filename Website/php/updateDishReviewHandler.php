<?php
$name = $_POST['username'];
$restaurantID = $_POST['restaurant_id'];
$dname = $_POST['dish_name'];
$review = $_POST['review'];
$dscore = $_POST['rate'];

// DB setup
require_once('db_setup.php');
$sql = 'USE ngu3;';
if ($conn->query($sql) == TRUE) {
  // connect sucessfully
}
else {
  echo json_encode(array('result' => "Error using database: " . $conn->error));
}
$usersql = "SELECT user_id FROM UROB_Customer WHERE username = '$name'";
$result = $conn->query($usersql);
if ($result->num_rows > 0) {
	// search the userID based on the username
	$row = $result->fetch_assoc();
	$userID = $row['user_id'];
	$time = date('Y-m-d H:i:s');
	if (!empty($review)) {
		// $sql = "INSERT INTO UROB_Dcomment VALUES ('" . $userID . "', " . $restaurantID . ", '" . $review . "', " . $rscore . ");";
		$sql = "INSERT INTO UROB_Dcomment(restaurant_id, user_id, dname, dscore, time, dcomment) VALUES ($restaurantID, $userID, '$dname', $dscore, '" . $time . "', '$review');";
	}
	else {
		// $sql = "INSERT INTO UROB_Dcomment VALUES ('" . $userID . "', " . $restaurantID . ", 'NULL', " . $rscore . ");";
		$sql = "INSERT INTO UROB_Dcomment(restaurant_id, user_id, dname, dscore, time, dcomment) VALUES ($restaurantID, $userID, '$dname', '" . $time . "', $dscore, , 'NULL');";
	}
	$result = $conn->query($sql);
	if ($result === TRUE) {
	    echo json_encode(array('result'=>'success'));
	} else {
	    echo json_encode(array('result'=>'$conn->error'));
	} 
}
else {
	echo json_encode(array('result'=>'Cannot find the user'));
}
?>