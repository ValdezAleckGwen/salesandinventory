<?php

    if(!empty($_SESSION['uid']) ){
        header("Location: index.php");
        die();
    }
?>