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
    <style type="text/css">
      #searchForm {
        position:absolute;
        top:45%;
      }
    </style>
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
                <li><a href="../index.html">Home <span class="sr-only">(current)</span></a></li>
                <li id="history_order" class="active"><a href="./historyOrder.php">My Order</a></li>
                <li id="logout"><a>Log Out</a></li>
              </ul>
              <p class="navbar-text navbar-right" id="name_logo">Welcome <?php echo $_COOKIE['username']; ?></p>
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>

    </div> <!-- end of container -->
    <div class="container">
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
        $userID = $_COOKIE['user_id'];
        $rid = $_POST['restaurant_id'];
        $oid = $_POST['order_id'];
        
        $sql = "SELECT UROB_Dish.dname, quantity, dprice FROM UROB_Orderdishes, UROB_Dish WHERE UROB_Orderdishes.order_id = $oid AND UROB_Orderdishes.restaurant_id = $rid AND UROB_Dish.dname = UROB_Orderdishes.dname;";
        $result = $conn->query($sql);
        ?>
        <?php
        // the query result is not empty
        $sum = 0;
        if($result->num_rows > 0) {
          
        ?>
        <h1 align="center">This is the Dishes you orderded in Order #<?php echo $oid; ?></h1>
        <div class="col-sm-12 row top-buffer div-bg-gray">
          <table class="table" style="color: black">
            <thead class="thead-inverse">
              <tr style="color: black">
                <th>#</th>
                <th>Dish Name</th>
                <th>Quantity</th>
                <th>Price</th>
              </tr>
            </thead>
            <tbody>
        <?php
        $count = 0;
        while ($row = $result->fetch_assoc()) {
        ?>
        <tr>
          <th><?php echo $count; ?></th>
          <th><?php echo $row['dname']; ?></th>
          <th><?php echo $row['quantity']; ?></th>
          <th>$<?php echo " " . $row['dprice']; ?></th>
        </tr>
        <?php
        $sum += $row['quantity']*$row['dprice'];
        $count ++;
        }// end of while
        ?>
        </tbody>
        </table>
        <?php
        }// end of if
        else {
          echo "<p><div class='alert alert-warning'>This order is empty</div></p>";
        }
        ?>
        <p><h3 align="right" style="color: black">Total: $<?php echo " " . $sum;?></h3></p>
      </div>
        
        
        </div><!-- end of table container -->

    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages    load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../js/orderDetail.js"></script>
  </body>
</html>
