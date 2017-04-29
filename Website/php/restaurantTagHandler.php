<?php
// handle which view to display
$tag = $_POST['tag'];
$restaurantID = $_POST['restaurant_id'];
//echo "tag = " . $tag . " restaurantID = " . $restaurantID;

// DB setup
require_once('db_setup.php');
$sql = 'USE ngu3;';
if ($conn->query($sql) == TRUE) {
  // connect sucessfully
}
else {
  echo json_encode(array('content' => "Error using database: " . $conn->error));
}

if ($tag == 0) {
	// menu
	$sql = "SELECT * FROM UROB_Dish WHERE restaurant_id = '$restaurantID';";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		$viewContent = "";
		while ($row = $result->fetch_assoc()) {
			$viewContent .= ("<div class='col-lg-12'>
				<hr class='margin-=bot'>
                <div class='thumbnail col-lg-2'>
                    <img src='" . $row['dish_img'] . "' alt=''>
                </div>
                <div class='col-lg-5'>
                    <h3><label>Name: </label>" . $row['dname'] . "</h3>
                    <p><label>Price: </label>$ " . $row['dprice'] . "</p>
                </div>
                <div class='col-lg-2 top-buffer'>
                 	<p>
                    	<button class='btn btn-primary' onclick='addToChart(\"" . $row['dname'] . "\", " . $row['restaurant_id'] . ")'>Add</button>
                  	</p>
                  	<p>
	                  	<button class='btn btn-primary' onclick='loadDishReviews(\"" . $row['dname'] . "\", " . $row['restaurant_id'] . ")'>Reviews</button>
	                </p>
                </div>
            </div>");
		}
	}
    else {
      $viewContent = "<p><div class='alert alert-warning' role='alert'>Sorry. This restaurant has no dishes available now</div></p>";
    }
    echo json_encode(array("content"=>$viewContent));
}
else if ($tag == 1) {
	// review
  $sql = "SELECT username, rscore, time, rcomment FROM UROB_Rcomment, UROB_Customer WHERE restaurant_id = '$restaurantID' AND UROB_Rcomment.user_id = UROB_Customer.user_id;";

	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		$viewContent = '';
		while ($row = $result->fetch_assoc()) {
			$viewContent .= ("<div class=' col-lg-12 text-left top-buffer'>
              <div class='media'>
              	<div class='media-left'>
              		<img src='../img/default_user_icon.jpg' class='media-object' style='width:64px'>
              	</div>
              	<div class='media-body'>
              		<h4 class='media-heading'>" . $row['username'] . "</h4>
              		<p><small><i>" . $row['time'] . "</i></small></p>
              	</div>
              	<div class='media-right'>
              		<h4 style='color: red'>Rate: " . $row['rscore'] . "</h4>
              	</div>
              	<div>
              		<p>" . $row['rcomment'] . "</p>
              	</div>
        	</div>
        	</div><hr>");
		}
	}
    else {
      $viewContent = "<p><div class='alert alert-warning' role='alert'>Sorry. This restaurant has no reviews now</div></p>";
    }
    // echo "viewContent " . $viewContent;
	echo json_encode(array('content'=>$viewContent));
}
else {
	// write review
	$username = $_COOKIE['username'];
	$viewContent = "<div class=' col-lg-12 text-left top-buffer'>
			  <p id='statusPanel'></p>
              <h2>Leave a review:</h2>
              <form action='./updateReviewHandler.php' method='post'>
                <p><label>Comment:</label></p>
                <textarea class='form-control' rows='3' id='reviewText'></textarea>
                <p>
                  <label>Rate:</label>
                  <select class='form-control' id='rating'>
                    <option value='1'>1</option>
                    <option value='2'>2</option>
                    <option value='3'>3</option>
                    <option value='4'>4</option>
                    <option value='5'>5</option>
                  </select>
                </p>
                <p class='col-lg-12'><input class='btn btn-primary' type='button' value='submit' onclick='uploadReview(" . $restaurantID . ", \"" . $username . "\"" . ")'></p>
              </form>
            </div>";
	// echo $viewContent;
	echo json_encode(array("content"=>$viewContent));
}
?>