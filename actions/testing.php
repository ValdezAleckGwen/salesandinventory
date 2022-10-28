<?php 
include 'database_connection.php';
include 'getdata.php';

  $doid = 'DO-0000011';
  //validate if its paid already
  $deliveryorder = getPayment($doid);

  if (!$deliveryorder) {

    //execute the delete the main delivery order

    $deletequery = "UPDATE tbldeliveryorder SET active = 0 WHERE id = :id";

    $statement  = $connect->prepare($deletequery);
    $statement->execute([
      ':id' => $doid
    ]);

    $result = $statement->fetchAll();

    //execute the delete of delivery order items

    $deletequery = "UPDATE tbldeliveryorderitem SET active = 0 WHERE doid = :id";

    $statement  = $connect->prepare($deletequery);
    $statement->execute([
      ':id' => $doid
    ]);

    $result = $statement->fetchAll();

    //update the purchase order quantity 

    $deliveryorders = getQueryThree('poiid', 'quantity', 'total', 'tbldeliveryorderitem', 'doid', $doid);


    $quantity = 0;
    $total = 0.00;
    $poiid = '';
    foreach($deliveryorders as $deliveryorder) {
        $poiid = $deliveryorder['poiid'];
        $doquantity = 0;
        $poquantity = 0;
        $dototal = $deliveryorder['total'];
        $doquantity = $deliveryorder['quantity'];
        alterTotal($poiid);// make sure that the po total is not negative
        $purchaseorders = getQueryTwo('quantity', 'total',  'tblpurchaseorderitem', 'id', $poiid);
        foreach ($purchaseorders as $purchaseorder) {
          $pototal = $purchaseorder['total'];
          $poquantity = $purchaseorder['quantity'];
      }
      $total = $pototal + $dototal;
      $quantity = $poquantity + $doquantity;
      $updatequery = "UPDATE tblpurchaseorderitem SET quantity = :quantity, total = :total WHERE id = :poiid";

      $statement  = $connect->prepare($updatequery);
      $statement->execute([
        ':quantity' => $quantity,
        ':total' => $total,
        ':poiid' => $poiid
      ]);

      $result = $statement->fetchAll();

    }

    if (isset($result)) {
      echo "Delivery Order Deleted";
    } else {
      echo "Error Deleting Delivery Order";
    }

  } else {
    // it is already delivered
    echo "Cannot Delete Paid Items";
  }







?>