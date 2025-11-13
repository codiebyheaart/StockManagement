<?php
ob_flush();
require_once "config.php";
session_start();

if (isset($_POST)) {
	$submit_button = $_POST['submit_button'];
	if (isset($submit_button)) {
		$product_id = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['product_id']));
		$product_name = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['product_name']));
		$product_code = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['product_code']));
		$small_details = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['short_details']));
		$product_price = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['product_price']));
		$stock = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['stock']));
		$product_gst = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['product_gst']));
		$min_quantity = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['min_quantity']));
		$units_per_box = htmlspecialchars(mysqli_real_escape_string($connection,$_POST['units_per_box']));
		$option1_name = htmlspecialchars(mysqli_real_escape_string($connection,$_POST['option1_name']));
		$option1_value = htmlspecialchars(mysqli_real_escape_string($connection,$_POST['option1_value']));
		$option1_price = htmlspecialchars(mysqli_real_escape_string($connection,$_POST['option1_price']));
		$option1_mrp = htmlspecialchars(mysqli_real_escape_string($connection,$_POST['option1_mrp']));
		$option2_name = htmlspecialchars(mysqli_real_escape_string($connection,$_POST['option2_name']));
		$option2_value = htmlspecialchars(mysqli_real_escape_string($connection,$_POST['option2_value']));
//		$option2_price = htmlspecialchars(mysqli_real_escape_string($connection,$_POST['option2_price']));
//		$option2_mrp = htmlspecialchars(mysqli_real_escape_string($connection,$_POST['option2_mrp']));
		$first_category = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['first_category']));
		$secound_category = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['secound_category']));
		$product_category = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['product_category']));
		
		if(empty($product_category)){
			$product_category = $secound_category;
		}
		
		if(empty($product_category) && empty($secound_category)){
			$product_category = $first_category;
		}
		
		$sql0 = $connection->query("SELECT * FROM products WHERE id = '$product_id'");
		$fetch = $sql0->fetch_assoc();
		$old_image = $fetch['photo_link'];
		$old_photo2 = $fetch['photo2'];
		$old_photo3 = $fetch['photo3'];
		$old_photo4 = $fetch['photo4'];
		
		$allowed_img = array('jpg', 'png', 'jpeg', 'gif', 'JPG', 'JPEG', 'PNG', 'GIF');
		if ($_FILES["product_image"]["error"] > 0) {
			$finpicname = $old_image;
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
				unlink("../../img/$old_image");
			}
		}
		
		
		//updating 2nd image
		
		if ($_FILES["product_image2"]["error"] > 0) {
			$photo2 = $old_photo2;
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
				unlink("../../img/$old_photo2");
			}
		}
		
		
		//updating 3rd image
		
		if ($_FILES["product_image3"]["error"] > 0) {
			$photo3 = $old_photo3;
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
				unlink("../../img/$old_photo3");
			}
		}
		
		
		//updating 4th image
		
		if ($_FILES["product_image4"]["error"] > 0) {
			$photo4 = $old_photo4;
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
				unlink("../../img/$old_photo4");
			}
		}
		
		
		if ($finpicname == "-1" || $photo2 == "-1" || $photo3 == "-1" || $photo4 == "-1") {
			$_SESSION['error_msg'] = "<div class='alert alert-danger'>";
			$_SESSION['error_msg'] .= "<a href='#' class='close' data-dismiss='alert'>&times;</a>";
			$_SESSION['error_msg'] .= "Sorry, file extension not allowed you can only upload (.png, .jpg, .jpeg) images.</div>";
			header("Location: ../items-edit.php?id=$product_id");
		} else {
			$sql = "UPDATE products SET product_code = '$product_code', name = '$product_name', stock='$stock', price = '$product_price',
				image = '$finpicname', image2 = '$photo2', image3 = '$photo3', image4 = '$photo4',
				small_details = '$small_details', category_code = '$product_category', gst = '$product_gst'	WHERE id = '$product_id'";
			$result = $connection->query($sql);
			
			if ($result == true) {
				$_SESSION['success_msg'] = "<div class='alert alert-success'>";
				$_SESSION['success_msg'] .= "<a href='#' class='close' data-dismiss='alert'>&times;</a>";
				$_SESSION['success_msg'] .= "Your product details has been updated successfully.</div>";
				header("Location: ../items-edit.php?id=$product_id");
			} else {
				$_SESSION['error_msg'] = "<div class='alert alert-danger'>";
				$_SESSION['error_msg'] .= "<a href='#' class='close' data-dismiss='alert'>&times;</a>";
				$_SESSION['error_msg'] .= "Sorry, there is an error while processing your request.</div>";
				header("Location: ../items-edit.php?id=$product_id");
			}
		}
	}
}