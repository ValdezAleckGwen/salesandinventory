<?php 
include 'getdata.php';
include 'database_connection.php';


$sum = 0.00;
  $tax = getTax();
  $tax /= 100;
  $vattablesale = 0.00;
  $vat = 0.00;
  for($count = 0; $count < 1; $count++) {
    // $totalprice = preg_replace('/[^0-9]/s', "",$_POST["item_total"][$count]);
    // $sum += $totalprice;
    $sum = 18150;
  }

  if (true) {
    $vattablesale = $sum * (1 - $tax);
    $vat = $sum - $vattablesale;
    $status = 1;
  } else {
    $sum *= (1 - $tax);
    $sum *= .2;
    $status = 2;
  }
  $sum = number_format((float)$sum, 2, '.', '');
  $vattablesale = number_format((float)$vattablesale, 2, '.', '');
  $vat = number_format((float)$vat, 2, '.', '');
  $psum = "₱" . $sum;
  $pvattablesale = "₱". $vattablesale;
  $pvat = "₱". $vat;

  $data['status'] = $status;
  $data['total'] = $psum;
  $data['vattablesale'] = $pvattablesale;
  $data['vat'] = $pvat;

  echo json_encode($data);

  echo var_dump($data)


  

?>