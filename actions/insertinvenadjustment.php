<?php
//minus from inventory 
session_start();
include '../actions/getdata.php';
include 'adddata.php';
include('database_connection.php');

if(isset($_POST["item_id"]))
{

	$invenadjustmentid = $_POST['ia_number'];
	$userid = $_SESSION['uid'];
	$branchid = getBranch($userid);
	

	// create a delivery order
	$deliveryorderquery = "
	INSERT INTO tblinventoryadjustment (id, branchid, auditid) VALUES (:id, :branchid,  :audit)
	";

	$statement  = $connect->prepare($deliveryorderquery);
	$statement->execute([
		':id' => $invenadjustmentid,
		':branchid' => $branchid,
		':audit' => $userid

	]);

	

	$result = $statement->fetchAll();

	// try to consolidate in one loop 
	//create delivery order item
	for($count = 0; $count < count($_POST["item_id"]); $count++)
	{

		$query = "
		INSERT INTO tblinventoryadjustmentitem 
        (id, invadjid, inventoryid, productid,  quantity) 
        VALUES (:id, :invadjid, :inventoryid, :productid, :quantity)
		";

		$id = createId('tblinventoryadjustmentitem'); //incrementing delivery order item id
		$inventoryid = $_POST["item_id"][$count];
		$productid = $_POST["item_code"][$count];
		$availablequantity = $_POST["item_quantity"][$count];
		$adjustmentquantityplus = intval($_POST["adjustment_quantityplus"][$count]);
		$adjustmentquantityminus = intval($_POST["adjustment_quantityminus"][$count]);
		$adjustmentquantity = $adjustmentquantityplus - $adjustmentquantityminus;
		$quantity = 0;
		$quantity = $availablequantity + $adjustmentquantity;
		if ($quantity < 0) {
			$quantity = 0;
		}
		$statement = $connect->prepare($query);
		
		$statement->execute(
			array(
				':id'	    	=>	$id,
				':invadjid' 	=>  $invenadjustmentid,
				':inventoryid' 	=>  $inventoryid,
				':productid'	=>	$productid,
				':quantity'     =>	$adjustmentquantity
			)
		);

	}

	$result = $statement->fetchAll();

	for($count = 0; $count < count($_POST["item_id"]); $count++)
	{

		$query = "
		UPDATE tblinventory SET quantity = :quantity WHERE tblinventory.id = :inventoryid
		";

		$inventoryid = $_POST["item_id"][$count];
		$availablequantity = $_POST["item_quantity"][$count];
		$adjustmentquantityplus = intval($_POST["adjustment_quantityplus"][$count]);
		$adjustmentquantityminus = intval($_POST["adjustment_quantityminus"][$count]);
		$adjustmentquantity = $adjustmentquantityplus - $adjustmentquantityminus;
		$quantity = 0;
		$quantity = $availablequantity + $adjustmentquantity;
		if ($quantity < 0) {
			$quantity = 0;
		}
		$statement = $connect->prepare($query);
		
		$statement->execute(
			array(
				':inventoryid' 	=>  $inventoryid,
				':quantity'     =>	$quantity
			)
		);

	}

	$result = $statement->fetchAll();


	if(isset($result))
	{
		echo 'wow';
	}

} else {
	echo 'nyawit';
}





?>
