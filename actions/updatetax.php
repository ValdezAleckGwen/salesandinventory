<?php
include_once "../actions/database_connection.php";


if (isset($_POST['tax'])) {
	$tax = $_POST['tax'];

	$updatequery = "UPDATE tbltax SET tax = :tax";

	$statement  = $connect->prepare($updatequery);
	$statement->execute([
		':tax' => $tax
	]);

	$result = $statement->fetchAll();

	if (isset($result)) {
		echo "Tax Updated";
	}



} else {
	echo "no data";
}


 ?>