<?php 
include 'database_connection.php';
include 'DbConnect.php';
include 'getdata.php';

$branchid = 'B-0000001';


$productid = 'P-0000101';
			if ($productid != 0) {
				$db = new DbConnect;
				$conn = $db->connect();
				$purchaseorderquery = "SELECT tblproducts.id AS productid, tblproducts.name AS name, tblproducts.price AS price FROM tblproducts WHERE tblproducts.id = :productid";
				$stmt = $conn->prepare($purchaseorderquery);

				$stmt->execute([':productid' => $productid]);
				$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
				
				foreach ($products as $product) {
					$data['status'] = 'all goods';
					$data['name'] = $product['name'];
					$price = $product['price'];
					$price = filter_var($price, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
					$data['price'] = number_format($price, 2, '.', ',');

				}

				
				echo json_encode($data);
			} else {
				$data['status'] = 'all goods';
				echo json_encode($data);
			}	


			echo var_dump($sale);




?>