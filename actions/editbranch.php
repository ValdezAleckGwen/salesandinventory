<?php

include 'database_connection.php';

if(isset($_GET['id']))
{
    $id = $_GET['id'];
    $query = "SELECT id, name, branchaddress, contactnumber
    FROM tblbranch 
    WHERE id = :id";

    $statement  = $connect->prepare($query);
    $statement->execute([
        ':id' => $id,
    ]);

    $branches = $statement->fetchAll(PDO::FETCH_ASSOC);

    foreach($branches as $branch) {
        $data['id'] = $branch['id'];
        $data['name'] = $branch['name'];
        $data['branchaddress'] = $branch['branchaddress'];
        $data['contactnumber'] = $branch['contactnumber'];

    }

    echo json_encode($data);

} else {
    echo "no data found";
}
?>