<?php
ob_flush();
require_once "config.php";
session_start();
if (isset($_POST)) {
	$submit_button = $_POST['submit_button'];
	if (isset($submit_button)) {
//		$username = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['username']));
//		$email = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['email']));
		$password = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['password']));
		$phone = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['phone']));
		
		$current_email = $_SESSION['email'];
		
		$sql = "UPDATE admin_panel SET Password = '$password',phone='$phone'";
		$result = $connection->query($sql);
		
		if ($result == true) {
			$_SESSION['success_msg'] = "<div class='alert alert-success'>";
			$_SESSION['success_msg'] .= "<a href='#' class='close' data-dismiss='alert'>&times;</a>";
			$_SESSION['success_msg'] .= "Your Profile has been updated successfully.</div>";
			header("Location: ../edit-profile.php");
		} else {
			$_SESSION['error_msg'] = "<div class='alert alert-danger'>";
			$_SESSION['error_msg'] .= "<a href='#' class='close' data-dismiss='alert'>&times;</a>";
			$_SESSION['error_msg'] .= "Sorry, There is an error occured while processing your request.</div>";
			header("Location: ../edit-profile.php");
		}
	}
}