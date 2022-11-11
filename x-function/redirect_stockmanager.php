<?php
 if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 



$permission = $_SESSION['permission'];
if ($permission == 1) {
	header('Location: ../admin/dashboard_index.php');
} else if ($permission == 2) {
	header('Location: ../cashier/inventory_index.php');
}


 ?>