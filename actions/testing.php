<?php 
include 'getdata.php';
include 'database_connection.php';
setlocale(LC_MONETARY, 'en_IN');

$db = new DbConnect;
  $conn = $db->connect();
  $compname = 'egg';
  $stmt = $conn->prepare("SELECT name from tblcompany");
  $stmt->execute();
  $company = $stmt->fetchAll(PDO::FETCH_ASSOC);
  foreach ($company as $comp) {
    $compname = $comp['name'];
  }
  echo $compname;
  
  
 

  

?>