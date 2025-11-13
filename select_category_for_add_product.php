<?php
ob_flush();
require_once "include/config.php";
session_start();

$data = array();

$top_category_code = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['top_category_code']));
$secound_category_code = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['secound_category_code']));


if($top_category_code){

     $query ="SELECT * FROM categories WHERE parent_category_code = '$top_category_code' AND category_level = 2";
}else if($secound_category_code){

	$query ="SELECT * FROM categories WHERE parent_category_code = '$secound_category_code' AND category_level = 3";
}

$result = mysqli_query($connection,$query);

  while ($row = $result->fetch_array()) {
         $data[] = $row;
       }

 echo json_encode($data);       