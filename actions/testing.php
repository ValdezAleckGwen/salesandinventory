<?php 
include 'database_connection.php';

include 'getdata.php';

$branchid = 'B-0000001';

$query = "SELECT id as count FROM tblsales WHERE salesdate = '22-11-09'";

$statement  = $connect->prepare($query);
$statement->execute();

$count = $statement->rowCount();


echo $count;

echo " ";

$query = "SELECT SUM(total) as total FROM tblsales WHERE salesdate = '22-11-09'";

$statement  = $connect->prepare($query);
$statement->execute();

$total = $statement->fetchAll();


foreach ($total as $value) {
	$total = $value['total'];
}

echo number_format($total, 2);


?>