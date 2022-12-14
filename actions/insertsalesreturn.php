<?php
session_start();
require_once('adddata.php') ;
require_once('database_connection.php');


if(isset($_POST["item_id"]))
{

	
	$salesreturnid = $_POST['salesreturnid'];
	$salesid = $_POST['salesid'];
	$userid = $_SESSION['uid'];

	// create a salesreturn
	$salesquery = "
	INSERT INTO tblsalesreturn (id, salesid, userid) VALUES (:id, :salesid, :userid)
	";

	$statement  = $connect->prepare($salesquery);
	$statement->execute([
		':id' => $salesreturnid,
		':salesid' => $salesid,
		':userid' => $userid

	]);

	
	$result = $statement->fetchAll();

	//create salesreturn items
	for($count = 0; $count < count($_POST["item_id"]); $count++)
	{

		$query = "
		INSERT INTO tblsalesreturnitem (id, salesreturnid, salesitemid, price, quantity, totalprice) 
        VALUES (:id, :salesreturnid, :salesitemid, :price, :quantity, :totalprice)
		";

		$statement  = $connect->prepare($query);
		$id = createId('tblsalesreturnitem'); //incrementing sales item id
		$salesitemid = $_POST["item_id"][$count];
		$price =  $_POST["item_price"][$count];
		$price = filter_var($price, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
		$quantity = $_POST["item_quantity"][$count];
		$totalprice = $_POST["item_total"][$count];
		$totalprice = filter_var($totalprice, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

		
		$statement->execute(
			array(
				':id'				=>	$id,
				':salesreturnid'    =>	$salesreturnid,
				':salesitemid'		=>	$salesitemid,
				':price'            => $price,
				':quantity'			=>	$quantity,
				':totalprice'		=>	$totalprice
			)
		);

	}

	$result = $statement->fetchAll();
	
	//update the salesitem

		for($count = 0; $count < count($_POST["item_id"]); $count++)
	{

		$query = "
		UPDATE tblsalesitem SET quantity = :quantity, total = :total WHERE tblsalesitem.id = :id
		";

		$statement  = $connect->prepare($query);
		
		$id = $_POST["item_id"][$count];
		$quantity = $_POST["item_quantity"][$count];
		$total = $_POST["item_total"][$count];
		$total = filter_var($total, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

		$statement->execute(
			array(
				':id'		=>	$id,
				':quantity'	=>	$quantity,
				':total' 	=> $total
			)
		);

	}

	$result = $statement->fetchAll();

	//get the grantotal
	$query = "SELECT SUM(total) AS grandtotal from tblsalesitem WHERE tblsalesitem.salesid = :salesid
		";

		$statement  = $connect->prepare($query);
		

	$statement->execute([
		':salesid' => $salesid
	]);

	

	$results = $statement->fetchAll();

	$grandtotal = 0.00;

	foreach ($results as $result) {
		$grandtotal = $result['grandtotal'];
	}

	//get tax id
	$query = "SELECT tblsales.taxid AS taxid from tblsales WHERE tblsales.id = :salesid
		";

	$statement  = $connect->prepare($query);
	$statement->execute([
		':salesid' => $salesid
	]);

	$results = $statement->fetchAll();

	$taxid = 0;
	foreach ($results as $result) {
		$taxid = $result['taxid'];
	}

	$statement = $connect->prepare("SELECT * from tbltax");
	$statement->execute();
	$taxes = $statement->fetchAll(PDO::FETCH_ASSOC);
	foreach ($taxes as $tax) {
		$tax = $tax['tax'];
	}
	

	

	$vattablesale = 0.00;
	$vat = 0.00;
	switch ($taxid) {
		case '1':
			$vattablesale = $grandtotal * 0.88;
			$vat = $grandtotal - $vattablesale;
			break;
		case '2':
			$grandtotal *= (1 - ($tax/100));
			$grandtotal *= .8;
			break;
		default:
			$vattablesale = $grandtotal * 0.88;
			$vat = $grandtotal - $vattablesale;
			break;
	}


	//update sales table
	$query = "UPDATE tblsales SET total = :total, vat = :vat, vattablesale = :vattablesale WHERE tblsales.id = :salesid;
		";

		$statement  = $connect->prepare($query);
		

	$statement->execute([
		':salesid' => $salesid,
		':total'    => $grandtotal,
		':vat'   => $vat,
		':vattablesale' => $vattablesale
	]);

	

	$results = $statement->fetchAll();


	if(isset($result))
	{
		echo 'ok';
	}

} else {
	echo 'ok';
}

?>
