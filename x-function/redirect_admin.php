<?php
 if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 



$permission = $_SESSION['permission'];
if ($permission == 2) {
	header('Location: ../cashier/inventory_index.php');
} else if ($permission == 3) {
	header('Location: ../stockmanager/inventory_index.php');
}


 ?>