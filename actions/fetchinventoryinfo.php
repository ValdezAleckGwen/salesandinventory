<?php
require_once 'DbConnect.php';

if (isset($_POST['inventoryid'])) {
	$inventoryid = $_POST['inventoryid'];
	if ($inventoryid != 0) {
		$db = new DbConnect;
		$conn = $db->connect();
			
		$stmt = $conn->prepare("SELECT tblinventory.id AS inventory, tblinventory.quantity AS count, tblproducts.id AS product, tblproducts.name AS name, tblproducts.id AS productid FROM tblinventory INNER JOIN tblproducts ON tblinventory.productid=tblproducts.id WHERE tblinventory.id = :inventoryid");
		$stmt->execute(['inventoryid' => $inventoryid]);
		$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		foreach ($products as $product) {
			$data['productid'] = $product['productid'];
			$data['quantity'] = $product['count'];
			$data['name'] = $product['name'];
		}

		
		echo json_encode($data);
	} else {
		echo "hays";
	}
	
} else {
	echo "0";
}

 ?>


