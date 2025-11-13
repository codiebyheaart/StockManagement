<?php
ob_flush();
require "include/config.php";
session_start();
if ($_SESSION['user_type'] == "A" && $_SESSION['user_status'] == "A") {
	$_SESSION['error_msg'] = "<div class='alert alert-danger'>";
	$_SESSION['error_msg'] .= "<a href='#' class='close' data-dismiss='alert'>&times;</a>";
	$_SESSION['error_msg'] .= "You are already Logged in.</div>";
	header("Location: main.php");
}
else {
	include_once "include/login_page.php";
}
?>