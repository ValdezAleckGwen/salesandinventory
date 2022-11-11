<?php


if (isset($_POST['item_total'])) {
	$sum = 0.00;

	for($count = 0; $count < count($_POST["item_total"]); $count++) {
		$totalprice = $_POST["item_total"][$count];
		$totalprice = filter_var($totalprice, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
		$sum += $totalprice;
	}

	
	$sum = number_format((float)$sum, 2, '.', ',');
  	$psum = "₱ " . $sum;


 	$data['status'] = 'all goods';
  	$data['total'] = $psum;


	echo json_encode($data);
	

} else {
	$data['status'] = 'no data found';
	echo json_encode($data);
}





?>