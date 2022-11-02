<?php
session_start(); 
include '../actions/getdata.php';
include 'adddata.php';
include('database_connection.php');

if(isset($_POST["item_id"]))
{



	$purchaseorderid = $_POST['po_number'];
	$branchid = $_POST['branch_id'];
	$supplierid = $_POST['supplier_id'];
	$total = $_POST["total"];
	$total = filter_var($total, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
	$userid = $_SESSION['uid'];
	

	// create a sale
	$salesquery = "
	INSERT INTO tblpurchaseorder (id, supplierid, branchid, total, userid, active) VALUES (:purchaseorderid, :supplierid, :branchid, :total, :userid, 1)
	";

	$statement  = $connect->prepare($salesquery);
	$statement->execute([
		':purchaseorderid' => $purchaseorderid,
		':supplierid' => $supplierid,
		':branchid' => $branchid,
		':total' => $total,
		':userid' => $userid
	]);

	

	$result = $statement->fetchAll();

	//create purchase order item
	for($count = 0; $count < count($_POST["item_id"]); $count++)
	{

		$query = "
		INSERT INTO tblpurchaseorderitem 
        (id, poid, productid, branchid, price, quantity, poquantity, total, pototal, active) 
        VALUES (:purchaseorderitemid, :poid, :productid, :branchid, :price, :item_quantity, :poquantity, :totalprice, :pototal, 1)
		";
		
		$purchaseorderitemid = createId('tblpurchaseorderitem'); //incrementing sales item id
		$price = $_POST["item_price"][$count];
		$price = filter_var($price, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
		$totalprice = $_POST["item_total"][$count];
		$totalprice = filter_var($totalprice, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
		$productid = $_POST["item_id"][$count];
		$item_quantity = $_POST["item_quantity"][$count];
		$statement = $connect->prepare($query);
		
		$statement->execute(
			array(
				':purchaseorderitemid'	    =>	$purchaseorderitemid,
				':poid'				=>	$purchaseorderid,
				':productid'		=>	$productid,
				':branchid' 		=> $branchid,
				':price'	        =>	$price,
				':item_quantity'    =>	$item_quantity,
				':poquantity'    	=>	$item_quantity,
				':totalprice'	    =>	$totalprice,
				':pototal'	    	=>	$totalprice
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
