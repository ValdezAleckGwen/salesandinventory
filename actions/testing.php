<?php 
include 'database_connection.php';
include 'getdata.php';

  $paymentid = 'PY-0000004';
  
  //validate if its still in do 
  
  

    //execute the delete 

    $deletequery = "UPDATE tblpayables SET active = 0 WHERE id = :id";

    $statement  = $connect->prepare($deletequery);
    $statement->execute([
      ':id' => $paymentid
    ]);

    $result = $statement->fetchAll();

    $payments = getQueryOne('doiid', 'tblpayableitem', 'payableid', $paymentid);

    foreach ($payments as $payment) {
      $doiid = $payment['doiid'];
      // for payable item
      $deletequery = "UPDATE tblpayableitem SET active = 0 WHERE doiid = :id";

      $statement  = $connect->prepare($deletequery);
      $statement->execute([
        ':id' => $doiid
      ]);

      $result = $statement->fetchAll();


      // for delivery order

      $deletequery = "UPDATE tbldeliveryorderitem SET paid = 0 WHERE id = :id";



      $statement  = $connect->prepare($deletequery);
      $statement->execute([
        ':id' => $doiid
      ]);

      $result = $statement->fetchAll();


    }


    if (isset($result)) {
      echo "Payment Deleted";
    } else {
      echo "Error Deleting Payment";
    }







?>