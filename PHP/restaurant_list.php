<!DOCTYPE html>
<html>
<head>
	<title>Restaurant Relation Info</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
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
$sql = "SELECT * FROM RESTAURANT;";
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
<h1 align="center">Restaurant Info</h1>
<div class="container">
    <div class="row">
        <div class="col-sm-12 blog-main">
				<div id="posts">
				<?php
				while ($row = $result->fetch_assoc()) {
				?>
					<p>
		          	<div class="panel panel-default">
			          	<div class="panel-heading">
			          		ID: <?php echo $row['restaurant_id']?>
			          	</div>
			    		<div class="panel-body">
				    		<div class="col-sm-4">
				    			<img src=<?php echo $row['restaurant_img']?>; class="img-rounded" style="height: 100%; width: 100%">
	    					</div> <!-- end of col-xm-4 -->
	    					<div class="col-sm-8">
	    						<table class="table">
								    <tbody>
								      <tr>
								        <td><h4><?php echo $row['rname']?></h4></td>
								      </tr>
								      <tr>
								      	<td><?php echo $row['average_cost']?></td>
								      </tr>
								      <tr>
								        <td><h6><?php echo $row['raddress']?></h6></td>
								      </tr>
								      <tr>
								        <td><h6><?php echo $row['rphone']?></h6></td>
								      </tr>
								    </tbody>
								  </table>
	    					</div>
			    		</div> <!-- end of panel-body -->
			    		<div class="panel-footer"></div> 
		    		</div> <!-- panel-default --> 
		    		</p>
		    		
		    	<?php
				}// end of while
				}// end of if
				else {
					echo "Item not found";
				}
		    	?>
				</div>  <!-- end of posts div -->
        </div> <!-- end of blog-post div -->
    </div> <!-- end of row div -->
</div> <!-- end of container -->
?>

<?php
$conn->close();
?>
</body>
</html>