<?php session_start(); // Using the session to store the cart ?>
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
                <li id="shop_cart" class="active"><a>My Cart(<?php echo count($_SESSION['dishes']) ?>)</a></li>
              </ul>
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>
      </div><!-- end of nagivation bar -->
      <?php
        foreach ($_SESSION['dishes'] as $key => $value) {
          echo $key . " => " . $value . "\n"; 
        }
      ?>
      <?php 
        $userID = $_SESSION['user_id'];
        $restaurantID = $_SESSION['restaurant_id'];
        require_once('db_setup.php');
        $sql = 'USE ngu3;';
        if ($conn->query($sql) == TRUE) {
          // connect sucessfully
        }
        else {
          echo "Error using database: " . $conn->error;
        }
      ?>


      <div class="container font-black text-left">
        <div class="row">
          <div class="col-xs-12">
            <div class="panel panel-info">
              <div class="panel-heading">
                <div class="panel-title">
                  <div class="row">
                    <div class="col-xs-6">
                      <h5><span class="glyphicon glyphicon-shopping-cart"></span> Shopping Cart</h5>
                    </div>
                    <div class="col-xs-6">
                    </div>
                  </div>
                </div>
              </div>
              <div class="panel-body">
                <form action="#" method="post">
                <?php
                $sum = 0.00;
                foreach ($_SESSION['dishes'] as $dname => $num) {
                  $sql = "SELECT dprice, dish_img FROM UROB_Dish WHERE dname = '$dname' AND restaurant_id = '$restaurantID';";
                  $result = $conn->query($sql);
                  if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $price = $row['dprice'];
                ?>
                <div class="row" id=<?php echo "'dish_" . $dname . "'" ?>>
                  <div class="col-xs-2"><img class="img-responsive" width="150" src=<?php echo $row['dish_img']?>>
                  </div>
                  <div class="col-xs-4">
                    <h4 class="product-name"><strong><?php echo $dname; ?></strong></h4>
                  </div>
                  <div class="col-xs-6">
                    <div class="col-xs-6 text-right">
                      <h6><strong>$ <?php echo $price ?><span class="text-muted">x</span></strong></h6>
                    </div>
                    <div class="col-xs-4">
                      <input type="text" class="form-control input-sm" value=<?php echo $num; ?> readonly="readonly">
                    </div>
                    <div class="col-xs-2">
                      <button type="button" class="btn btn-link btn-xs" onclick="deleteFromCart(<?php echo "'" . $dname . "'" ?>)">
                        <span class="glyphicon glyphicon-trash"> </span>
                      </button>
                    </div>
                  </div>
                </div>
                <hr>

                <?php
                $sum += $num * $price;
                } // end of if in foreach
                } // end of foreach
                ?>
                <!-- <div class="row">
                  <div class="text-center">
                    <div class="col-xs-9">
                      <h6 class="text-right">Added items?</h6>
                    </div>
                    <div class="col-xs-3">
                      <button type="button" class="btn btn-danger btn-sm btn-block">
                        Update cart
                      </button>
                    </div>
                  </div> -->
                </div>
                <hr>
                <div class="row">
                  <div class="col-xs-offset-1 col-xs-6 text-left">
                    <p><label>Address:</label><input class="form-control" type="text" id="deliver_address" placeholder="Where to delivery"></p>
                    <p><label>Paying Method:</label>
                    <select class="form-control" id="pay_method">
                      <option value="0">Credit Card</option>
                      <option value="1">Check</option>
                      <option value="2">Cash</option>
                    </select>
                    </p>
                    <p><label>Note:</label><input class="form-control" type="text" placeholder="What you want the seller to know" id="note"></p>
                  </div>
                </div>
                </form>
              </div>
              <div class="panel-footer">
                <div class="row text-center">
                  <div class="col-xs-9">
                    <h4 class="text-right">Total <strong>$ <?php echo $sum ?></strong></h4>
                  </div>
                  <div class="col-xs-3">
                    <button type="button" class="btn btn-success btn-block" onclick="checkOut(<?php echo $sum . ", " . $restaurantID . ", " . $userID . ", " . count($_SESSION['dishes']) ?>)">
                      Checkout
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>       

    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages    load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../js/shopCart.js"></script>
  </body>
</html>
