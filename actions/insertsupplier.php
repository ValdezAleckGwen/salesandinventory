<?php
include 'database_connection.php';

if(isset($_POST['save_supplier']))
{
    $id = $_POST['id'];
    $name =  $_POST['name'];
    $contact =  $_POST['contact'];
    $email =  $_POST['email'];
    $address =  $_POST['address'];


    if($id == NULL || $name == NULL || $contact == NULL || $email == NULL || $address == NULL) {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];

    } else {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

    $query = "
    INSERT INTO tblsupplier (id, name, contact,  email, address, active) 
    VALUES (:id, :name, :contact, :email, :address, 1)
    ";

    $statement  = $connect->prepare($query);
    $statement->execute([
        ':id' => $id,
        ':name' => $name,
        ':contact' => $contact,
        ':email' => $email,
        ':address' => $address
        
    ]);

    

    $result = $statement->fetchAll();

    if (isset($result)) {
        $res = [
            'status' => 200,
            'message' => 'Supplier Created Successfully'
        ];

    }

        } else {
        $res = [
            'status' => 69,
            'message' => 'Please enter a valid email'
        ];
        }
    }

    echo json_encode($res);
    return;



} else if (isset($_POST['edit_supplier'])) {
    $id = $_POST['id'];
    $name =  $_POST['name'];
    $contact =  $_POST['contact'];
    $email =  $_POST['email'];
    $address =  $_POST['address'];
    $active = $_POST['active'];


    if($id == NULL || $name == NULL || $contact == NULL || $email == NULL || $address == NULL) {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];

    } else {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

    $query = "
    UPDATE tblsupplier 
    SET name = :name, contact = :contact, email = :email, address = :address, active = :active 
    WHERE id = :id
    ";

    $statement  = $connect->prepare($query);
    $statement->execute([
        ':id' => $id,
        ':name' => $name,
        ':contact' => $contact,
        ':email' => $email,
        ':address' => $address,
        ':active' => $active
    ]);

    

    $result = $statement->fetchAll();

    if (isset($result)) {
        $res = [
            'status' => 200,
            'message' => 'Supplier Edited Successfully'
        ];

    }

        } else {
        $res = [
            'status' => 69,
            'message' => 'Please enter a valid email'
        ];
        }
    }

    echo json_encode($res);
    return;
}


 ?>