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
	$total = preg_replace('/[^0-9]/s', "",$_POST["total"]);
	$userid = $_SESSION['uid'];
	$branchid = getBranch($userid);

	// create a sale
	$salesquery = "
	INSERT INTO tblpurchaseorder (id, supplierid, branchid, total, userid) VALUES (:purchaseorderid, :supplierid, :branchid, :total, :userid)
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
        (id, poid, productid, branchid, price, quantity, poquantity, total) 
        VALUES (:purchaseorderitemid, :poid, :productid, :branchid, :price, :item_quantity, :poquantity, :totalprice)
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
				':totalprice'	    =>	$totalprice
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
