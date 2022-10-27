<?php 
include('../actions/database_connection.php');
include('../actions/getdata.php');




    
$id = 'IA-0000003';

$query = "SELECT 
tblinventoryadjustment.id AS inventoryadj,
tblproducts.id AS productid,
tblproducts.name AS name,
tblinventoryadjustmentitem.quantity AS quantity

FROM tblinventoryadjustment

INNER JOIN tblinventoryadjustmentitem
ON tblinventoryadjustmentitem.invadjid=tblinventoryadjustment.id
INNER JOIN tblproducts
ON tblinventoryadjustmentitem.productid=tblproducts.id

WHERE tblinventoryadjustment.id = :id";


$statement  = $connect->prepare($query);
$statement->execute([
    ':id' => $id,

]);

$invents = $statement->fetchAll();
echo var_dump($invents);









?>