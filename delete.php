<?php
    session_start();
    if(!isset($_SESSION['user_id'])){
        header('location:loginpage.php');
    }
    include("./component/Database.php");
    $database = new Database();

    $id =$_GET['id'];
    if($database->deleteTransactionData($id)){
        header('location:statement.php');
        exit;
    }
    else{
        echo 'error';
    }
?>