<?php 
include 'database_connection.php';
include 'getdata.php';

$salesid = 'S-0000055';


$salesreturnquery = "SELECT tblsalesitem.id AS salesitemid FROM tblsalesitem WHERE tblsalesitem.salesid = '".$salesid."' ";
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