<?php 
include 'database_connection.php';
include 'getdata.php';


		$checkquery = "
		SELECT * FROM tblinventory WHERE tblinventory.supplierid = 'S-0000001' AND tblinventory.branchid = 'B-0000001' AND tblinventory.productid = 'P-0000001'
		";

		$statement  = $connect->prepare($checkquery);
		$statement->execute();

		

		$result = $statement->fetchAll();




			foreach ($result as $item) {
			$inventoryquantity = $item['quantity'];
				}

echo $inventoryquantity;





?>