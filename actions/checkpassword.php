<?php
include '../actions/database_connection.php';


if (isset($_POST['oldpassword']))  {
	$oldpassword = $_POST['oldpassword'];

	if ($oldpassword == 'tite') {
		echo "1";
	} else {
		echo "0";
	}




} else {
	echo "Data Error";
}

 ?>