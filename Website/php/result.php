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
                    <li id="owner_join"><a href="../owner_join.html">Owner Join</a></li>
                    <li id="owner_signin"><a href="../owner_login.html">Owner Sign In</a></li>
                    <li id="logout"></li>
                  </ul>
                  <p class="navbar-text navbar-right" id="name_logo">Welcome</p>
                  <ul class="nav navbar-nav navbar-right">
                    <li id="shop_cart"></li>
                    <li id="log_in"><a data-toggle="modal" data-target="#login_panel">Customer Log In</a></li>
                    <li id="sign_up"><a data-toggle="modal" data-target="#signup_panel">Customer Sign Up</a></li>
                  </ul>
                </div><!-- /.navbar-collapse -->
              </div><!-- /.container-fluid -->
            </nav>

      </div> <!-- end of container -->

      <!-- Login Modal View -->
      <div class="modal fade" id="login_panel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <h4 class="modal-title" id="login_label" data-dismiss="modal">Login</h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" role="form">
                <div id="error_panel_signin" class="alert alert-danger" role="alert"></div>
                <div class="form-group">
                  <label for="input_usrname" class="col-lg-2 control-label">Username:</label>
                  <div class="col-lg-10">
                    <input type="text" class="form-control" id="username" name="username" placeholder="Please input your username">
                  </div>
                </div>
                <div class="form-group">
                  <label for="input_password" class="col-lg-2 control-label">Password:</label>
                  <div class="col-lg-10">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Please input your password">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-lg-offset-2 col-lg-10">
                    <label class="checkbox" for="remember_me">
                      <input type="checkbox" data-toggle="checkbox" value="" id="remember_me" required="" class="custom-checkbox"><span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span>
                                Remember me
                                <!-- <input type="checkbox" data-toggle="checkbox" value="" id="remember_me">Remember me -->
                            </label>
                  </div>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button class="btn btn-primary" id="login_btn">Sign In</button>
            </div>
          </div>
        </div>
      </div> <!-- end of the login panel -->


      <!-- Sign Up Modal View -->
      <div class="modal fade bd-examplemodal-lg" id="signup_panel">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <h4 class="modal-title" id="signup_label">Sign Up</h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" role="form">
                <div id="error_panel_signup" class="alert alert-danger" role="alert"></div>
                <div class="form-group">
                  <label for="signup_username" class="col-lg-2 control-label">Username:</label>
                  <div class="col-lg-10">
                    <input type="text" class="form-control" id="signup_username" name="username" placeholder="Please input your username">
                  </div>
                </div>
                <p id="error_panel"></p>
                <div class="form-group">
                  <label for="signup_password" class="col-lg-2 control-label">Password:</label>
                  <div class="col-lg-10">
                    <input type="password" class="form-control" id="signup_password" name="password" placeholder="Please input your password">
                  </div>
                </div>
                <div class="form-group">
                  <label for="re_password" class="col-lg-2 control-label"></label>
                  <div class="col-lg-10">
                    <input type="password" class="form-control" id="re_password" name="re_password" placeholder="Please input your password again">
                  </div>
                </div>
                <div class="form-group">
                  <label for="email" class="col-lg-2 control-label">Email:</label>
                  <div class="col-lg-10">
                    <input type="email" class="form-control" id="signup_email" name="email" placeholder="Please input your email address">
                  </div>
                </div>
                <div class="form-group">
                  <label for="email" class="col-lg-2 control-label">Phone:</label>
                  <div class="col-lg-10">
                    <input type="email" class="form-control" id="signup_phone" name="email" placeholder="Please input your phone number">
                  </div>
                </div>
                <div class="form-group">
                  <label for="email" class="col-lg-2 control-label">Address:</label>
                  <div class="col-lg-10">
                    <input type="email" class="form-control" id="signup_address" name="email" placeholder="Please input your address">
                  </div>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary" id="signup_btn">Sign Up</button>
            </div>
          </div>
        </div>
      </div><!--Sign Up Modal -->




      <!-- Restaurant List -->
      <div class="container">
            <div class="row top-buffer">
              <h1 class="col-sm-12 text-left" align="center">Show Restaurants:</h1>
            </div>
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
            if (!empty($_POST['restaurant_name'])) {
              $rname = $_POST['restaurant_name'];
              $rsql = "SELECT * FROM UROB_Restaurant WHERE rname = '$rname';";
            }
            else {
              $rsql = "SELECT * FROM UROB_Restaurant;";
            }
            $result = $conn->query($rsql);
            ?>
            <?php
            // the query result is not empty
            if ($result->num_rows > 0) {
            ?>
            <?php 
            while($row = $result->fetch_assoc()) {
              $rid = $row['restaurant_id'];
              $commsql = "SELECT rcomment FROM UROB_Rcomment WHERE restaurant_id = '$rid' LIMIT 1;";
              $commresult = $conn->query($commsql);
              $scoresql = "SELECT ROUND((SELECT AVG(rscore) FROM UROB_Rcomment WHERE restaurant_id = '$rid'), 1) AS rrate;";
              $rate = $conn->query($scoresql);
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
              <div class="col-sm-offset-1 col-sm-10 row top-buffer div-bg-gray">
                <div class="col-sm-3">
                  <a onclick="getRestaurantDetail(<?php echo $rid ?>)"><img src=<?php echo $row['restaurant_img']; ?> class="img-thumbnail" width="200" height="150" alt="Responsive image"></a>
                </div>
                <div class="col-sm-5 text-left font-black">
                  <a class="font-blue" onclick="getRestaurantDetail(<?php echo $rid ?>)"><p class="rest-name" id="restaurant_name"><?php echo $row['rname']; ?></p></a>
                  <p><label>Average Costs:</label>  <?php echo $row['average_cost']; ?></p>
                  <p><label>Rate:</label><?php echo $output ?></p>
                  <p><label>TOP Reviews:</label></p>
                  <?php
                  if ($commresult->num_rows > 0) {
                    $comm = $commresult->fetch_assoc();
                    echo "<p>" . $comm['rcomment'] ." </p>"; 
                  }  // end of if
                  else {
                    echo "<p>No Comments Now</p>";
                  }  // end of else
                  ?>
                </div>
                <div class="col-sm-3 font-black text-left">
                  <p><label></label></p>
                  <?php
                  if ($row['is_open']) {
                    echo("<p><span class='label label-success'>Open</span></p>");
                  }
                  else {
                    echo("<p><span class='label label-danger'>Closed</span></p>");
                  }
                  ?>
                  <p><label>Address:</label></p>
                  <p><?php echo $row['raddress']?></p>
                  <p><label>Phone:</label></p>
                  <p><?php echo $row['rphone']?></p>
                </div>
              </div>
            <?php
            } // end of while
          } // end of if
          else {
            echo "Item not found";
          }
          ?>
          <div class="mastfoot">
          </div>
      </div><!-- end of container -->

    </div><!-- end of site-wrapper-->
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages    load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../js/restaurantList.js"></script>
  </body>
</html>


