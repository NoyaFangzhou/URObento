<!DOCTYPE html>
<?php session_start() ?>
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
                    <li><a id="shop_cart">My Cart(<?php echo count($_SESSION['dishes']) ?>)</a></li>
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
        echo "the restaurant id is: $rid";
        $rsql = "SELECT * FROM UROB_Restaurant WHERE restaurant_id = '$rid';";
        $dsql = "SELECT * FROM UROB_Dish WHERE restaurant_id = '$rid';";
        $scoresql = "SELECT ROUND((SELECT AVG(rscore) FROM UROB_Rcomment WHERE restaurant_id = '$rid'), 1) AS rrate;";
        // $rcommsql = "SELECT * FROM UROB_Rcomment WHERE restaurant_id = '$_POST['restaurant_id']';";
        $result = $conn->query($rsql);
        $rate = $conn->query($scoresql);

        if ($result->num_rows > 0) {
          $row = $result->fetch_assoc();
          if ($rate->num_rows > 0) {
            $score = $rate->fetch_assoc();
            if(!empty($score['rrate'])) {
              $output = $score['rrate'] . "/5.0";
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
              <img src=<?php echo $row['restaurant_img']; ?> class="img-thumbnail" width="300" height="150" alt="Responsive image">
            </div>
            <div class="col-sm-8 text-left font-black">
              <h1><?php echo $row['rname']; ?></h1>
              <p><label>Average Costs:</label><?php echo $row['average_cost']; ?></p>
              <p><label>Rate:</label><?php echo $output ?></p>
              <p><label>Address:</label></p>
              <p><?php echo $row['raddress']; ?></p>
              <p><label>Phone:</label></p>
              <p><?php echo $row['rphone']; ?></p>
            </div>
        </div>
        <?php
        } // end of if
        else {
          echo "<div class='alert alert-warning' role='alert'>ERROR 404: Restaurant Not Found</div>";
        }
        ?>

        <!-- Title -->
        <div class="row div-bg-white text-left top-buffer font-black">
            <div class="col-lg-12">
                  <ul class="nav nav-tabs">
                    <li role="presentation" class="active" id="menuTag"><a style="color:black" onclick="loadMenu(<?php echo $rid ?>)">Menu</a></li>
                    <li role="presentation" id="reviewTag"><a style="color:black" onclick="loadReview(<?php echo $rid ?>)">Reviews</a></li>
                    <li role="presentation" id="writeReviewTag"><a style="color:black" onclick="writeReview(<?php echo $rid ?>)">Write Review</a></li>
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
            <div class='col-lg-12'>
                <hr class='margin-=bot'>
                <div class='thumbnail col-lg-2'>
                    <img src=<?php echo $row['dish_img']; ?> alt='' width='100%' height='100'>
                </div>
                <div class='col-lg-5'>
                    <h3><label>Name: </label><?php echo $row['dname']; ?></h3>
                    <p><label>Price: </label>$ <?php echo $row['dprice']; ?></p>
                </div>
                <div class='col-lg-2 top-buffer'>
                  <p>
                    <button class="btn btn-primary" onclick="addToChart(<?php echo "'" . $row['dname'] . "'"; ?>, <?php echo $row['restaurant_id']; ?>)">Add</button>
                  </p>
                  <p>
                    <button class="btn btn-primary" onclick="loadDishReviews(<?php echo "'" . $row['dname'] . "'"; ?>, <?php echo $row['restaurant_id']; ?>)">Reviews</button>
                  </p>
                </div>
            </div>
            <?php
            } // end of while
            }// end of if
            else {
              echo "<p><div class='alert alert-warning' role='alert'>Sorry. This restaurant has now dishes available now</div></p>";
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
    <script type="text/javascript" src="../js/restaurantDetail.js"></script>
  </body>
</html>
