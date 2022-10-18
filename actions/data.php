<?php 
	require_once 'DbConnect.php';

	// if(isset($_POST['aid'])) {
	// 	$db = new DbConnect;
	// 	$conn = $db->connect();

	// 	$stmt = $conn->prepare("SELECT * FROM books WHERE author_id = " . $_POST['aid']);
	// 	$stmt->execute();
	// 	$books = $stmt->fetchAll(PDO::FETCH_ASSOC);
	// 	echo json_encode($books);
	// }

	function loadSuppliers() {
		$db = new DbConnect;
		$conn = $db->connect();

		$stmt = $conn->prepare("SELECT * FROM tblsupplier WHERE active = 1");
		$stmt->execute();
		$suppliers = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $suppliers;
	}

	function loadCategories() {
		$db = new DbConnect;
		$conn = $db->connect();

		$stmt = $conn->prepare("SELECT * FROM tblcategory WHERE active = 1");
		$stmt->execute();
		$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $categories;

	}

	
 ?>