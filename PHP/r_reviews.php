<!DOCTYPE html>
<html>
<head>
	<title>Restaurant Reviews Relation Info</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<h1 align="center">Restaurant Review List</h1>
<div class="container">
<div class="row">
<div class="col-md-12 blog-main">
<?php
// DB setup
require_once('db_setup.php');
$sql = "USE ngu3;";
if ($conn->query($sql) === TRUE) {
   // echo "using Database tbiswas2_company";
} else {
   echo "Error using  database: " . $conn->error;
}

// Query:
$sql = "SELECT * FROM UROB_Rcomment;";
$result = $conn->query($sql);
?>
<?php
if($result->num_rows > 0){
?>
<table>
	<thead>
		<tr>Comment ID</tr>
		<tr>User ID</tr>
		<tr>Restaurant ID</tr>
		<tr>Time</tr>
		<tr>Score</tr>
		<tr>Comment</tr>
	</thead>
	<tbody>
<?php
while ($row = $result->fetch_assoc()) {
?>
	<tr>
		<td><?php echo $row['rcomment_id'] ?></td>
		<td><?php echo $row['user_id'] ?></td>
		<td><?php echo $row['restaurant_id'] ?></td>
		<td><?php echo $row['time'] ?></td>
		<td><?php echo $row['rscore'] ?></td>
		<td><?php echo $row['rcomment'] ?></td>
	</tr>
<?php
}// end of while
}// end of if
?>
</tbody>
</table>

</div> <!-- end of blog-main -->	
</div> <!-- end of row -->
</div> <!-- end of container -->
<?php
$conn->close();
?>
</body>
</html>