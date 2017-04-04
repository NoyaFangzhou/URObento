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
require_once('db_setup.php');
$sql = "USE ngu3;";
if ($conn->query($sql) === TRUE) {
   // echo "using Database tbiswas2_company";
} else {
   echo "Error using  database: " . $conn->error;
}

// Query:
$sql = "SELECT * FROM UROB_Dish;";
$result = $conn->query($sql);
?>
<?php
if($result->num_rows > 0){
?>
<div class="container">
	<div class="row">
		<div class="col-sm-12 blog-main">
			<?php 
			while ($row = $result->fetch_assoc()) {
			?>
			<div class="col-sm-offset-1 col-sm-10">
              <div class="col-sm-3">
              	<div>
              		<a href="">
              			<img src=<?php echo $row['dish_img']?> class="img-thumbnail" width="100%" height="100%" alt="Lights">
              		</a>
              	</div>
              </div>
              <div class="col-sm-5 text-left">
                <p><label>Dish name:</label><?php echo $row['restaurant_id']?></p>
                <p><label>Restuarant:</label><?php echo $row['dname']?></p>
                <p><label>Price:</label><?php echo $row['dprice']?></p>
              </div>
              <div class="col-sm-2 mx-auto">
                <button class="btn btn-primary">Remove</button>
              </div>
            </div> <!-- end of col-sm-offset-1 col-sm-10 -->
			<?php
			} // end of while
			?>
		</div> <!--  end of block-main -->
	</div> <!-- end of row -->
</div> <!-- end of container -->
<?php
} // end of if
$conn->close();
?>
</body>
</html>