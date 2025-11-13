<?php
require_once "config.php";
$code = $connection->query("SELECT max(id) FROM categories")->fetch_array();
$newCode = $code[0] + 1;

$submit_button = $_POST['submit_button'];
$sub_category_code = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['sub_category_code']));
$sub_sub_category_name = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['sub_sub_category_name']));
$homepage = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['homepage']));
$gst = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['gst']));
$allowed_img = array('jpg', 'png', 'jpeg', 'JPG', 'JPEG', 'PNG');
$tid = $newCode*10;
if (isset($submit_button) && !empty($sub_sub_category_name) && !empty($homepage)) {
	
	
	if ($_FILES["category_image"]["error"] > 0) {
	
	} else {
		$name = $_FILES["category_image"]["name"];
		$ext = pathinfo($name, PATHINFO_EXTENSION);
		if (!in_array($ext, $allowed_img)) {
			$finpicname = "-1";
		} else {
			$temp_file_name = $_FILES['category_image']['tmp_name'];
			$kaboom = explode(".", $name);
			$fileExt = end($kaboom);
			$time = time();
			$picnameold = (rand(10, 1000000));
			$picname = $picnameold . $time;
			$movepic = move_uploaded_file($temp_file_name, "../../img/$picname.$fileExt");
			$finpicname = "$picname.$fileExt";
		}
	}
	
	$sql = "INSERT INTO categories (name, photo_link, title, category_code, parent_category_code, category_level,
 			show_on_home, status,order_id) VALUES ('$sub_sub_category_name','$finpicname','$sub_sub_category_name',
 			'$newCode','$sub_category_code','3','$homepage','A','$tid')";
	
	$result = $connection->query($sql);
	
	if ($result == true) {
		$_SESSION['success_msg'] = "<div class='alert alert-success'>";
		$_SESSION['success_msg'] .= "<a href='#' class='close' data-dismiss='alert'>&times;</a>";
		$_SESSION['success_msg'] .= "New Sub Category has been added successfully.</div>";
		header("Location: ../add-sub-sub-category.php");
	} else {
		$_SESSION['error_msg'] = "<div class='alert alert-danger'>";
		$_SESSION['error_msg'] .= "<a href='#' class='close' data-dismiss='alert'>&times;</a>";
		$_SESSION['error_msg'] .= "Sorry, there is an error while processing your request.</div>";
		header("Location: ../add-sub-sub-category.php");
	}
}