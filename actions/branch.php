<?php
include 'database_connection.php'


if (isset($_POST['branch'])) {
	
	$output = '';

	$query = "SELECT id AS branchid, name AS branchname from tblbranch WHERE id != :branchid";

	$statement  = $connect->prepare($query);
	$statement->execute([
		':branchid' => $branchid,
	]);

	$result = $statement->fetchAll();
	$output .= '<option value="">Select Unit</option>';
	foreach($result as $row)
	{
			$output .= '<option value="'.$row["branchid"].'">'.$row["branchname"] . '</option>';
		
	}

	echo $output;


} else {
	$output = 'alert("no data available")';
}

echo $output;




?>