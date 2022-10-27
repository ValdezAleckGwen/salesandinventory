<?php 
include 'getdata.php';
include 'database_connection.php';

$doid = 'DO-0000005';
$deliveryorders = getQueryTwo('poiid','quantity', 'tbldeliveryorderitem', 'doid', $doid);

foreach ($deliveryorders as $deliveryorder) {
    echo $deliveryorder['poiid'];
    echo "\n";
    echo $deliveryorder['quantity'];
  }  
 

  

?>