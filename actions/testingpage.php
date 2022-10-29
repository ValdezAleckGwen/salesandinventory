<?php
include 'database_connection.php';
include 'getdata.php';

$paymentid = 'PY-0000004';
$payments = getQueryOne('doiid', 'tblpayableitem', 'payableid', $paymentid);


echo var_dump($payments);
