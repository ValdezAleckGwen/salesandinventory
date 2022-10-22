<?php
if (!empty($_POST['quantity'] && $_POST['price'])) {
	$quantity = $_POST['quantity'];
	$productprice = $_POST['price'];
	$productprice = filter_var($productprice, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
	$totalprice =  $quantity * $productprice;
	// $formatotal = "₱" .number_format($totalprice);
	echo $totalprice;
} else {
	echo "0";
}

?>