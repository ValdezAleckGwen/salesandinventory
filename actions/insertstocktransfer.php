<?php
// minus from inventory 
session_start();
include '../actions/getdata.php';
include 'adddata.php';
include('database_connection.php');

if(isset($_POST["item_id"]))
{

	//create main stock transfer
	
	$stocktransferid = createId('tblstocktransfer');
	$destinationbranch = $_POST['destination_branch'];
	$userid = $_SESSION['uid'];
	//check if stock manager or admin 
	if (getPermission($userid) == 1) {
		$sourcebranch =  $_POST['source_branch'];
	} else {
		$sourcebranch = getBranch($userid);
	}
	

	// create a stock transfer 
	$transferquery = "
	INSERT INTO tblstocktransfer (id, source, destination, userid) VALUES (:id, :source, :destination, :userid)
	";

	$statement  = $connect->prepare($transferquery);
	$statement->execute([
		':id' => $stocktransferid,
		':source' => $sourcebranch,
		':destination' => $destinationbranch,
		':userid' => $userid,

	]);

	

	$result = $statement->fetchAll();

	//create create stock transfer items
	for($count = 0; $count < count($_POST["item_id"]); $count++)
	{

		$query = "
		INSERT INTO tblstocktransferitem (id, stocktransferid, inventoryid, productid, quantity) 
        VALUES (:id, :stocktransferid, :inventoryid, :productid, :quantity)
		";

		$statement  = $connect->prepare($query);
		$id = createId('tblstocktransferitem'); //incrementing sales item id
		$inventoryid = $_POST["item_id"][$count];
		$productidquery = getQueryOne('productid', 'tblinventory', 'id' , $inventoryid);
		$productid = $productidquery[0]['productid'];
		$quantity = $_POST["item_quantity"][$count];

		
		$statement->execute(
			array(
				':id'				=>	$id,
				':stocktransferid'	=>  $stocktransferid,
				':inventoryid'		=>	$inventoryid,
				':productid'        =>  $productid,
				':quantity'			=>	$quantity,
			)
		);

	}

	$result = $statement->fetchAll();
	
	//either add to inventory or create new inventory

	// 	for($count = 0; $count < count($_POST["item_id"]); $count++)
	// {

	// 	$query = "
	// 	UPDATE tblinventory SET quantity = :quantity WHERE tblinventory.id = :id
	// 	";

	// 	$statement  = $connect->prepare($query);
	// 	$itemquantity = 0;
	// 	$itemavailable = 0;
	// 	$inventoryid = $_POST["item_id"][$count];
	// 	$itemquantity = $_POST["item_quantity"][$count];
	// 	$itemavailable  = $_POST["item_available"][$count];

	// 	$quantity = 0;
	// 	$quantity = $itemavailable - $itemquantity;
	// 	if ($quantity < 0) {
	// 		$quantity = 0;
	// 	}

		
	// 	$statement->execute(
	// 		array(
	// 			':id'	=>	$inventoryid,
	// 			':quantity'		=>	$quantity,
	// 		)
	// 	);

	// }

	// $result = $statement->fetchAll();

	//remove the item in the source branch

		for($count = 0; $count < count($_POST["item_id"]); $count++)
	{

		$query = "
		UPDATE tblinventory SET quantity = :quantity WHERE tblinventory.id = :id
		";

		$statement  = $connect->prepare($query);
		$inventoryid = $_POST["item_id"][$count];
		$itemquantity = $_POST["item_quantity"][$count];
		$itemavailable  =$_POST["item_available"][$count];

		//get the available quantity and deduct the transffered items
		$quantity = 0;
		$quantity = $itemavailable - $itemquantity;
		if ($quantity < 0) { //if the inputted quantity is more than the available quantity therefore it is automatically zero
			$quantity = 0;
		}

		
		$statement->execute(
			array(
				':id'	=>	$inventoryid,
				':quantity'		=>	$quantity,
			)
		);

	}

	$result = $statement->fetchAll();

	//add item to the destination branch (check if there is an available inventory)

		for($count = 0; $count < count($_POST["item_id"]); $count++)
	{
		//get supplier id
		$query = "SELECT tblinventory.supplierid AS supplierid FROM tblinventory WHERE tblinventory.id = :inventoryid";

		$statement  = $connect->prepare($query);

		$inventoryid = $_POST['item_id'][$count];

		$statement->execute(
			array(
				':inventoryid'	=>	$inventoryid,
	
			)
		);

		$results = $statement->fetchAll(); //run the sql for for supplier id and quantity
		$supplierid = '';
		foreach ($results as  $result) {
			$supplierid = $result['supplierid']; //declared supplier id;
		}

		//check if there is an inventory or not in that branch 

		$checkquery = "
		SELECT tblinventory.id AS inventory FROM tblinventory WHERE tblinventory.branchid = :branchid AND tblinventory.productid =:productid AND tblinventory.supplierid = :supplierid
		";

		$statement  = $connect->prepare($checkquery);
		$inventoryid = $_POST['item_id'][$count];
		$productidquery = getQueryOne('productid', 'tblinventory', 'id' , $inventoryid);
		$productid = $productidquery[0]['productid'];

		
		$statement->execute(
			array(
				':branchid'			=>	$destinationbranch, //destination branch is already declared in line 13 all goods 
				':productid'		=>	$productid,
				':supplierid'		=>	$supplierid //supplier id is declared in 160 
			)
		);




		$results = $statement->fetchAll(); //run the sql for getting the inventory avaialble


		

		

		if (empty($results)) { //if no inventory
			//create a inventory for the branch
			$query = "
			INSERT INTO tblinventory (id, productid, supplierid, branchid, quantity) VALUES (:id, :productid, :supplierid, :branchid, :quantity);
			";

		$itemquantity = $_POST["item_quantity"][$count];
		$itemavailable  =$_POST["item_available"][$count];
		$quantity  = 0;
		$quantity = $itemavailable - $itemquantity;
		if ($quantity < 0 ) {
			$quantity = $itemavailable;
		} else {
			$quantity = $itemquantity;
		}



		$statement  = $connect->prepare($query);
		$newinventoryid = createId('tblinventory');
		$inventoryid = $_POST["item_id"][$count];
		$productidquery = getQueryOne('productid', 'tblinventory', 'id' , $inventoryid);
		$productid = $productidquery[0]['productid'];


		$statement->execute(
			array(
				':id'	        =>	$newinventoryid,
				':productid'	=>	$productid,
				':supplierid'	=>	$supplierid, //supplier id is already declared in 147
				':branchid'		=>	$destinationbranch, //destination branch is already declared in line 13
				':quantity'		=>  $quantity // declared at line 204-211
			)
		);



		} else { //if there is inventory
		// get quantity first
		
		//get the productid of the list of items
		$inventoryid = $_POST["item_id"][$count];
		$productidquery = getQueryOne('productid', 'tblinventory', 'id' , $inventoryid);
		$productid = $productidquery[0]['productid'];

		$query = "
		SELECT tblinventory.quantity AS quantity FROM tblinventory WHERE tblinventory.branchid = :branchid AND tblinventory.productid = :productid AND tblinventory.supplierid = :supplierid
		";


		

		$statement  = $connect->prepare($query);
		$statement->execute(
			array(
				':productid'	=>	$productid,
				':supplierid'	=>	$supplierid, //supplier id is already declared in 147
				':branchid'		=>	$destinationbranch, //destination branch is already declared in line 13
				
			)
		);

		$results = $statement->fetchAll();

		foreach($results as $result) {
			$inventoryquantity = $result['quantity'];
		}

		$itemquantity = $_POST["item_quantity"][$count];
		$itemavailable  =$_POST["item_available"][$count];
		$quantity  = 0;
		$quantity = $itemavailable - $itemquantity;
		if ($quantity < 0 ) {
			$itemquantity = $itemavailable;
		} 

		$totalquantity = $inventoryquantity + $itemquantity;

		$query = "
		UPDATE tblinventory SET quantity = :quantity WHERE tblinventory.branchid = :branchid AND tblinventory.productid = :productid AND tblinventory.supplierid = :supplierid
		";
		

		$statement  = $connect->prepare($query);


		$statement->execute(
			array(
				':productid'	=>	$productid,
				':supplierid'	=>	$supplierid, //supplier id is already declared in 147
				':branchid'		=>	$destinationbranch, //destination branch is already declared in line 13
				':quantity'		=>  $totalquantity //computed at 255 to 256
			)
		);

		}

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
