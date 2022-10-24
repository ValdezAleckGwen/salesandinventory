<?php 
include "DbConnect.php";

if(isset($_POST['id'])){
   $id =  $_POST['id'];
   
   //change the function to update***
   $db = new DbConnect;
   $conn = $db->connect();
   $stmt = $conn->prepare("UPDATE tblusers SET active = 2 WHERE id = :id");
   $stmt->execute([':id' => $id]);
   echo 'ok';
   exit;
}

echo 0;
exit;

?>