<?php
ob_flush();
require_once "config.php";
session_start();

if (isset($_POST)) {
	$submit_button = $_POST['sbtn'];
	if (isset($submit_button)) {

		$product_id = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['id']));
		
		$updatestock = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['updatestock']));
	
		
			$sql = "UPDATE products SET stock=(stock-'$updatestock') WHERE id = '$product_id'";
			$result = $connection->query($sql);
			
			if ($result == true) {
				$_SESSION['success_msg'] = "<div class='alert alert-success'>";
				$_SESSION['success_msg'] .= "<a href='#' class='close' data-dismiss='alert'>&times;</a>";
				$_SESSION['success_msg'] .= "Your product details has been updated successfully.</div>";
				header("Location: ../all-products.php");
			} else {
				$_SESSION['error_msg'] = "<div class='alert alert-danger'>";
				$_SESSION['error_msg'] .= "<a href='#' class='close' data-dismiss='alert'>&times;</a>";
				$_SESSION['error_msg'] .= "Sorry, there is an error while processing your request.</div>";
				header("Location: ../all-products.php");
			}
	}
}