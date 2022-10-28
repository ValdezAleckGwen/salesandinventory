<?php
include 'database_connection.php';
include 'getdata.php'

if (isset($_POST['id'])) {
	$doid = $_POST['id'];
	//validate if its paid already
	$deliveryorder = getPayment($doid);
	if (!$deliveryorder) {

		//execute the delete the main delivery order

		$deletequery = "UPDATE tbldeliveryorder SET active = 0 WHERE id = :id";

		$statement  = $connect->prepare($deletequery);
		$statement->execute([
			':id' => $doid
		]);

		$result = $statement->fetchAll();

		//execute the delete of delivery order items

		$deletequery = "UPDATE tbldeliveryorderitem SET active = 0 WHERE id = :id";

		$statement  = $connect->prepare($deletequery);
		$statement->execute([
			':id' => $doid
		]);

		$result = $statement->fetchAll();

		//update the purchase order quantity 

		$deliveryorders = getQueryTwo('poiid', 'quantity', 'tbldeliveryorderitem', 'doid', $doid)



		foreach($deliveryorders as $deliveryorder) {
			$poiid = $deliveryorder['poiid'];
			$doquantity = 0;
			$poquantity = 0;
			$doquantity = $deliveryorder['quantity'];
			$purchaseorders = getQueryOne('quantity', 'tblpurchaseorderitem', 'id', $poiid);
			foreach ($purchaseorders as $purchaseorder) {
				
				$poquantity = $purchaseorder['quantity'];
			}
			$quantity = $poquantity + $doquantity;
			$updatequery = "UPDATE tblpurchaseorderitem SET quantity = :quantity WHERE id = :poiid";

			$statement  = $connect->prepare($salesquery);
			$statement->execute([
				':quantity' => $quantity,
				':poiid' => $poiid
			]);

			$result = $statement->fetchAll();

		}

		if (isset($result)) {
			echo "Delivery Order Deleted";
		} else {
			echo "Error Deleting Delivery Order";
		}

	} else {
		// it is already delivered
		echo "Cannot Delete Paid Items";
	}


} else {
	echo "no data found";
}


















?>
