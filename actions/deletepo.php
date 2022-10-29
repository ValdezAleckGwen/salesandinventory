<?php 
include 'database_connection.php';
include 'getdata.php';

//validate if there is id
if (isset($_POST['deleteid'])) {
	$poid = $_POST['deleteid'];
	//validate if its still in do 
	$deliveryorder = getDeliveryOrder($poid);
	if ($deliveryorder) {

	//execute the delete 

	$deletequery = "UPDATE tblpurchaseorder SET active = 2 WHERE id = :id";

	$statement  = $connect->prepare($deletequery);
	$statement->execute([
		':id' => $poid
	]);

	$result = $statement->fetchAll();

	if (isset($result)) {
		echo "Successfuly deleted Purchase Oorder";
	}



	} else {
		// it is already delivered
		echo "Cannot Delete Delivered Items";
	}





} else {
	echo "no data found";
}

?>