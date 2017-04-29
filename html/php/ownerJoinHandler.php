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
                    <li class="active" id="owner_join"><a href="../owner_join.html">Owner Join</a></li>
                    <li id="owner_login"><a href="../owner_login.html">Owner Login</a></li>
                  </ul>
                  <p class="navbar-text navbar-right" id="name_logo">Welcome</p>
                    <ul class="nav navbar-nav navbar-right">
                    <li id="shop_cart"></li>
                  </ul>
                </div><!-- /.navbar-collapse -->
              </div><!-- /.container-fluid -->
            </nav> 
        </div>

        
        <div class="container">
        <?php 
          	if(isset($_SESSION["owner_id"])){
          		echo "<h1> You already logged in, 3s later redirect</h1>";
              header( "refresh:2; url=manage.php");

          		exit();
          	}
          	$owner_name = $_POST["username"];
          	$owner_pwd = $_POST["password"];

          	require("db_setup.php");

          	if ($conn->connect_error) {
				    die("<h1>Connection failed: " . $conn->connect_error . "</h1>");
				    }

    				$sql = "SELECT user_id FROM UROB_Owner where username = '$owner_name'";
            // echo $sql;
            $result = $conn->query($sql);
            if (mysqli_num_rows($result) > 0) {
    				    // log in successfully
    				    echo "<h2>Username already exits, 2s later redirect</h2>";
    				    header( "refresh:2; url=owner_join.php");
    				} else {
                $sql = "INSERT INTO UROB_Restaurant(rname, raddress, rphone, is_open, restaurant_img) VALUES('NAME', 'ADDRESS','+10000000000', '0', 'http://nogu-svelo.ru/wp-content/uploads/Coming-Soon.gif');";
                $result = $conn->query($sql);
                // echo $sql;
      					if ($conn->query($sql) === TRUE) {
                  $last_id = $conn->insert_id;
                  $conn->commit();
                  //echo "New record created successfully. Last inserted ID is: " . $last_id;
                  $sql = "INSERT INTO UROB_Owner(username, password,salt, restaurant_id) VALUES('$owner_name', '$owner_pwd','123123', '$last_id');";
                  $result = $conn->query($sql);
                  // echo $sql;
                  if ($conn->query($sql) === TRUE) {
                      $last_id = $conn->insert_id;
                      $_SESSION["owner_id"] = $last_id;
                      $_SESSION["owner_username"] = $owner_name;
                  }else{
                      echo "<h1>Database Error, 2s later redirect</h1>";
                  }
                  $conn->commit();
                  echo "<h2>Register successfully, 2s later redirect</h2>";
      				    header( "refresh:2; url=manage.php");

      					}else{
                  echo "<h2>Database Insert Error</h2>";
                }
    				}
    				$conn->close();
    				exit();

        ?>

           
          <div class="mastfoot">
            
          </div>

        </div>

      </div>

    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages    load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../js/ownerSignUp.js"></script>
  </body>
</html>

<?php 
