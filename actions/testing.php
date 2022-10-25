<?php 
include 'getdata.php';
include 'database_connection.php';
setlocale(LC_MONETARY, 'en_IN');

$inventoryid = 'P-0000051';
      if ($inventoryid != 0) {
        $db = new DbConnect;
        $conn = $db->connect();
          
        $stmt = $conn->prepare("SELECT tblinventory.id AS inventory, tblinventory.quantity AS count, tblproducts.id AS product, tblproducts.name AS name, tblproducts.price AS price FROM tblinventory INNER JOIN tblproducts ON tblinventory.productId=tblproducts.id WHERE tblproducts.id = :inventoryid");
        $stmt->execute([':inventoryid' => $inventoryid]);
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($products as $product) {
          $data['name'] = $product['name'];
          $price = $product['price'];
          $data['price'] = number_format((float)$price, 2, '.', ',');
        }

        
        echo json_encode($data);
      } else {
        echo " ";
      }

  
  
 

  

?>