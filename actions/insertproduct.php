<?php
include 'database_connection.php';

if(isset($_POST['save_product']))
{
    $id = $_POST['id'];
    $name =  $_POST['name'];
    $supplier =  $_POST['supplier'];
    $category =  $_POST['category'];
    $price =  $_POST['price'];
    $markup =  $_POST['markup'];




    if($id == NULL || $name == NULL || $supplier == NULL || $category == NULL || $price == NULL || $markup == NULL ) {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];

    } else {
    
    $query = "
    INSERT INTO tblproducts (id, name, supplier, category, price, markupPrice, active) 
    VALUES (:id, :name, :supplier, :category, :price, :markup, 1)
    ";

    $statement  = $connect->prepare($query);
    $statement->execute([
        ':id' => $id,
        ':name' => $name,
        ':supplier' => $supplier,
        ':category' => $category,
        ':price' => $price,
        ':markup' => $markup
        
    ]);

    

    $result = $statement->fetchAll();

    if (isset($result)) {
        $res = [
            'status' => 200,
            'message' => 'Product Created Successfully'
        ];

    }

    } 
    


    echo json_encode($res);
    return;



 } else if(isset($_POST['edit_product'])) {
    $id = $_POST['id'];
    $name =  $_POST['name'];
    $supplier =  $_POST['supplier'];
    $category =  $_POST['category'];
    $price =  $_POST['price'];
    $markup =  $_POST['markup'];



    if($name == NULL || $supplier == NULL || $category == NULL || $price == NULL || $markup == NULL) {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];

    } else {
    
    $query = "
    UPDATE tblproducts 
    SET name = :name, supplier = :supplier, category = :category, price = :price, markupprice = :markupprice 
    WHERE id = :id
    ";

    $statement  = $connect->prepare($query);
    $statement->execute([
        ':id' => $id,
        ':name' => $name,
        ':supplier' => $supplier,
        ':category' => $category,
        ':price' => $price,
        ':markupprice' => $markup
    ]);

    

    $result = $statement->fetchAll();

    if (isset($result)) {
        $res = [
            'status' => 200,
            'message' => 'User Product Edited Successfully'
        ];

    }

    } 
    echo json_encode($res);
    return;

} 

?>