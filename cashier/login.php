<?php 
session_start();
session_destroy();
if(empty($_SESSION['uid'])){
 header("Location: ../login.php");
 die();
}
?>