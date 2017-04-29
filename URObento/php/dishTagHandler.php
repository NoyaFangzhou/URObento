<?php
// handle which view to display
$tag = $_POST['tag'];
$restaurantID = $_POST['restaurant_id'];
$dname = $_POST['dish_name'];
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

if ($tag == 1) {
	// dish review
	// $sql = "SELECT username, rscore, time, rcomment FROM (UROB_Rcomment INNER JOIN UROB_Customer ON UROB_Customer.user_id = UROB_Rcomment.user_id) AS TempTable WHERE TempTable.restaurant_id = '$restaurantID';";
	// $sql = "SELECT * FROM UROB_Dcomment WHERE restaurant_id = '$restaurantID' AND dname = '$dname';";
  $sql = "SELECT username, dscore, time, dcomment FROM UROB_Dcomment, UROB_Customer WHERE restaurant_id = '$restaurantID' AND dname = '$dname' AND UROB_Dcomment.user_id = UROB_Customer.user_id;";
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
              		<h4 style='color: red'>Rate: " . $row['dscore'] . "</h4>
              	</div>
              	<div>
              		<p>" . $row['dcomment'] . "</p>
              	</div>
        	</div>
        	</div><hr>");
		}
	}
    else {
      $viewContent = "<p><div class='alert alert-warning' role='alert'>Sorry. This dish has no reviews now</div></p>";
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
                <p class='col-lg-12'><input class='btn btn-primary' type='button' value='submit' onclick='uploadDishReview(" . $restaurantID . ", \"" . $username . "\", \"" . $dname ."\")'></p>
              </form>
            </div>";
	// echo $viewContent;
	echo json_encode(array("content"=>$viewContent));
}
?>