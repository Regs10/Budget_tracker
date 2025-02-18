<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header('location:loginpage.php');
}
include("./component/Database.php");
$database = new Database();

$id=$_GET['id'];
$editData=mysqli_fetch_assoc($database->getTransactionData($id));
if($_SERVER['REQUEST_METHOD']=='POST'){
    $date=$_POST['date'];
    $remark=$_POST['remark'];
    $amount=$_POST['amount'];

    if($database->updateTransactionData($id,$date,$remark,$amount)){
        header('location:statement.php');
        exit;
    }
    else{
        echo 'error';
    }
    

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="container" id="income">
    <form action="" method="POST">
        <label for="date">Date</label>
        <input type="date" name="date" value="<?=$editData['date']?>">

        <label for="remark">Remark</label>
        <input type="text" name="remark"  value="<?=$editData['remark']?>" >

        <label for="amount">amount</label>
        <input type="number" name="amount"  value="<?=$editData['amount']?>">

        <button type="submit">update</button>
    </form>    
</body>
</html>
