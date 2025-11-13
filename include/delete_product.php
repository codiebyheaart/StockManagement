<?php
ob_flush();
require_once "config.php";
session_start();

if (isset($_GET['id'])) {
	$id = $_GET['id'];
	
	$sql = "SELECT * FROM products WHERE id = '$id'";
	$result = $connection->query($sql);
	
	$fetch = $result->fetch_assoc();
	$image = $fetch['photo_link'];
	$image_delete = "../../images/$image";
	$del1 = unlink($image_delete);
	
	$image2 = $fetch['photo2'];
	$image_delete2 = "../../images/$image2";
	$del2 = unlink($image_delete2);
	
	$image3 = $fetch['photo3'];
	$image_delete3 = "../../images/$image3";
	$del3 = unlink($image_delete3);
	
	$image4 = $fetch['photo4'];
	$image_delete4 = "../../images/$image4";
	$del4 = unlink($image_delete4);
	
	$result1 = $connection->query("DELETE FROM products WHERE id = '$id'");
	if ($result1 == true) {
		$_SESSION['success_msg'] = "<div class='alert alert-success'>";
		$_SESSION['success_msg'] .= "<a href='#' class='close' data-dismiss='alert'>&times;</a>";
		$_SESSION['success_msg'] .= "Selected product has been deleted successfully.</div>";
		header("Location: ../all-products.php");
	} else {
		$_SESSION['error_msg'] = "<div class='alert alert-danger'>";
		$_SESSION['error_msg'] .= "<a href='#' class='close' data-dismiss='alert'>&times;</a>";
		$_SESSION['error_msg'] .= "Sorry, There is an error occurred while processing your request.</div>";
		header("Location: ../all-products.php");
	}
} else {
	$_SESSION['error_msg'] = "<div class='alert alert-danger'>";
	$_SESSION['error_msg'] .= "<a href='#' class='close' data-dismiss='alert'>&times;</a>";
	$_SESSION['error_msg'] .= "Sorry, There is an error occured while processing your request.</div>";
	header("Location: ../all-products.php");
}