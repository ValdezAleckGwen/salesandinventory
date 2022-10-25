<?php 
include 'database_connection.php'

//validate if there is id
if (isset($_POST['id'])) {

	//validate if its still in do 
	if () {

	$poid = $_POST['id'];

	$deletequery = "UPDATE tblpurchaseorder SET active = 2 WHERE id = :id";

	$statement  = $connect->prepare($salesquery);
	$statement->execute([
		':id' => $poid
	]);

	$result = $statement->fetchAll();

	if (isset($result)) {
		echo "Purchase Order Deleted";
	}



	} else {
		echo "Cannot Delete Arrived Items";
	}





} else {
	echo "no data found";
}

?>