<?php

    if(!empty($_SESSION['uid']) ){
        header("Location: ../login.php");
        die();
    }
?>