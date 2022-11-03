<?php 
include 'database_connection.php';
include 'getdata.php';




$egg = getQueryOne('productid', 'tblinventory', 'id' ,'I-0000001');

echo $egg[0]['productid'];





?>