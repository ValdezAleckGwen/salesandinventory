<?php 
include 'getdata.php';
include 'database_connection.php';
setlocale(LC_MONETARY, 'en_IN');

  $output = '';
  $quantity = 1;
  $productprice = '₱18,150.75';
  $output .= "<li>".$productprice. "</li>";
  $output .= "<li>".$productprice. "</li>";


  echo $output;
  
  
 

  

?>