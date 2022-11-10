<?php
session_start();
include '../actions/database_connection.php';
include '../actions/getdata.php';

$id = $_SESSION['uid'];

$password = getQueryOne('password', 'tblusers', 'id', $id );

foreach ($password as $p) {
	$currentpassword = $p['password'];
}

if ($_POST['datatype'] == 1) {
	
	if (isset($_POST['oldpassword']))  {
	$oldpassword = $_POST['oldpassword'];

	if (strcmp($oldpassword, $currentpassword) == 0 ) {
		echo "1";
	} else {
		echo "0";
	}




	} else {
		echo "Data Error";
	}



} else {
	$newpw = $_POST['newpassword'];
	$confirmpw = $_POST['confirmpassword'];

	if (strcmp($newpw, $confirmpw) == 0) {
		echo "1";
	} else {
		echo "0";
	}


}

 ?>