<?php
    include('database_connection.php');
    session_start();
    ob_start();
    if(isset($_POST['email']) && isset($_POST['password'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];
        
    $query = "
    SELECT * FROM tblusers WHERE email = :email AND password = :password
    ";

    $statement  = $connect->prepare($query);
    $statement->execute([
        ':email' => $email,
        ':password' => $password,
    ]);

    

    $results = $statement->fetchAll();
        
        if(empty($results))
        { 
            echo "<script>alert('Invalid Credentials.')</script>";
            header('location: ../login.php');
        } 
        else 
        {
            
            foreach ($results as $row) {
                $_SESSION['uid']        = $row["id"];
                $permission             = $row["permission"];
                $_SESSION['permission'] = $row["permission"];
                $_SESSION['firstname']  = $row["firstname"];
            }
            
            if ($permission == 1) {
                header('location: ../admin/dashboard_index.php');
                exit();
            } else if ($permission == 2) {
                header('location: ../cashier/pos_index.php');
            } else {
                header('location: ../stockmanager/inventory_index.php');
            }
            mysqli_close($connection);
        }
    } 

?>