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
<div class="container">
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="../welcome.html">Obento</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li><a href="user_list.php">Customer</a></li>
            <li><a href="owner_list.php">Owner</a></li>
            <li><a href="restaurant_list.php">Restaurant</a></li>
            <li><a href="r_reviews.php">Restaurant Review</a></li>
            <li class="active"><a href="dish_list.php">Dish</a></li>
            <li><a href="d_reviews.php">Dish Review</a></li>
            <li><a href="order_list.php">Order</a></li>
            <li><a href="ordered_dish.php">Order Detail</a></li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>   
</div>
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
							      	<td>$ <?php echo $row['dprice']?></td>
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