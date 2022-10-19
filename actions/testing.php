<?php 
include 'getdata.php';
include 'database_connection.php';



  if (isset($_POST['item_id'])) {
    for($count = 0; $count < count($_POST["item_id"]); $count++) {
    echo $_POST["item_id"][$count];
  }
  }
  

?>