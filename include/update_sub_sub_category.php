<?php
require_once "config.php";

$sql = "";
$submit_button = $_POST['submit_button'];
if (isset($submit_button)) {
	$allowed_img = array('jpg', 'png', 'jpeg', 'gif', 'JPEG', 'JPG', 'PNG', 'GIF');
	
	$sub_sub_category_name = htmlspecialchars($connection->real_escape_string($_POST['sub_sub_category_name']));
	$sub_sub_category_id = htmlspecialchars($connection->real_escape_string($_POST['sub_sub_category_id']));
	$gst = htmlspecialchars($connection->real_escape_string($_POST['gst']));
	$homepage = htmlspecialchars($connection->real_escape_string($_POST['homepage']));
	
	$fetchId = $connection->query("SELECT * FROM categories WHERE id = '$sub_sub_category_id' AND
		category_level = '3'")->fetch_assoc();
	
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
	
	$sql = "UPDATE categories SET name = '$sub_sub_category_name', title = '$sub_sub_category_name',
		photo_link = '$finpicname', show_on_home = '$homepage' WHERE id = '$sub_sub_category_id' AND
		category_level = '3'";
	/*
	for ($i = 0; $i < count($_POST['sub_sub_category_name']); $i++) {
		$sub_sub_category_name = $_POST['sub_sub_category_name'][$i];
		$sub_sub_category_id = $_POST['sub_sub_category_id'][$i];
		$gst = $_POST['gst'][$i];
		$sql .= "UPDATE categories SET name = '$sub_sub_category_name', title = '$sub_sub_category_name', gst = '$gst'
				WHERE id = '$sub_sub_category_id' AND category_level = '3';";
	}*/
	
	$query = $connection->query($sql);
	
	if ($query == true) {
		$_SESSION['success_msg'] = '<div class="alert alert-success">';
		$_SESSION['success_msg'] .= '<a href="#" class="close" data-dismiss="alert">&times;</a>';
		$_SESSION['success_msg'] .= 'Sub Sub Categories has been updated successfully.</div>';
		header("Location: ../all-sub-sub-categories.php");
	} else {
		$_SESSION['error_msg'] = '<div class="alert alert-danger">';
		$_SESSION['error_msg'] .= '<a href="#" class="close" data-dismiss="alert">&times;</a>';
		$_SESSION['error_msg'] .= 'Sorry There is an error while processing Your Request.</div>';
		header("Location: ../all-sub-sub-categories.php");
	}
}