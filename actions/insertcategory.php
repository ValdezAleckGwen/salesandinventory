<?php
include 'database_connection.php';

if(isset($_POST['save_category'])) {
    $id = $_POST['id'];
    $name =  $_POST['name'];



    if($id == NULL || $name == NULL) {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];

    } else {
    
    $query = "
    INSERT INTO tblcategory (id, name, active) 
    VALUES (:id, :name, 1)
    ";

    $statement  = $connect->prepare($query);
    $statement->execute([
        ':id' => $id,
        ':name' => $name
    ]);

    

    $result = $statement->fetchAll();

    if (isset($result)) {
        $res = [
            'status' => 200,
            'message' => 'User Category Created Successfully'
        ];

    }

    } 
    echo json_encode($res);
    return;

} else if(isset($_POST['edit_category'])) {
    $id = $_POST['id'];
    $name =  $_POST['name'];
    $active =  $_POST['active'];


    if($name == NULL) {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];

    } else {
    
    $query = "
    UPDATE tblcategory 

    SET name = :name,
    active = :active
    WHERE id = :id
    ";

    $statement  = $connect->prepare($query);
    $statement->execute([
        ':id' => $id,
        ':name' => $name,
        ':active' => $active
    ]);

    

    $result = $statement->fetchAll();

    if (isset($result)) {
        $res = [
            'status' => 200,
            'message' => 'User Category Edited Successfully'
        ];

    }

    } 
    echo json_encode($res);
    return;

} 

?>