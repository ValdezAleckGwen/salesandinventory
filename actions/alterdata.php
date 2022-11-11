<?php
include 'database_connection.php';


function alterTotal(string $poiid) {
	$query = "SELECT total FROM tblpurchaseorderitem WHERE id = ".$poiid."";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();

	echo var_dump($result);
}




?>