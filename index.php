<?php 
session_start();
include 'x-function/redirect_if_notLogin.php';
if ($_SESSION['permission']== 1) {
    header('location: admin/dashboard_index.php');
    exit();
} else if ($_SESSION['permission']== 2) {
    header('location: cashier/pos_index.php');
} else {
    header('location: stockmanager/stock_index.php');
}

?>