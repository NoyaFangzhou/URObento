<?php
// get the username and password from the cookie
$name = $_POST['username'];
$pwd = $_POST['password'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];

// verfiy the user
require_once('db_setup.php');
$sql = 'USE ngu3;';
if ($conn->query($sql) == TRUE) {
  // connect sucessfully
}
else {
  echo json_encode(array('result'=>'Database Fail'));
}

// Find duplicate username
$dup_sql = "SELECT username FROM UROB_Customer WHERE username = '$name';";
$update_sql = "INSERT INTO UROB_Customer(username, password, phone, address, email) VALUES('" . $name . "', '" . $pwd . "', '" . $phone . "', '" . $address . "'";

$result = $conn->query($dup_sql);
// return the result
if($result->num_rows > 0) {
        // error
        echo json_encode(array('result'=>'Error! The username had already existed, Please change another username'));
}
else {
        // add the user
        if (!empty($email)) {
          $update_sql = $update_sql . ", '" . $email . "');";
        }
        else {
          $update_sql = $update_sql . ", NULL);";
        }
        $result = $conn->query($update_sql);
        if ($result === TRUE) {
            echo json_encode(array('result'=>'success', 'user_name'=>$name));
        }
        else {
            echo json_encode(array('result'=>'Error! Sign Up Failed: ' . $conn->error));
        }
}
?>