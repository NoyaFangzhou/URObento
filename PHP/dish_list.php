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
			<div class="panel panel-default">
			        <div class="panel-heading">
						Restaurant ID: <?php echo $row['restaurant_id']?>
			        </div>
		    		<div class="panel-body">
			    		<div class="col-sm-4">
			    			<a><img src=<?php echo $row['dish_img']?> class="thumbnail" style="height: 100%; width: 100%" alt="Lights"></a>
    					</div> <!-- end of col-xm-4 -->
    					<div class="col-sm-8">
    						<table class="table">
							    <tbody>
							      <tr>
							        <td><h4><?php echo $row['dname']?></h4></td>
							      </tr>
							      <tr>
							      	<td><?php echo $row['dprice']?></td>
							      </tr>
							    </tbody>
							</table>
    					</div>
					</div> <!-- end of panel-body -->
					<div class="panel-footer"></div> 
		    </div> <!-- panel-default --> 
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