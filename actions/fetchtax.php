<?php
include 'getdata.php';

if (isset($_POST['item_total'])) {
	$sum = 0.00;
	$tax = getTax();
	$tax /= 100;
	$vattablesale = 0.00;
	$vat = 0.00;
	for($count = 0; $count < count($_POST["item_total"]); $count++) {
		$totalprice = $_POST["item_total"][$count];
		$totalprice = filter_var($totalprice, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
		$sum += $totalprice;
	}

	if ($_POST['tax'] == 1) {
		$vattablesale = $sum * (1 - $tax);
		$vat = $sum - $vattablesale;
		$status	= 1;
	} else {
		$sum *= (1 - $tax);
		$sum *= .8;
		$status = 2;
	}
	$sum = number_format((float)$sum, 2, '.', ',');
  	$vattablesale = number_format((float)$vattablesale, 2, '.', ',');
  	$vat = number_format((float)$vat, 2, '.', ',');
  	$psum = "₱ " . $sum;
  	$pvattablesale = "₱ ". $vattablesale;
  	$pvat = "₱ ". $vat;

  $data['status'] = $status;
  $data['total'] = $psum;
  $data['vattablesale'] = $pvattablesale;
  $data['vat'] = $pvat;




	echo json_encode($data);

}




?>