<?php
if (!empty($_POST['quantity'] && $_POST['price'])) {
	$quantity = $_POST['quantity'];
	$productprice = $_POST['price'];
	$productprice = floatval(preg_replace('/[^A-Za-z0-9\-]/', '', $productprice));
	$totalprice =  number_format($quantity * $productprice);
	// $formatotal = "₱" .number_format($totalprice);
	echo $totalprice;
} else {
	echo "0";
}

?>