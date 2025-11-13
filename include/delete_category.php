<?php
require_once "config.php";

if(isset($_GET['id'])) {
	$id = $_GET['id'];
	
	$query = $connection->query("SELECT * FROM categories WHERE id = '$id'");
	$fetch = $query->fetch_assoc();
	$image = $fetch['photo_link'];
	$file_delete = "../../img/$image";
	unlink($file_delete);
	
	$delete = $connection->query("DELETE FROM categories where id = '$id' AND category_level = '1'");
	if($delete == true) {
		$_SESSION['success_msg'] = "<div class='alert alert-success'>";
		$_SESSION['success_msg'] .= "<a href='#' class='close' data-dismiss='alert'>&times;</a>";
		$_SESSION['success_msg'] .= "Selected Category has been deleted successfully.</div>";
		header("Location: ../all-categories.php");
	} else {
		$_SESSION['error_msg'] = "<div class='alert alert-danger'>";
		$_SESSION['error_msg'] .= "<a href='#' class='close' data-dismiss='alert'>&times;</a>";
		$_SESSION['error_msg'] .= "Sorry, there is an error occured while processing your request.</div>";
		header("Location: ../all-categories.php");
	}
}
