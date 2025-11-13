<?php
ob_flush();
require_once "config.php";
session_start();

unset($_SESSION['user_type']);
unset($_SESSION['user_status']);
unset($_SESSION['username']);
session_destroy();
header("Location: ../index.php");