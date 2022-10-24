<?php

include 'database_connection.php';

if(isset($_GET['id']))
{
    $id = $_GET['id'];
    $query = "SELECT id, name, supplier, category, price, markupprice 
    FROM tblproducts 
    WHERE id = :id";

    $statement  = $connect->prepare($query);
    $statement->execute([
        ':id' => $id,
    ]);

    $users = $statement->fetchAll(PDO::FETCH_ASSOC);

    foreach($users as $user) {
        $data['id'] = $user['id'];
        $data['name'] = $user['name'];
        $data['supplier'] = $user['supplier'];
        $data['category'] = $user['category'];
        $data['price'] = $user['price'];
        $data['markupprice'] = $user['markupprice'];
    }

    echo json_encode($data);

} else {
    echo "no data found";
}
?>