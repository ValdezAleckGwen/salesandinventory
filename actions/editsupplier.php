<?php

include 'database_connection.php';

if(isset($_GET['id']))
{
    $id = $_GET['id'];
    $query = "SELECT id, name, contact, email, address, active
    FROM tblsupplier 
    WHERE id = :id";

    $statement  = $connect->prepare($query);
    $statement->execute([
        ':id' => $id,
    ]);

    $suppliers = $statement->fetchAll(PDO::FETCH_ASSOC);

    foreach($suppliers as $supplier) {
        $data['id'] = $supplier['id'];
        $data['name'] = $supplier['name'];
        $data['contact'] = $supplier['contact'];
        $data['email'] = $supplier['email'];
        $data['address'] = $supplier['address'];
        $data['active'] = $supplier['active'];

    }

    echo json_encode($data);

} else {
    echo "no data found";
}
?>