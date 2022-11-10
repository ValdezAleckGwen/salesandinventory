<?php
include_once 'database_connection.php';

$datetoday = date('Y-m-d');
if (isset($_POST['datatype'])) {
	$dataype = $_POST['datatype'];

	if ($dataype == 1) {
		$query = "SELECT id as count FROM tblsales WHERE salesdate = '".$datetoday."' ";

		$statement  = $connect->prepare($query);
		$statement->execute();

		$count = $statement->rowCount();

		echo $count;
	} else if ($dataype == 2) {
		$query = "SELECT SUM(total) as total FROM tblsales WHERE salesdate = '".$datetoday."'";

		$statement  = $connect->prepare($query);
		$statement->execute();

		$total = $statement->fetchAll();


		foreach ($total as $value) {
			$total = $value['total'];
		}
		$total = (number_format($total, 2));
		$value = '₱ ';
		$value .= $total;
		echo $value;
	}


}





?>