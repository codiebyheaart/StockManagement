<?php
ob_flush();
error_reporting(0);
session_start();
require_once "config.php";

if (isset($_POST)) {
	$submit_button = $_POST['submit_button'];
	$username = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['username']));
	$password = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['password']));
	if (isset($submit_button) && !empty($username) && !empty($password)) {
		$sql = "SELECT * FROM `admin_panel` WHERE '$username' IN(`E_Mail`,`username`)
			AND `Password` = '$password'";
		$result = $connection->query($sql);
		if ($result->num_rows == 1) {
			$_SESSION['user_status'] = "A";
			$_SESSION['user_type'] = "A";
			$_SESSION['email'] = "$username";
			$_SESSION['success_msg'] = "<div class='alert alert-success'>";
			$_SESSION['success_msg'] .= "<a href='#' class='close' data-dismiss='alert'>&times;</a>";
			$_SESSION['success_msg'] .= "You have been logged in successfully.</div>";
			header("Location: ../main.php");
		} else {
			$_SESSION['error_msg'] = "<div class='alert alert-danger'>";
			$_SESSION['error_msg'] .= "<a href='#' class='close' data-dismiss='alert'>&times;</a>";
			$_SESSION['error_msg'] .= "Sorry username password dosen't match.</div>";
			header("Location: ../index.php");
		}
	}
}