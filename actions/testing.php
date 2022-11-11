<?php 
include 'database_connection.php';
session_start();
include 'getdata.php';

$id = $_SESSION['uid'];

$result = getQueryTwo('password', 'email', 'tblusers', 'id' , $id);
foreach ($result as $r) {
	$currentpassword =  $r['password'];
	$currentemail =  $r['email'];
}

echo $currentemail;
echo $currentpassword;


?>