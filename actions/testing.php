<?php 
include 'getdata.php';
include 'database_connection.php';


  $quantity = 2;
  $productprice = '₱18,150.75';
  $productprice = filter_var($productprice, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
  
  $totalprice =  $quantity * $productprice;
  // $formatotal = "₱" .number_format($totalprice);
  echo $totalprice;

  

?>