<?php
include 'database_connection.php';

if(isset($_POST['save_branch']))
{
    $id = $_POST['id'];
    $name =  $_POST['name'];
    $address =  $_POST['address'];
    $contact =  $_POST['contact'];



    if($id == NULL || $name == NULL || $address == NULL || $contact == NULL ) {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];

    } else {
    
    $query = "
    INSERT INTO tblbranch (id, name, branchaddress, contactnumber, audit, active) 
    VALUES (:id, :name, :address, :contact, 'AT00', 1)
    ";

    $statement  = $connect->prepare($query);
    $statement->execute([
        ':id' => $id,
        ':name' => $name,
        ':address' => $address,
        ':contact' => $contact
        
    ]);

    $result = $statement->fetchAll();

    if (isset($result)) {
        $res = [
            'status' => 200,
            'message' => 'User Branch Created Successfully'
        ];

    }

    } 
    
    echo json_encode($res);
    return;

} else if(isset($_POST['edit_branch'])) {
    $id = $_POST['id'];
    $name =  $_POST['name'];
    $address =  $_POST['address'];
    $contact =  $_POST['contact'];



    if($name == NULL) {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];

    } else {
    
    $query = "
    UPDATE tblbranch
    SET name = :name,
        branchaddress = :branchaddress,
        contactnumber = :contactnumber
        
    WHERE id = :id
    ";

    $statement  = $connect->prepare($query);
    $statement->execute([
        ':id' => $id,
        ':name' => $name,
        ':branchaddress' => $address,
        ':contactnumber' => $contact
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