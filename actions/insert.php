<?php
// minus from inventory 
session_start();
include 'getdata.php';
include 'adddata.php';
include('database_connection.php');

if(isset($_POST["item_id"]))
{

	

	
	
	$salesid = createId('tblsales');
	
	$total = preg_replace('/[^0-9]/s', "",$_POST["total"]);
	$vattableSale = $_POST['vatable-sale'];
	$vat = $_POST['vat'];
	$taxid = $_POST['tax'];
	$pending = 1;
	$userid = $_SESSION['uid'];
	$branchid = getBranch($userid);
	

	// create a sale
	$salesquery = "
	INSERT INTO tblsales (id, total, taxid, vat, vattablesale, pending, userid, branchid, active) VALUES (:salesid, :total, :taxid, :vat, :vattablesale, :pending, :userid, :branchid, 1)
	";

	$statement  = $connect->prepare($salesquery);
	$statement->execute([
		':salesid' => $salesid,
		':total' => $total,
		':taxid' => $taxid,
		':vat' => $vat,
		':vattablesale' => $vattableSale,
		':pending' => $pending,
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
        VALUES (:salesitemid, :salesid, :item_id, :item_price, :item_quantity, :item_total)
		";

		$salesitemid = createId('tblsalesitem'); //incrementing sales item id
		$price = preg_replace('/[^0-9]/s', "",$_POST["item_price"][$count]);
		$totalprice = preg_replace('/[^0-9]/s', "",$_POST["item_total"][$count]);
		$item_id = $_POST["item_id"][$count];
		$item_quantity = $_POST["item_quantity"][$count];
		$statement = $connect->prepare($query);
		
		$statement->execute(
			array(
				':salesitemid'	=>	$salesitemid,
				':salesid'		=>	$salesid,
				':item_id'		=>	$item_id,
				':item_price'	=>	$price,
				':item_quantity'=>	$item_quantity,
				':item_total'	=>	$totalprice
			)
		);

	}

	$result = $statement->fetchAll();
	
	//remove item from inventory
	

	if(isset($result))
	{
		echo 'ok';
	}

} else {
	echo 'awit';
}

?>
