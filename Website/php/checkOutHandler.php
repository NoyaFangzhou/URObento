<?php
session_start();
$tag = $_POST['tag'];

if ($tag == 0) {
	// check out
	require_once('db_setup.php');
    $sql = 'USE ngu3;';
    if ($conn->query($sql) == TRUE) {
      // connect sucessfully
    }
    else {
      echo json_encode(array('result'=>'Error using database: ' . $conn->error));
    }
    $userID = $_POST['user_id'];
    $restaurantID = $_POST['restaurant_id'];
    $destination = $_POST['address'];
    $method = $_POST['pay_method'];
    $total = $_POST['sum'];
    $time = date('Y-m-d H:i:s');

    if (!isset($_POST['requirement'])) {
    	$ordersql = "INSERT INTO UROB_Order(user_id, restaurant_id, delivery_address, time, total_price, status, paying_method, requirement) VALUES($userID, $restaurantID, '$destination', '$time', $total, 0, $method, 'NULL');";
    }
    else {
    	$require = $_POST['requirement'];
    	$ordersql = "INSERT INTO UROB_Order(user_id, restaurant_id, delivery_address, time, total_price, status, paying_method, requirement) VALUES($userID, $restaurantID, '$destination', '$time', $total, 0, $method, '$require');";
    }
    // echo json_encode(array('result'=>$ordersql));
    $result = $conn->query($ordersql);
    if ($result === TRUE) {

    }
    else {
    	echo json_encode(array('result'=>'Upload your Order Failed!'));
    }
    $findOrderIDsql = "SELECT MAX(order_id) AS order_num FROM UROB_Order WHERE restaurant_id = $restaurantID;";
	// echo json_encode(array('result'=>$findOrderIDsql));
	$result = $conn->query($findOrderIDsql);
	// echo json_encode(array('result'=>$result->num_rows));
	// $row = $result->fetch_assoc();
	// echo json_encode(array('result'=>$row['order_num']));
	// if ($result->num_rows > 0) {
	// 	echo json_encode(array('result'=>'hhhhhhhhhhhhhh'));
	$row = $result->fetch_assoc();
	$lastoid = $row['order_num'];
	// // echo json_encode('result'=>'fetch_assoc');
	foreach ($_SESSION['dishes'] as $dname => $quantity) {
		$orderdishsql = "INSERT INTO UROB_Orderdishes(order_id, restaurant_id, dname, quantity) VALUES ($lastoid, $restaurantID, '$dname', $quantity);";
		// echo json_encode(array('result'=>$orderdishsql));
		$result = $conn->query($orderdishsql);
		if ($result !== TRUE) {
			echo json_encode(array('result'=>'Upload your Ordered Dish Failed!'));
		}
	}
	session_destroy(); // clear all content in the shop cart 
	echo json_encode(array('result'=>'success'));
	// }
	// else {
	// 	echo json_encode('result'=>'Failed to find your orderID!');
	// }

}
else {
	// delete
	
	if (isset($_POST['dish_name'])) {
		$dname = $_POST['dish_name'];
		if (isset($_SESSION['dishes'][$dname])) {
			unset($_SESSION['dishes'][$dname]);
			$_SESSION['dishes'] = array_values($_SESSION['dishes']);
		}
		echo json_encode(array('result'=>'success'));
	}
	else {
		echo json_encode(array('result'=>'fail'));
	}
		
}
?>