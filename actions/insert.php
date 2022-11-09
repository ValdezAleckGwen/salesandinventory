<?php
// minus from inventory 
session_start();
include 'getdata.php';
include 'adddata.php';
include('database_connection.php');

if(isset($_POST["item_id"]))
{

	$salesid = createId('tblsales');
	
	$total = $_POST["total"];
	$total = filter_var($total, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
	$vattableSale = $_POST['vattable-sale'];
	$vattableSale = filter_var($vattableSale, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
	$vat = $_POST['vat'];
	$vat = filter_var($vat, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
	$taxid = $_POST['tax'];
	
	$userid = $_SESSION['uid'];
	$branchid = getBranch($userid);
	

	// create a sale
	$salesquery = "
	INSERT INTO tblsales (id, total, taxid, vat, vattablesale, userid, branchid, active) VALUES (:salesid, :total, :taxid, :vat, :vattablesale, :userid, :branchid, 1)
	";

	$statement  = $connect->prepare($salesquery);
	$statement->execute([
		':salesid' => $salesid,
		':total' => $total,
		':taxid' => $taxid,
		':vat' => $vat,
		':vattablesale' => $vattableSale,
		
		':userid' => $userid,
		':branchid' => $branchid,
		
	]);

	

	$result = $statement->fetchAll();

	//create sales item
	for($count = 0; $count < count($_POST["item_id"]); $count++)
	{

		$query = "
		INSERT INTO tblsalesitem 
        (id, salesid, productid, price, quantity, total) 
        VALUES (:salesitemid, :salesid, :productid, :item_price, :item_quantity, :item_total)
		";

		$salesitemid = createId('tblsalesitem'); //incrementing sales item id
		$price = $_POST["item_price"][$count];
		$price = filter_var($price, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
		$totalprice = $_POST["item_total"][$count];
		$totalprice = filter_var($totalprice, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
		$inventoryid = $_POST["item_id"][$count];
		$productidquery = getQueryOne('productid', 'tblinventory', 'id' , $inventoryid);
		$productid = $productidquery[0]['productid'];
		$item_quantity = $_POST["item_quantity"][$count];
		$statement = $connect->prepare($query);
		
		$statement->execute(
			array(
				':salesitemid'	=>	$salesitemid,
				':salesid'		=>	$salesid,
				':productid'	=>	$productid,
				':item_price'	=>	$price,
				':item_quantity'=>	$item_quantity,
				':item_total'	=>	$totalprice
			)
		);

	}

	$result = $statement->fetchAll();


	
	//remove item from inventory

	for($count = 0; $count < count($_POST["item_id"]); $count++)
	{

		$query = "
		UPDATE tblinventory SET tblinventory.quantity = :quantity WHERE tblinventory.id = :inventoryid
		";


		$item_quantity = 0;
		$availablequantity = 0;
		$inventoryid = $_POST["item_id"][$count];
		$availablequantity = getInventoryCount($inventoryid);
		$item_quantity = $_POST["item_quantity"][$count];
		$quantity = $availablequantity - $item_quantity;
		$statement = $connect->prepare($query);
		
		$statement->execute(
			array(
				':inventoryid'		=>	$inventoryid,
				':quantity'=>	$quantity,
			)
		);

	}
	

	if(isset($result))
	{
		echo 'ok';
	}

} else {
	echo 'awit';
}

?>
