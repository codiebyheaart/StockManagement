<?php
ob_flush();
require_once "config.php";
session_start();
$finpicname = "";
if (isset($_POST)) {
	$submit_button = $_POST['submit_button'];
	if (isset($submit_button)) {
		$vendor_email = $_SESSION['email'];
		$product_name = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['product_name']));
		$product_code = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['product_code']));
		$small_details = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['short_details']));
		$product_price = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['product_price']));
		$stock = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['stock']));
		$product_gst = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['product_gst']));
		$min_quantity = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['min_quantity']));
		$units_per_box = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['units_per_box']));
		$option1_name = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['option1_name']));
		$option1_value = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['option1_value']));
		$option1_price = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['option1_price']));
		$option1_mrp = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['option1_mrp']));
		$option2_name = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['option2_name']));
		$special_product = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['special_product']));
		
		$first_category = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['first_category']));
		$secound_category = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['secound_category']));
		$product_category = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['product_category']));
		
		if(empty($product_category)){
			$product_category = $secound_category;
		}
		
		if(empty($product_category) && empty($secound_category)){
			$product_category = $first_category;
		}
		
		$allowed_img = array('jpg', 'png', 'jpeg', 'gif', 'JPG', 'JPEG', 'PNG', 'GIF');
		if ($_FILES["product_image"]["error"] > 0) {
			$finpicname = "0";
		} else {
			$name = $_FILES["product_image"]["name"];
			$ext = pathinfo($name, PATHINFO_EXTENSION);
			if (!in_array($ext, $allowed_img)) {
				$finpicname = "-1";
			} else {
				$temp_file_name = $_FILES['product_image']['tmp_name'];
				$kaboom = explode(".", $name);
				$fileExt = end($kaboom);
				$time = time();
				$picnameold = (rand(10, 1000000));
				$picname = $picnameold . $time;
				$movepic = move_uploaded_file($temp_file_name, "../../img/$picname.$fileExt");
				$finpicname = "$picname.$fileExt";
			}
		}
		
		//adding second image below
		
		if ($_FILES["product_image2"]["error"] > 0) {
		
		} else {
			$name = $_FILES["product_image2"]["name"];
			$ext = pathinfo($name, PATHINFO_EXTENSION);
			if (!in_array($ext, $allowed_img)) {
				$photo2 = "-1";
			} else {
				$temp_file_name = $_FILES['product_image2']['tmp_name'];
				$kaboom = explode(".", $name);
				$fileExt = end($kaboom);
				$time = time();
				$picnameold = (rand(10, 1000000));
				$picname = $picnameold . $time;
				$movepic = move_uploaded_file($temp_file_name, "../../img/$picname.$fileExt");
				$photo2 = "$picname.$fileExt";
			}
		}
		
		//adding 3rd image below
		
		if ($_FILES["product_image3"]["error"] > 0) {
		
		} else {
			$name = $_FILES["product_image3"]["name"];
			$ext = pathinfo($name, PATHINFO_EXTENSION);
			if (!in_array($ext, $allowed_img)) {
				$photo3 = "-1";
			} else {
				$temp_file_name = $_FILES['product_image3']['tmp_name'];
				$kaboom = explode(".", $name);
				$fileExt = end($kaboom);
				$time = time();
				$picnameold = (rand(10, 1000000));
				$picname = $picnameold . $time;
				$movepic = move_uploaded_file($temp_file_name, "../../img/$picname.$fileExt");
				$photo3 = "$picname.$fileExt";
			}
		}
		
		//adding 4th image below
		
		if ($_FILES["product_image4"]["error"] > 0) {
		
		} else {
			$name = $_FILES["product_image4"]["name"];
			$ext = pathinfo($name, PATHINFO_EXTENSION);
			if (!in_array($ext, $allowed_img)) {
				$photo4 = "-1";
			} else {
				$temp_file_name = $_FILES['product_image4']['tmp_name'];
				$kaboom = explode(".", $name);
				$fileExt = end($kaboom);
				$time = time();
				$picnameold = (rand(10, 1000000));
				$picname = $picnameold . $time;
				$movepic = move_uploaded_file($temp_file_name, "../../img/$picname.$fileExt");
				$photo4 = "$picname.$fileExt";
			}
		}
		
		// if ($finpicname == "-1" || $photo2 == "-1" || $photo3 == "-1" || $photo4 == "-1") {
		if ($finpicname == "-1") {
			$_SESSION['error_msg'] = "<div class='alert alert-danger'>";
			$_SESSION['error_msg'] .= "<a href='#' class='close' data-dismiss='alert'>&times;</a>";
			$_SESSION['error_msg'] .= "Sorry, file extension not allowed you can only upload (.png, .jpg, .jpeg) images.</div>";
			header("Location: ../add-product.php");
		} else {

//			$sql = "INSERT INTO products (product_code, category_code, name, price,
//				small_details, gst, min_quantity, units_per_box, photo_link, photo2,
//				 photo3, photo4, option1_name, option1_value, option1_price, option1_mrp,
//				  option2_name, option2_value, option2_price, option2_mrp, special_product,
//				   vendor_email) VALUES('$product_code','$product_category','$product_name', '$product_price',
//				   '$small_details','$product_gst','$min_quantity','$units_per_box','$finpicname','$photo2',
//				   '$photo3','$photo4','$option1_name','$option1_value','$option1_price','$option1_mrp',
//				   '$option2_name','$option2_value','$option2_price','$option2_mrp','0','$vendor_email')";
			
			$sql = "INSERT INTO products (product_code, category_code, name, stock, price, small_details, gst, image, image2,
				 image3, image4, special_product) VALUES
				  ('$product_code','$product_category','$product_name', '$stock', '$product_price',
				   '$small_details','$product_gst','$finpicname','$photo2',
				   '$photo3','$photo4','$special_product')";
				   
				   
			$result = $connection->query($sql);
			
			if ($result == true) {
				$_SESSION['success_msg'] = "<div class='alert alert-success'>";
				$_SESSION['success_msg'] .= "<a href='#' class='close' data-dismiss='alert'>&times;</a>";
				$_SESSION['success_msg'] .= "New Product has been added successfully.</div>";
				header("Location: ../add-product.php");
			} else {
				$_SESSION['error_msg'] = "<div class='alert alert-danger'>";
				$_SESSION['error_msg'] .= "<a href='#' class='close' data-dismiss='alert'>&times;</a>";
				$_SESSION['error_msg'] .= "Sorry, there is an error while processing your request.</div>";
				header("Location: ../add-product.php");
			}
		}
	}
}