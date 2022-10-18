<?php
require 'DbConnect.php';


if (isset($_POST['branchid'])) {
	$branchid = $_POST['branchid'];
	$db = new DbConnect;
	$conn = $db->connect();

	$stmt = $conn->prepare("SELECT id AS branchid, name AS branchname from tblbranch WHERE id != :branchid");
	$stmt->execute(['branchid' => $branchid]);
	$inventories = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$output = '<option value="">Select Branch</option>';

		foreach ($inventories as $inventory) {
		$output .= '<option value="'. $inventory['branchid'] .'">'. $inventory['branchname'] .'</option>';
		}
		
		
	echo $output;

}




?>