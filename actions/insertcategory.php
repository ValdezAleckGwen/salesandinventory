<?php
session_start();
include 'getdata.php';
include 'database_connection.php';

if(isset($_POST['save_category']))
{
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



}


 ?>