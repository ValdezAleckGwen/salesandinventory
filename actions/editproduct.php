<?php

include 'database_connection.php';

if(isset($_GET['id']))
{
    $id = $_GET['id'];
    $query = "SELECT id, name, supplier, category, price, markupprice, active 
    FROM tblproducts 
    WHERE id = :id";

    $statement  = $connect->prepare($query);
    $statement->execute([
        ':id' => $id,
    ]);

    $products = $statement->fetchAll(PDO::FETCH_ASSOC);

    foreach($products as $product) {
        $data['id'] = $product['id'];
        $data['name'] = $product['name'];
        $data['supplier'] = $product['supplier'];
        $data['category'] = $product['category'];
        $data['price'] = $product['price'];
        $data['markupprice'] = $product['markupprice'];
        $data['active'] = $product['active'];
    }

    echo json_encode($data);

} else {
    echo "no data found";
}
?>