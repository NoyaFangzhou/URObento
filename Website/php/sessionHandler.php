<?php

session_start(); // Using the session to store the cart

$userID = $_COOKIE['user_id'];
$dname = $_POST['dish_name'];
$restaurantID = $_POST['restaurant_id'];
if(!empty($dname)) {
	if (!isset($_SESSION['user_id'])) {
		$_SESSION['user_id'] = $userID;
	}
	if (!isset($_SESSION['restaurant_id'])) {
		$_SESSION['restaurant_id'] = $restaurantID;
	}
	// upload the restaurant_id for the current order

	if (!isset($_SESSION['dishes'])) {
		$_SESSION['dishes'][$dname] = 1;
		// echo "NOT SET SESSION[dishes]";
	}
	else {
		// if user add a duplicate dish, it will automatically add 1 to its quality
		// echo "SET SESSION[dishes] ";
		if(isset($_SESSION['dishes'][$dname])) {
			$_SESSION['dishes'][$dname] = $_SESSION['dishes'][$dname] + 1;
		}
		else {
			$_SESSION['dishes'][$dname] = 1;
		}

	}
}
// foreach ($_SESSION['dishes'] as $key=>$value) {
// 	echo $key . " => " . $value;
// }
echo json_encode(array('result'=>'success', 'count'=>count($_SESSION['dishes'])));
?>