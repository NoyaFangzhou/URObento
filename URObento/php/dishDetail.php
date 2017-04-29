<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Obento Food you like</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="../css/cover.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="site-wrapper">

      <div class="container">
            <!-- navigation bar -->
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
                  <a class="navbar-brand" href="../index.html">Obento</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                  <ul class="nav navbar-nav">
                    <li><a href="../index.html">Home</a></li>
                    <li id="logout"></li>
                  </ul>
                  <p class="navbar-text navbar-right" id="name_logo">Welcome <?php echo $_COOKIE['username']?></p>
                  <ul class="nav navbar-nav navbar-right">
                  </ul>
                </div><!-- /.navbar-collapse -->
              </div><!-- /.container-fluid -->
            </nav>
        </div><!-- end of nagivation bar -->

        <!-- restaurant list   -->
        <div class="container">
        <!-- PHP Script -->
        <?php
        // DB setup
        require_once('db_setup.php');
        $sql = 'USE ngu3;';
        if ($conn->query($sql) == TRUE) {
          // connect sucessfully
        }
        else {
          echo "Error using database: " . $conn->error;
        }

        // Query
        $rid = $_POST['restaurant_id'];
        $dname = $_POST['dish_name'];
        echo "the restaurant id is: $rid, the dish name is: $dname";
        $rsql = "SELECT * FROM UROB_Dish WHERE restaurant_id = '$rid' AND dname = '$dname';";
        // $dsql = "SELECT * FROM UROB_Dcomment WHERE restaurant_id = '$rid' AND dname = '$dname';";
        $dsql = "SELECT username, dscore, time, dcomment FROM UROB_Dcomment, UROB_Customer WHERE restaurant_id = '$rid' AND dname = '$dname' AND UROB_Dcomment.user_id = UROB_Customer.user_id;";
        $scoresql = "SELECT ROUND((SELECT AVG(dscore) FROM UROB_Dcomment WHERE restaurant_id = '$rid' AND dname = '$dname'), 1) AS drate;";
        // $rcommsql = "SELECT * FROM UROB_Rcomment WHERE restaurant_id = '$_POST['restaurant_id']';";
        $result = $conn->query($rsql);
        $rate = $conn->query($scoresql);
        if ($result->num_rows > 0) {
          $row = $result->fetch_assoc();
          if ($rate->num_rows > 0) {
            $score = $rate->fetch_assoc();
            if(!empty($score['drate'])) {
              $output = $score['drate'] . "/5.0";
            }
            else {
              $output = "N/A";
            }
          }
          else {
            $output = "N/A";
          }
        ?>
        <div class="row div-bg-white text-left top-buffer">
            <div class="col-sm-3">
              <img src=<?php echo $row['dish_img']; ?> class="img-thumbnail" width="300" height="150" alt="Responsive image">
            </div>
            <div class="col-sm-8 text-left font-black">
              <h1><?php echo $row['dname']; ?></h1>
              <p><label>Rate:</label><?php echo $output ?></p>
              <p><label>Price:</label></p>
              <p>$ <?php echo $row['dprice']; ?></p>
            </div>
        </div>
        <?php
        } // end of if
        else {
          echo "<div class='alert alert-warning' role='alert'>ERROR 404: Dish Not Found</div>";
        }
        ?>

        <!-- Title -->
        <div class="row div-bg-white text-left top-buffer font-black">
            <div class="col-lg-12">
                  <ul class="nav nav-tabs">
                    <li role="presentation" id="dishReviewTag" class="active"><a style="color:black" onclick="loadDishReview(<?php echo $rid ?>, <?php echo "'" . $dname . "'" ?>)">Dish Reviews</a></li>
                    <li role="presentation" id="writeDishReviewTag"><a style="color:black" onclick="writeDishReview(<?php echo $rid ?>, <?php echo "'" . $dname . "'" ?>)">Write Review</a></li>
                  </ul>
            </div>
            <div class="col-lg-12" id="tag_content">
            <?php
            // query all dishes for the current restaurant
            $result = $conn->query($dsql);
            if ($result->num_rows > 0) {
            ?>
            <?php
            while ($row = $result->fetch_assoc()) {
            ?>
            <div class=' col-lg-12 text-left top-buffer'>
              <div class='media'>
                <div class='media-left'>
                  <img src='../img/default_user_icon.jpg' class='media-object' style='width:64px'>
                </div>
                <div class='media-body'>
                  <h4 class='media-heading'><?php echo $row['username']; ?></h4>
                  <p><small><i><?php echo $row['time']; ?></i></small></p>
                </div>
                <div class='media-right'>
                  <h4 style='color: red'><?php echo $row['dscore']; ?></h4>
                </div>
                <div>
                  <p><?php echo $row['dcomment']; ?></p>
                </div>
              </div>
            </div>
            <hr>
            <?php
            } // end of while
            }// end of if
            else {
              echo "<p><div class='alert alert-warning' role='alert'>Sorry. This dish has now dishes available now</div></p>";
            }
            ?>
            </div>
        </div>
        <!-- /.row -->
      </div> <!-- end of container -->

    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages    load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../js/dishDetail.js"></script>
  </body>
</html>
