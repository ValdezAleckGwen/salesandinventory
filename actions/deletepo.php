<?php
include 'database_connection.php';
include 'getdata.php';

if (isset($_POST['deleteid'])) {
	$poid = $_POST['deleteid'];
	//validate if its still in do 
	$deliveryorder = getDeliveryOrder($poid);
	if (!$deliveryorder) {

//execute the delete 

	$deletequery = "UPDATE tblpurchaseorder SET active = 0 WHERE id = :id";

	$statement  = $connect->prepare($deletequery);
	$statement->execute([
		':id' => $poid
	]);

	$result = $statement->fetchAll();
	$statement->execute([
		':id' => $poid
	]);

	$result = $statement->fetchAll();

	if (isset($result)) {
		echo "ok";
	} else {
		echo "Error Deleting Purchase Order";
	}



	} else {
		// it is already delivered
		echo "Cannot Delete Delivered Items";
	}





} else {
	echo "no data found";
}

?>