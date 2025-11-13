<?php
ob_flush();
require_once "config.php";
session_start();
error_reporting(0);

if (isset($_POST)) {
	$sql = "";
	$submit_button = $_POST['submit_button'];
	if (isset($submit_button)) {
		
		$allowed_img = array('jpg', 'png', 'jpeg', 'gif', 'JPEG', 'JPG', 'PNG', 'GIF');
		
		$category_name = htmlspecialchars($connection->real_escape_string($_POST['category_name']));
		$category_id = htmlspecialchars($connection->real_escape_string($_POST['category_id']));
		$homepage = htmlspecialchars($connection->real_escape_string($_POST['homepage']));
		
		$fetchId = $connection->query("SELECT * FROM categories WHERE id = '$category_id'")->fetch_assoc();
		$old_image = $fetchId['photo_link'];
		
		if ($_FILES["newcatImage"]["error"] > 0) {
			$finpicname = $old_image;
		} else {
			$name = $_FILES["newcatImage"]["name"];
			$ext = pathinfo($name, PATHINFO_EXTENSION);
			if (!in_array($ext, $allowed_img)) {
				$finpicname = $old_image;
			} else {
				unlink("../../img/$old_image");
				$temp_file_name = $_FILES['newcatImage']['tmp_name'];
				$kaboom = explode(".", $name);
				$fileExt = end($kaboom);
				$time = time();
				$picnameold = (rand(10, 1000000));
				$picname = $picnameold . $time;
				$movepic = move_uploaded_file($temp_file_name, "../../img/$picname.$fileExt");
				$finpicname = "$picname.$fileExt";
			}
		}
		
		$sql = "UPDATE categories SET name = '$category_name', title = '$category_name', photo_link = '$finpicname',
			show_on_home = '$homepage' WHERE id = '$category_id' AND parent_category_code = '0'
			AND category_level = '1';";
		
		$result = $connection->query($sql);
		if ($result == true) {
			$_SESSION['success_msg'] = '<div class="alert alert-success">';
			$_SESSION['success_msg'] .= '<a href="#" class="close" data-dismiss="alert">&times;</a>';
			$_SESSION['success_msg'] .= 'Categories has been updated successfuly.</div>';
			header("Location: ../all-categories.php");
		} else {
			$_SESSION['error_msg'] = '<div class="alert alert-danger">';
			$_SESSION['error_msg'] .= '<a href="#" class="close" data-dismiss="alert">&times;</a>';
			$_SESSION['error_msg'] .= 'Sorry There is an error while processing Your Request.</div>';
			header("Location: ../all-categories.php");
		}
	}
}