<?php
// minus from inventory 
session_start();
include 'adddata.php';
include('database_connection.php');

if(isset($_POST["item_id"]))
{

	
	$paymentid = $_POST['payment_number'];
	$total = preg_replace('/[^0-9]/s', "",$_POST["total"]);
	$supplierid = $_POST['supplier_id'];
	$pending = 1;
	$userid = $_SESSION['uid'];

	// create a sale
	$paymentquery = "
	INSERT INTO tblpayables (id, supplierid, total, userid, active) VALUES (:id, :supplierid, :total, :userid, :active)
	";

	$statement  = $connect->prepare($paymentquery);
	$statement->execute([
		':id' => $paymentid,
		':supplierid' => $supplierid,
		':total' => $total,
		':userid' => $userid,
		':active' => 1
		
	]);

	

	$result = $statement->fetchAll();

	//create sales item
	for($count = 0; $count < count($_POST["item_id"]); $count++)
	{

		$payablequery = "
		INSERT INTO tblpayableitem
        (id, payableid, doiid, doid, supplierid, branchid, productid, price, quantity, total) 
        VALUES (:id, :payableid, :doiid, :doid, :supplierid, :branchid, :productid, :price, :quantity, :total)
		";

		$payableitemid = createId('tblpayableitem'); 
		$deliveryorderitemid = $_POST['item_id'][$count];
		$doid = $_POST['do_id'][$count];
		$branchid = $_POST['item_branch'][$count];
		$productid = $_POST['item_code'][$count];
		$price = $_POST["item_price"][$count];
		$price = filter_var($price, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
		$totalprice = $_POST["item_total"][$count];
		$totalprice = filter_var($totalprice, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

		$item_quantity = $_POST["item_quantity"][$count];
		$statement = $connect->prepare($payablequery);
		
		$statement->execute(
			array(
				':id'			=>	$payableitemid,
				':payableid'	=>	$paymentid,
				':doiid'		=> $deliveryorderitemid,
				':doid'			=>	$doid,
				':supplierid'	=>	$supplierid,
				':branchid'		=>	$branchid,
				':productid'	=>	$productid,
				':price'		=>	$price,
				':quantity'		=>	$item_quantity,
				':total'		=>	$totalprice
			)
		);

	}

	$result = $statement->fetchAll();
	
	//set the status to paid
		for($count = 0; $count < count($_POST["item_id"]); $count++)
	{

		$query = "
		UPDATE tbldeliveryorderitem SET paymentid = :paymentid, paid = 1 WHERE tbldeliveryorderitem.id = :id
		";
		$statement = $connect->prepare($query);
		$doid = $_POST['item_id'][$count];

		
		$statement->execute([
		':id'	=>	$doid,	
		':paymentid' => $paymentid
		]);



	}

	$result = $statement->fetchAll();
	





	if(isset($result))
	{
		echo 'ok';
	}




} else {
	echo 'ok';
}

?>
