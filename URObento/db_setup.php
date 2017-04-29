<?php
$servername = "localhost";
$username = "ngu3";
$password = "xXWBbVWy";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
//echo "Connected successfully";

?>


