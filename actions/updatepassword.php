<?php
session_start();
include_once 'database_connection.php';

$id = $_SESSION['uid'];
if (isset($_POST['newpassword'])) {
	$newpassword = $_POST['newpassword'];

	$updatequery = "UPDATE tblusers SET password = :password WHERE id = :id";
	$statement = $connect->prepare($updatequery);
	$statement->execute([
		':password' => $newpassword,
		':id' => $id
	]);

	$result = $statement->fetchAll();

	if (isset($result)) {
		echo "Password Successfully Updated";
	} else {
		echo "Error";
	}

} else {
	echo "No data";
}




 ?>