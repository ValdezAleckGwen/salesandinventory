<?php 
include "DbConnect.php";

if(isset($_POST['id'])){
   $id =  $_POST['id'];
   //change the function to update***
   $db = new DbConnect;
   $conn = $db->connect();
   $stmt = $conn->prepare("UPDATE tblproducts SET active = 0 WHERE id = :id");
   $stmt->execute([':id' => $id]);
   echo 'ok';
   exit;
}

echo 0;
exit;

?>