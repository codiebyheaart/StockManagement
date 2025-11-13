<?php
ob_flush();
require_once "config.php";
session_start();
if(isset($_GET['id'])) {
	$id = $_GET['id'];
	$fetchId = $connection->query("SELECT * FROM categories WHERE id = '$id' AND category_level = '3'")->fetch_assoc();
	$photo = $fetchId['photo_link'];
	unlink("../../img/$photo");
	
	$delete = $connection->query("DELETE FROM categories where id = '$id' AND category_level = '3'");
	if($delete == true) {
		$_SESSION['success_msg'] = "<div class='alert alert-success'>";
		$_SESSION['success_msg'] .= "<a href='#' class='close' data-dismiss='alert'>&times;</a>";
		$_SESSION['success_msg'] .= "Selected Sub Sub Category has been deleted successfully.</div>";
		header("Location: ../all-sub-sub-categories.php");
	} else {
		$_SESSION['error_msg'] = "<div class='alert alert-danger'>";
		$_SESSION['error_msg'] .= "<a href='#' class='close' data-dismiss='alert'>&times;</a>";
		$_SESSION['error_msg'] .= "Sorry, there is an error occured while processing your request.</div>";
		header("Location: ../all-sub-sub-categories.php");
	}
}