<?php 
include 'database_connection.php';
include 'getdata.php';

//validate if there is id
  
  $poid = 'PO-0000012';
  //validate if its still in do 
  $deliveryorder = getDeliveryOrder($poid);
  if (!$deliveryorder) {

  //execute the delete 

  $deletequery = "UPDATE tblpurchaseorder SET active = 0 WHERE id = :id";

  $statement  = $connect->prepare($deletequery);
  $statement->execute([
    ':id' => $poid
  ]);

  $result = $statement->fetchAll();

  $deletequery = "UPDATE tblpurchaseorderitem SET active = 0 WHERE poid = :id";

  $statement  = $connect->prepare($deletequery);
  $statement->execute([
    ':id' => $poid
  ]);

  $result = $statement->fetchAll();

  if (isset($result)) {
    echo "Purchase Order Deleted";
  } else {
    echo "Error Deleting Purchase Order";
  }



  } else {
    // it is already delivered
    echo "Cannot Delete Delivered Items";
  }







?>