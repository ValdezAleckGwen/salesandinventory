<?php
	require_once 'DbConnect.php';


	function addId(string $tblName) {
		
		$db = new DbConnect;
		$conn = $db->connect();
		
		$stmt = $conn->prepare("SELECT * FROM ".$tblName." WHERE active = 1 ORDER BY id DESC LIMIT 1");

		$stmt->execute();
		$stmt->execute();
		$items = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		foreach ($items as $item) {
			 $lastid = $item['id'];

		}

	}

	function createId(string $tblName) {

		switch ($tblName) {
			case 'tblcategory':
				$index = "C-";
				break;
			case 'tblproducts':
				$index = "P-";
				break;
			case 'tblsuppliers':
				$index = "S-";
				break;
			case 'tblusers':
				$index = "U-";
				break;
			case 'tblsalesitem':
				$index = "SI-";
				break;
			case 'tblsales':
				$index = "S-";
				break;
			case 'tblpurchaseorder':
				$index = "PO-";
				break;
			case 'tbldeliveryorder':
				$index = "DO-";
				break;
			case 'tblpayables':
				$index = "PY-";
				break;
			case 'tblpurchaseorderitem':
				$index = "PI-";
				break;
			case 'tbldeliveryorderitem':
				$index = "DI-";
				break;
			case 'tblinventory':
				$index = "I-";
				break;
			case 'tblpayableitem':
				$index = "PA-";
				break;
			case 'tblinventoryadjustment':
				$index = "IA-";
				break;
			case 'tblinventoryadjustmentitem':
				$index = "II-";
				break;
			case 'tblstocktransfer':
				$index = "ST-";
				break;
			case 'tblstocktransfer':
				$index = "STI-";
				break;
			case 'tblsalesreturn':
				$index = "SR-";
				break;
			case 'tblsalesreturnitem':
				$index = "SRI-";
				break;
			default:
				$index = "";
				break;
		}
		$lastid;
		$db = new DbConnect;
		$conn = $db->connect();
		
		// $stmt = $conn->prepare("SELECT * FROM ".$tblName." WHERE active = 1 ORDER BY id DESC LIMIT 1");
		$stmt = $conn->prepare("SELECT * FROM ".$tblName." ORDER BY id DESC LIMIT 1");
		$stmt->execute();
		$items = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		foreach ($items as $item) {
			 $lastid = $item['id'];

		}
		
		if (empty($items)) {
			$number = $index . "0000001";
		} else {
			$idd = str_replace($index,"",$lastid);
			$id = str_pad($idd + 1, 7, 0, STR_PAD_LEFT);
			$number = $index . $id;
		}
		return $number;

	}



	function addCategory () {
		if (isset($_POST['categoryname'])) {
			$categoryname = $_POST['categoryname'];
			$categoryname = ucwords($categoryname);
			

			$categoryid = createId('tblcategory');

			
			$db = new DbConnect;
			$conn = $db->connect();
		
			$stmt = $conn->prepare("SELECT * FROM tblcategory WHERE active = 1 ORDER BY id DESC LIMIT 1");
			$stmt->execute();
			$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
			


			foreach ($categories as $category) {
				if (strcmp($categoryname, $category['name'] ) == 0) {
					echo '<script>alert("CATEGORY ALREADY EXIST")</script>';
				} else {
					$stmt = $conn->prepare("INSERT INTO tblcategory(id, name, active) VALUES (:id, :name, :active)");
					$stmt->execute(['id' => $categoryid, 'name' => $categoryname, 'active' => 1]);
					echo '<script>alert("CATEGORY ADDED")</script>';
				}
			}	
		} 
	}

	function addProduct() {
		if (!empty($_POST['productname'] & $_POST['categoryid'] & $_POST['supplierid'] & $_POST['price'] & $_POST['markupprice'])) {
	
			$productid = createId('tblproducts');
			$productname = $_POST['productname'];
			$productname = ucwords($productname);
			$categoryid = $_POST['categoryid'];
			$supplierid = $_POST['supplierid'];
			$price = $_POST['price'];
			$markupprice = $_POST['markupprice'];

			if ($markupprice >= $price) {
				$db = new DbConnect;
				$conn = $db->connect();
			
				$stmt = $conn->prepare("SELECT * FROM tblproducts WHERE active = 1 ORDER BY id DESC LIMIT 1");
				$stmt->execute();
				$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
				


				foreach ($products as $product) {
					if (strcmp($productname, $product['name'] ) == 0) {
						echo '<script>alert("Product Already Exist")</script>';
					} else {
						$stmt = $conn->prepare("INSERT INTO tblproducts(id, name, supplier, category, price, markupprice, active) VALUES (:id, :name, :supplier, :category, :price, :markupprice, :active)");
						$stmt->execute(['id' => $productid, 'name' => $productname, 'category' => $categoryid, 'supplier' => $supplierid, 'price' => $price, 'markupprice' => $markupprice ,'active' => 1]);
						echo '<script>alert("Product Added")</script>';
					}
				}

			} else {
				echo '<script>alert("Price must be greater than markup price")</script>';
				} 
			 
		}
	}
		
	

	
	

 ?>
	
	
