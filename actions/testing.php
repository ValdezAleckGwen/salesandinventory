<?php 
include 'database_connection.php';
include 'getdata.php';

$branchid = 'B-0000001';


$salesreturnquery = "SELECT tblinventory.id AS inventory, tblbranch.id AS branch FROM tblinventory INNER JOIN tblbranch ON tblbranch.id=tblinventory.branchid WHERE tblbranch.id = '".$branchid."' ";
			// if (isset($_POST["item_id"])) {
			// 	for($count = 0; $count < count($_POST["item_id"]); $count++) {
			// 		$itemid = $_POST['item_id'][$count];
			// 		$salesreturnquery .= " AND tblsalesitem.id != '".$itemid."'";
			// 	}
			// } 
			$statement = $connect->prepare($salesreturnquery);
			$statement->execute();
			$sale = $statement->fetchAll(PDO::FETCH_ASSOC);


			echo var_dump($sale);




?>