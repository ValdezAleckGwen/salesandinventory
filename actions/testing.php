<?php 
include 'database_connection.php';
include 'getdata.php';


$money = 1234;

$money = filter_var($money, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

$money = number_format($money, 2);

echo $money;







?>