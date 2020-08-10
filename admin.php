<?php 
    session_start();
 
    if(!$_SESSION['admin']){
     header("Location: enter.php");
     exit;
    }


    if($_GET['do'] == 'logout'){
    unset($_SESSION['admin']);
    session_destroy();
    }

?>