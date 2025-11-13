<?php
error_reporting(0);

if ($_SERVER['HTTP_HOST'] == "localhost") {
	$dns = "localhost";
	$user = "root";
	$pass = "";
	$db = "stockmanagement";
} else {
	$dns = "localhost";
	$user = "phobos_demo";
	$pass = "KJ%&MSf,k.n.";
	$db = "stockmanagement";
}

$connection = new mysqli($dns, $user, $pass, $db);
mysqli_set_charset($connection,'utf8');

if (mysqli_connect_errno()) {
	printf("Connect failed: %s", mysqli_connect_error());
	exit();
}


function sendOrderDeliveryPerson($phone, $id) {
	
	//$url = "http://dakshithtechnologies.msg4all.com/GatewayAPI/rest?method=SendMessage&send_to=".$phone."&msg=You%20received%20new%20order%20with%20order%20id%20".$id.".Please%20pick%20up%20and%20deliver%20order%20as%20soon%20as%20possible.&msg_type=TEXT&loginid=hubrotisms&auth_scheme=plain&password=TYFN6wnHq&v=1.1&format=text";
	//print_r($url);die;
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$curl_scraped_page = curl_exec($ch);
	curl_close($ch);
}

function sendOrderDispatchedMessage($phone, $price, $id) {
	
	//$url ="http://dakshithtechnologies.msg4all.com/GatewayAPI/rest?method=SendMessage&send_to=".$phone."&msg=Your%20Hubroti%20order%20with%20order%20id%20".$id."%20is%20confirmed.Please%20pay%20Rs%20".$price.".&msg_type=TEXT&loginid=hubrotisms&auth_scheme=plain&password=TYFN6wnHq&v=1.1&format=text";

	//print_r($url);die;
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$curl_scraped_page = curl_exec($ch);
	curl_close($ch);
}

function sendOrderCompletedMessage($phone, $name) {
	
	//$url ="http://dakshithtechnologies.msg4all.com/GatewayAPI/rest?method=SendMessage&send_to=".$phone."&msg=Your%20Hubroti%20order%20with%20order%20id%20".$name."%20delivered%20successfully.Thanks%20for%20using%20Hubroti.&msg_type=TEXT&loginid=hubrotisms&auth_scheme=plain&password=TYFN6wnHq&v=1.1&format=text";
	
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$curl_scraped_page = curl_exec($ch);
	curl_close($ch);
}
