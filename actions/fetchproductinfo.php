<?php
require_once 'DbConnect.php';
include_once 'getdata.php';

if (isset($_POST['productid'])) {
	$datatype = $_POST['dataType'];
	
	switch ($datatype) {
		case 1:
			$inventoryid = $_POST['productid'];
			
				$db = new DbConnect;
				$conn = $db->connect();
					
				$stmt = $conn->prepare("
					SELECT tblinventory.id AS inventory, 
					tblinventory.quantity AS count, 
					tblproducts.id AS product, 
					tblproducts.name AS name, 
					tblproducts.markupPrice AS price 

					FROM tblinventory 

					INNER JOIN tblproducts 
					ON tblinventory.productId=tblproducts.id 

					WHERE tblinventory.id = :inventoryid

					");

				$stmt->execute([':inventoryid' => $inventoryid]);
				$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
				
				foreach ($products as $product) {
					$data['name'] = $product['name'];
					$data['available'] = $product['count'];
					$price = $product['price'];
					$data['price'] = filter_var($price, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
				}

				
				echo json_encode($data);
				

			break;
		
		case 2:
			$productid = $_POST['productid'];
			
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
				

			break;

		case 3:
		$poitemid = $_POST['productid'];
			
				$db = new DbConnect;
				$conn = $db->connect();
					
				$stmt = $conn->prepare("
					SELECT tblpurchaseorderitem.id as poitemid, 
					tblpurchaseorderitem.productid as productid, 
					tblpurchaseorderitem.poid as poid, 
					tblpurchaseorderitem.total AS total, 
					tblpurchaseorderitem.price AS price,
					tblpurchaseorderitem.quantity as quantity, 
					tblproducts.name AS name 

					FROM tblpurchaseorderitem 

					INNER JOIN tblproducts 
					ON tblpurchaseorderitem.productid=tblproducts.id 

					WHERE tblpurchaseorderitem.id = :poitemid;
					");


				$stmt->execute([':poitemid' => $poitemid]);
				$pos = $stmt->fetchAll(PDO::FETCH_ASSOC);
				
				foreach ($pos as $po) {
					
					$data['productid'] = $po['productid'];
					$data['poid'] = $po['poid'];
					$totalprice = $po['total'];
					$totalprice = filter_var($totalprice, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
					$price = $po['price'];
					$price = filter_var($price, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
					$data['price'] = number_format($price, 2, '.', ',');
					$data['total'] = number_format($totalprice, 2, '.', ',');
					$data['quantity'] = $po['quantity'];
					$data['name'] = $po['name'];
					
				}

				
				echo json_encode($data);

				

			break;

		case 4:
		$id = $_POST['productid'];
			
				$db = new DbConnect;
				$conn = $db->connect();
					
				$stmt = $conn->prepare("
					SELECT tbldeliveryorderitem.id AS doitemid, 
					tbldeliveryorderitem.branchid AS branch, 
					tbldeliveryorderitem.productid AS productid, 
					tblproducts.name AS productname, 
					tbldeliveryorderitem.quantity as quantity, 
					tbldeliveryorderitem.price as price, 
					tbldeliveryorderitem.total AS total, 
					tbldeliveryorder.id AS doid, 
					tbldeliveryorder.supplierid AS supplierid 

					FROM tbldeliveryorderitem 
					INNER JOIN tbldeliveryorder 
					ON tbldeliveryorderitem.doid=tbldeliveryorder.id 

					INNER JOIN tblsupplier 
					ON tbldeliveryorder.supplierid=tblsupplier.id 

					INNER JOIN tblproducts 
					ON tbldeliveryorderitem.productid=tblproducts.id 

					WHERE paid = 0 AND tbldeliveryorderitem.id = :id;
					");

				
				$stmt->execute([':id' => $id]);
				$dos = $stmt->fetchAll(PDO::FETCH_ASSOC);
				
				foreach ($dos as $do) {
					
					$data['productid'] = $do['productid'];
					$data['doid'] = $do['doid'];
					$branch = branchName($do['branch']);
					$data['branch'] = substr($branch, 0,10);
					$totalprice = $do['total'];
					$totalprice = number_format($totalprice, 2);
					$price = $do['price'];
					$price = number_format($price, 2);
					$data['total'] = filter_var($totalprice, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
					$data['price'] = filter_var($price, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
					$data['quantity'] = $do['quantity'];
					$data['name'] = $do['productname'];
					
				}

				
				echo json_encode($data);

				

			break;

		case 5:
			$inventoryid = $_POST['productid'];
				
					$db = new DbConnect;
					$conn = $db->connect();
						
					$stmt = $conn->prepare("
						SELECT tblinventory.id AS inventory, 
						tblinventory.quantity AS count, 
						tblproducts.id AS product, 
						tblproducts.name AS name, 
						tblinventory.quantity AS quantity 

						FROM tblinventory 

						INNER JOIN tblproducts 
						ON tblinventory.productid=tblproducts.id 

						WHERE tblinventory.id = :inventoryid");

					$stmt->execute([':inventoryid' => $inventoryid]);
					$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
					
					foreach ($products as $product) {
						$data['productid'] = $product['product'];
						$data['name'] = $product['name'];
						$data['quantity'] = $product['quantity'];
					}

					
					echo json_encode($data);
					
					

			break;

		case 6:
			$salesitemid = $_POST['productid'];
				
					$db = new DbConnect;
					$conn = $db->connect();
					
					$query = "
					SELECT tblsalesitem.id AS salesitemid, 
					tblsalesitem.productid AS productid, 
					tblsalesitem.price AS price, 
					tblsalesitem.quantity AS quantity, 
					tblsalesitem.total AS total, 
					tblproducts.name AS productname 

					FROM tblsalesitem 

					INNER JOIN tblproducts 
					ON tblproducts.id=tblsalesitem.productid 

					WHERE tblsalesitem.id = :salesitemid

					";

					$stmt = $conn->prepare($query);
					$stmt->execute([':salesitemid' => $salesitemid]);
					$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
					
					foreach ($products as $product) {
						$data['productid'] = $product['productid'];
						$data['name'] = $product['productname'];
						$price = $product['price'];
						$price = filter_var($price, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
						$price = number_format($price, 2);
						$data['price'] = $price;
						$data['quantity'] = $product['quantity'];
						$data['total'] = $product['total'];
					}

					
					echo json_encode($data);

					
					

			break;



		default:
			echo "no parameters attached";
			break;
	}


	



} else {
	echo "No data found";
}

 ?>


