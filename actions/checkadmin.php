<?php
session_start();
include_once 'database_connection.php';
include 'getdata.php';

$id = $_SESSION['uid'];

$result = getQueryOne('email', 'tblusers', 'id' , $id);

foreach ($result as $r) {
	
	$currentemail =  $r['email'];
}



if (isset($_POST['email'])) {
	
	$email = $_POST['email'];

	if (strcmp($email, $currentemail) == 0) {
		echo "1";
	} else {
		echo "2";
	}
}


 ?>