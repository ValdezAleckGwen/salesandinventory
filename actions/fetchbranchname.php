<?php
include 'database_connection.php';

if(isset($_GET['id']))
{
    $id = $_GET['id'];
    $query = "SELECT branchid FROM tblusers WHERE id = :id";

    $statement  = $connect->prepare($query);
    $statement->execute([
        ':id' => $id,
    ]);

    $users = $statement->fetchAll(PDO::FETCH_ASSOC);

    foreach($users as $user) {
        $data['branchid'] = $user['branchid'];
    }

    echo json_encode($data);

} else {
    echo "no data found";

}




?>