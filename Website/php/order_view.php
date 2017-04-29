<?php
// Start the session
session_start();
?>
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
                    <?php
                        if(!isset($_SESSION["owner_id"])){
                            echo '<li id="owner_join"><a href="../owner_join.html">Owner Join</a></li>
                                  <li id="owner_login"><a href="../owner_login.html">Owner Login</a></li>';
                        }
                    ?>
                  </ul>
                  
                  <?php
                      if(isset($_SESSION["owner_username"])){
                        $owner_username = $_SESSION["owner_username"];
                        echo '<ul class="nav navbar-nav navbar-right">
                                  <li class="navbar-text">Welcom, '.$owner_username.  '</li>
                                  <li><a href="./logout.php">Logout</a></li>

                              </ul>';
                        
                      }else{
                        echo '<p class="navbar-text navbar-right" id="name_logo">Welcome</p>';
                      }
                   ?>
                    <ul class="nav navbar-nav navbar-right">
                    <li id="shop_cart"></li>
                  </ul>
                </div><!-- /.navbar-collapse -->
              </div><!-- /.container-fluid -->
            </nav> 

           
        </div>
        <div class="container">
          <?php
              if(!isset($_SESSION["owner_id"])){
                echo "<h2>You need login first</h2>";
                exit();
              }
           ?>
          <div class="row div-bg-white text-left top-buffer">
              <?php
                  require("db_setup.php");
                  if ($conn->connect_error) {
                  die("<h1>Connection failed: " . $conn->connect_error . "</h1>");
                  }
                  $owner_id = $_SESSION["owner_id"];
                  $sql = "SELECT restaurant_id FROM UROB_Owner where user_ID = '$owner_id'";
                  // echo $sql;
                  $result = $conn->query($sql);
                  if (mysqli_num_rows($result) == 0) {
                      // log in successfully
                      echo "<h2>No restaurant found</h2>";
                      exit();
                  }

                  $row = $result->fetch_assoc();
                  $rid = $row["restaurant_id"];
                  $sql = "SELECT * FROM UROB_Restaurant where restaurant_id = '$rid'";
                  // echo $sql;
                  $result = $conn->query($sql);
                  $row = $result->fetch_assoc();
                  $rName = $row["rname"];
                  $rimg = $row["restaurant_img"];
                  $rAddress = $row["raddress"];
                  $rPhone = $row["rphone"];
              ?>
              <form class="form-inline" action="manageHandler.php" method="post" enctype="multipart/form-data">
                  <div class="col-sm-3">
                    <img src="<?php echo $rimg; ?>"  onerror="if (this.src != '../img/sample.jpg') this.src = '../img/sample.jpg';" class="img-thumbnail" width="300" height="150" alt="Responsive image">
                  </div>
                  <div class="col-sm-6 text-left font-black">
                    <p><label>Name:</label></p>
                    <p><input type="text" class="form-control" name="r_name" value="<?php echo $rName; ?>"/></p>
                    <p><label>Address:</label></p>
                    <p><input type="text" class="form-control" name="r_addr" value="<?php echo $rAddress; ?>"/></p>
                    <p><label>Phone:</label></p>
                    <p><input type="text" class="form-control" name="r_phone" value="<?php echo $rPhone; ?>"/></p>
                    <p><label>Cover:</label></p>
                    <p><input type="file" class="form-control" name="r_img" id="r_img" /></p>
                    <p><label>Open or Close:</label></p>
                    <p>
                      <select class="form-control" name="isopen">
                        <option value="1">open</option>
                        <option value="0">closed</option>
                      </select>
                    </p>
                    <input type="hidden" name="type" value="1">
                    <input type="hidden" name="r_id" value="<?php echo $rid;?>">
                    <p><input type="submit" class="btn btn-primary" value="Save"></p>
                  </div>
              </form>
          </div>

        <!-- Title -->
        <div class="row div-bg-white text-left top-buffer font-black">
            <div class="col-lg-12">
                  <ul class="nav nav-tabs">
                    <li role="presentation"><a href="manage.html" style="color:black">Menu</a></li>
                    <li role="presentation"><a href="add_dish.php" style="color:black">Add Dish</a></li>
                    <li role="presentation" class="active"><a href="order_view.php" style="color:black">View Order</a></li>
                  </ul>
            </div>
            <div class="col-lg-12">
                <table class="table table-hover">
                  <tr>
                    <td>#</td>
                    <td>User</td>
                    <td>Time</td>
                    <td>Content</td>
                    <td>Address</td>
                    <td>Phone</td>
                    <td>Note</td>
                    <td>Amount</td>
                    <td>Status</td>
                    <td></td>
                  </tr>
            <?php
                $sql = "SELECT * FROM UROB_Order,UROB_Customer where restaurant_id = '$rid' and UROB_Customer.user_id = UROB_Order.user_id";
                // echo $sql;
                $result = $conn->query($sql);
                if (mysqli_num_rows($result) > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo 
                        '<tr>
                            <td name="order_id">'.$row["order_id"].'</td>
                            <td name="name">'.$row["username"].'</td>
                            <td name="time">'.$row["time"].'</td>
                            <td name="content">';

                        // try to find the order detail
                        $orderID = $row["order_id"];
                        $sql = "SELECT * FROM UROB_Order,UROB_Orderdishes where UROB_Orderdishes.restaurant_id = '$rid' and UROB_Orderdishes.order_id = UROB_Order.order_id and UROB_Orderdishes.order_id = '$orderID'";
                        // echo $sql;
                        $subresult = $conn->query($sql);
                        while($subrow = $subresult->fetch_assoc()) {
                            echo '<p>'.$subrow["dname"].'</p>';
                        }
                        echo '</td>';
                        $status = "";
                        switch ($row["status"]) {
                            case 1:
                                $status = "Ordered";
                                break;
                            case 2:
                                $status = "Cooking";
                                break;
                            case 3:
                                $status = "In Delivery";
                                break;
                            case 4:
                                $status = "Delivered";
                                break;
                            default:
                                $status = "Ordered";
                        }

                        echo 
                            '<td name="addr">'.$row["delivery_address"].'</td>
                            <td name="phone">'.$row["phone"].'</td>
                            <td name="note">'.$row["requirement"].'</td>
                            <td name="amount">'.$row["total_price"].'</td>
                            <td>'.$status.'</td>
                            <td>
                                <form class="form-inline" action="./manageHandler.php" method="post">
                                    <select name="status">
                                        <option value="1">Ordered</option>
                                        <option value="2">Cooking</option>
                                        <option value="3">In Delivery</option>
                                        <option value="4">Delivered</option>
                                    </select>
                                    <input type="hidden" name="type" value="3">
                                    <input type="hidden" name="r_id" value="'.$rid.'">
                                    <input type="hidden" name="order_id" value="'.$orderID.'">
                                    <input type="submit" class="btn btn-primary" value="Update">
                                </form>
                            </td>
                            
                        </tr>';

                    }
                }
                $conn->close();
            ?>

            

        </div>
        <!-- /.row -->

       

      </div>

    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages    load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
  </body>
</html>
