<?php
require_once "config.php";

$sql = "";
$submit_button = $_POST['submit_button'];
if (isset($submit_button)) {
	$allowed_img = array('jpg', 'png', 'jpeg', 'gif', 'JPEG', 'JPG', 'PNG', 'GIF');
	
	$sub_category_name = htmlspecialchars($connection->real_escape_string($_POST['sub_category_name']));
	$sub_category_id = htmlspecialchars($connection->real_escape_string($_POST['sub_category_id']));
	$homepage = htmlspecialchars($connection->real_escape_string($_POST['homepage']));
	
	$fetchId = $connection->query("SELECT * FROM categories WHERE id = '$sub_category_id' AND category_level = '2'")
		->fetch_assoc();
	
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
	
	$sql = "UPDATE categories SET name = '$sub_category_name', show_on_home = '$homepage', photo_link = '$finpicname'
			WHERE id = '$sub_category_id' AND category_level = '2'";
	
	$query = $connection->query($sql);
	
	if ($query == true) {
		$_SESSION['success_msg'] = '<div class="alert alert-success">';
		$_SESSION['success_msg'] .= '<a href="#" class="close" data-dismiss="alert">&times;</a>';
		$_SESSION['success_msg'] .= 'Sub Categories has been updated successfully.</div>';
		header("Location: ../all-sub-categories.php");
	} else {
		$_SESSION['error_msg'] = '<div class="alert alert-danger">';
		$_SESSION['error_msg'] .= '<a href="#" class="close" data-dismiss="alert">&times;</a>';
		$_SESSION['error_msg'] .= 'Sorry There is an error while processing Your Request.</div>';
		header("Location: ../all-sub-categories.php");
	}
}
