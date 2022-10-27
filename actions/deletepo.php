<?php 
include 'database_connection.php';
include 'getdata.php';

//validate if there is id
if (isset($_POST['id'])) {
	$poid = $_POST['id'];
	//validate if its still in do 
	$deliveryorder = getDeliveryOrder($poid);
	if (!$deliveryorder) {

	//execute the delete 

	$deletequery = "UPDATE tblpurchaseorder SET active = 2 WHERE id = :id";

	$statement  = $connect->prepare($salesquery);
	$statement->execute([
		':id' => $poid
	]);

	$result = $statement->fetchAll();

	$deletequery = "UPDATE tblpurchaseorderitem SET active = 2 WHERE poid = :id";

	$statement  = $connect->prepare($salesquery);
	$statement->execute([
		':id' => $poid
	]);

	$result = $statement->fetchAll();

	if (isset($result)) {
		echo "Purchase Order Deleted";
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