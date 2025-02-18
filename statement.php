<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header('location:loginpage.php');
}
include("./component/Database.php");
$database = new Database();

$result = $database->getExpenditures();
    
// date
    if(isset($_POST['sort'])=='dateSort'){
        $toDate=$_POST['toDate'];
        $fromDate=$_POST['fromDate'];
        
        $result=$database->getSortedData($fromDate,$toDate);

    }
  

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/statement.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500;700&display=swap" rel="stylesheet">
</head>
<body>
<div class="whole">
        <?php include('./component/nav.php');?>
        <!-- --------------------index page-----------------------  -->
        <div class="look">
            <div class="container">
                <div class="down-container">
                </div> 
            </div>
        <div class="bar">
            <div class="bar_heading">
                <h1>Statement</h1>
            </div>  
            <div class="search">
                <div class="dateName">
                    <h3>Date</h3>
                </div>
                <div class="insert_date">
                    <form action="" method="post">
                        <input type="date" name="fromDate">
                        <input type="date" name="toDate">
                        <button type="submit" value="dateSort" name="sort">search</button>
                    </form>

                </div>
            </div>
            <div class="look_data">

            <?php while($row = mysqli_fetch_array($result)){ 
                
                $date = $row['date'];

                // Convert to day and month in string value
                $dayAndMonth = date("d F", strtotime($date));

                // Get the year separately
                $year = date("Y", strtotime($date));

                if($row['exp_type'] == 'expense'){
                    $amount = '- '.'Rs.'.$row['amount'];
                } else {
                    $amount = '+ '.'Rs.'.$row['amount'];
                }
            ?>

                <div class="singleContent">
                    <div class="small_date">
                        <p><?= $dayAndMonth . ' ' . $year ?></p>
                    </div>
                    <div class="big_data">
                        
                        <div class="remark">
                            <?= $row['remark'] ?>
                        </div>
                        <div class="amount">
                            <?= $amount ?>
                            <?php 
                            ?>
                        </div>
                        <div class="edit">
                            <a href="edit.php?id=<?=$row['transaction_id']?>"><img src="./img/edit.png" alt="edit"></a>
                        </div>
                        <div class="delete">
                            <a href="delete.php?id=<?=$row['transaction_id']?>"><img src="./img/delete.png" alt="delete"></a>
                        </div>
                    </div>
                </div>

            <?php } ?> 

            </div>
        </div>
    </div>   
</div>    
<script src="./javaScript/Date.js"></script>
</body>
</html>