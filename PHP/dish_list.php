<!DOCTYPE html>
<html>
<head>
	<title>Dish Relation Info</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<h1 align="center">Dish Info</h1>
<?php
// DB setup
require_once('../../../secure_dbsetup/db_setup.php');
$sql = "USE tbiswas2_php;";
if ($conn->query($sql) === TRUE) {
   // echo "using Database tbiswas2_company";
} else {
   echo "Error using  database: " . $conn->error;
}

// Query:
$sql = "SELECT * FROM DISH;";
$result = $conn->query($sql);

if ($result === TRUE) {
    //echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
} 
?>
<?php
if($result->num_rows > 0){
?>
<?php 
while ($row = $result->fetch_assoc()) {
?>
<div class="container">
	<div class="row">
		<div class="col-sm-12 blog-main">
			<div class="col-md-3">
				<div class="thumbnail">
					<a href=<?php echo $row['dish_img']?>>
						<img src=<?php echo $row['dish_img']?>; alt="Lights" style="width:100%">
						<div class="caption">
							<table class="table">
								<tbody>
								<tr>
									<td><h4><?php echo $row['restaurant_id']?></h4></td>
								</tr>
								<tr>
									<td><h4><?php echo $row['dname']?></h4></td>
								</tr>
								<tr>
									<td><h4><?php echo $row['dprice']?></h4></td>
								</tr>
								</tbody>
							</table>
						</div>
					</a>
				</div>
			</div> <!-- end of col-md-3 -->
		</div> <!--  end of block-main -->
	</div> <!-- end of row -->
</div> <!-- end of container -->
<?php
} // end of while
} // end of if
?>
</body>
</html>