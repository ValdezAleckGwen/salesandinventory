<?php
include 'database_connection.php';
include 'getdata.php';
$poiid = 'PI-0000001';
$doid = 'DO-0000011';
$quantity = 1;
$price = 5.55;


      $updatequery = "UPDATE tblpurchaseorderitem SET quantity = :quantity, price = :price WHERE id = :poiid";

      $statement  = $connect->prepare($updatequery);
      $statement->execute([
        ':quantity' => $quantity,
        ':price' => $price,
        ':poiid' => $poiid
      ]);


