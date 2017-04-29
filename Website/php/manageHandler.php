<?php
// Start the session
session_start();
?>

<?php 
	if(!isset($_SESSION["owner_id"])){
		echo "<h1> Not logged in</h1>";
        exit();
	}
	if(!isset($_POST["type"])){
		header( "refresh:0; url=manage.php");
	}
	require("db_setup.php");
	switch($_POST["type"]){
		case 1:// change restaurant information
			$r_name = $_POST["r_name"];
			$r_addr = $_POST["r_addr"];
			$r_phone = $_POST["r_phone"];
			$isopen = $_POST["isopen"];
			$r_id = $_POST["r_id"];
			// deal with the image 
			$target_dir = "../img/";
			$target_file = $target_dir .$r_id."_".basename($_FILES["r_img"]["name"]);
			$uploadOk = 1;
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			// Check if image file is a actual image or fake image
			if(isset($_POST["submit"])) {
			    $check = getimagesize($_FILES["r_img"]["tmp_name"]);
			    if($check !== false) {
			        $uploadOk = 1;
			    } else {
			        echo "File is not an image.";
			        $uploadOk = 0;
			    }
			}
			// Check if file already exists
			// if (file_exists($target_file)) {
			//     echo "file already exists.";
			//     $uploadOk = 0;
			// }
			// Check file size
			if ($_FILES["r_img"]["size"] > 1000000) {
			    echo "Sorry, your file is too large.";
			    $uploadOk = 0;
			}
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
			    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			    $uploadOk = 0;
			}
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
			    echo "Sorry, your file was not uploaded.";
			// if everything is ok, try to upload file
			} else {
			    if (move_uploaded_file($_FILES["r_img"]["tmp_name"], $target_file)) {
			        echo "The file ". basename( $_FILES["r_img"]["name"]). " has been uploaded.";
			    } else {
			        echo "Sorry, there was an error uploading your file.";
			    }
			}


			$sql = "UPDATE UROB_Restaurant SET rname='$r_name',raddress='$r_addr',rphone='$r_phone',is_open='$isopen',restaurant_img='$target_file' WHERE restaurant_id='$r_id'";

			if (!mysqli_query($conn, $sql)) {
			    echo "Error updating record: " . mysqli_error($conn);
			}else{
				// echo "1 success";
				header('Location: ' . $_SERVER['HTTP_REFERER']);
			}

			break;
		case 2: // change some dishes
			$dish_price = $_POST["dish_price"];
			$dname = $_POST["dname"];
			$r_id = $_POST["r_id"];
			$sql = "UPDATE UROB_Dish SET dprice='$dish_price' WHERE restaurant_id='$r_id' and dname = '$dname'";
			// echo $sql;
			if (!mysqli_query($conn, $sql)) {
			    echo "Error updating record: " . mysqli_error($conn);
			}else{
				// echo "2 success";
				header('Location: ' . $_SERVER['HTTP_REFERER']);
			}
			break;
		case 3: // change order status
			$r_id = $_POST["r_id"];
			$order_id = $_POST["order_id"];
			$status = $_POST["status"];

			$sql = "UPDATE UROB_Order SET status='$status' WHERE restaurant_id='$r_id' and order_id = '$order_id'";

			if (!mysqli_query($conn, $sql)) {
			    echo "Error updating record: " . mysqli_error($conn);
			}else{
				// echo "3 success";
				header('Location: ' . $_SERVER['HTTP_REFERER']);
			}
			break;
		case 4:
			$r_id = $_POST["r_id"];
			$d_name = $_POST["d_name"];
			$d_price = $_POST["d_price"];
			$owner_id = $_SESSION["owner_id"];
			$file = $_FILES["d_img"];
			// deal with the image 
			$target_dir = "../img/";
			$target_file = $target_dir .$r_id."_".$d_name."_".basename($file["name"]);
			$uploadOk = 1;
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			// Check if image file is a actual image or fake image
			if(isset($_POST["submit"])) {
			    $check = getimagesize($file["tmp_name"]);
			    if($check !== false) {
			        $uploadOk = 1;
			    } else {
			        echo "File is not an image.";
			        $uploadOk = 0;
			    }
			}
			// Check if file already exists
			// if (file_exists($target_file)) {
			//     echo "file already exists.";
			//     $uploadOk = 0;
			// }
			// Check file size
			if ($file["size"] > 1000000) {
			    echo "Sorry, your file is too large.";
			    $uploadOk = 0;
			}
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
			    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			    $uploadOk = 0;
			}
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
			    echo "Sorry, your file was not uploaded.";
			// if everything is ok, try to upload file
			} else {
			    if (move_uploaded_file($file["tmp_name"], $target_file)) {
			        echo "The file ". basename( $file["name"]). " has been uploaded.";
			    } else {
			        echo "Sorry, there was an err/or uploading your file.";
			    }
			}

			$sql = "SELECT * FROM UROB_Dish where restaurant_id = '$r_id' AND dname = '$d_name'";
			$result = $conn->query($sql);
            if (mysqli_num_rows($result) == 0) {// already have this dish do nothing

				$sql = "INSERT INTO UROB_Dish(restaurant_id, dname, dprice, dish_img) VALUES('$r_id', '$d_name', '$d_price', '$target_file') ";

				$result = $conn->query($sql);
	                // echo $sql;
	   //    		if ($conn->query($sql) === TRUE) {
	   //    			// echo "4 success";
				//     header('Location: ' . $_SERVER['HTTP_REFERER']);
				// }else{
				// 	echo "Error updating record: " . mysqli_error($conn);
				// }
			}
			header( "url=manage.php");
			break;
	}
	$conn->close();
	// header('Location: ' . $_SERVER['HTTP_REFERER']);
?>