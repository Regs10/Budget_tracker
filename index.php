<?php
    session_start();
    if(!isset($_SESSION['user_id'])){
        header('location:loginpage.php');
    }
    include("./component/Database.php");
    $databases=new Database();
   
    $result=$databases->getExpenditures();

     $dayAndMonth = 'null';
     $year = 'null';
     $remark='null';
     $amount='null';

    if ($result && $result->num_rows > 0){
        while($row=mysqli_fetch_array($result)){
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
        $remark =$row['remark'];
        $result2=$databases->getCategoryImage($row['categories']);

        $imageLOC=mysqli_fetch_array($result2);
        $img_loc=$imageLOC['image_loc'];
        break;
    }
    
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/index.css">

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
<!-- main board -->
        <div class="bar">
            <div class="dashboard">
                <h1>Dashboard</h1>
                <!-- end session -->

                <a href="./logout.php"><img src="./img/log out.png" alt="" height="60px" width="60px"></a>
            </div>
            <div class="slogan">
            <p>Hello Sir,</p>
            <p>hope you are doing well</p>
            </div>
<!-- ----------------------recent statement----------------------------- -->
            <div class="main_contain">
                <div class="recent_statement">
                    <div class="circle">
                        <img src="./img/sale.png" alt="" width="45px" height="45px">
                    </div>
                    <div class="value_statement">
                        <div class="statement date">
                            Last Month
                        </div>
                        <div class="remark_value">
                            
                        </div>
                        <div class="statement_value">
                            <?php

                                $lastMonth=$databases->getLastMonthTotal();
                                
                                if($lastMonth>0){
                                    echo 'Profit';

                                }elseif($lastMonth<0){
                                    echo 'Loss';
                                }
                                else{
                                    echo 'neutral';
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <!--  -->
                <div class="recent_statement">
                    <div class="circle">
                    <img src="./img/grand.png" alt="" width="45px" height="45px">
                    </div>
                    <div class="value_statement">
                        
                        <div class="remark_value">
                            <p>GrandTotal</p>
                        </div>
                        <div class="statement_value">
                            <?php
                            if($grandTotal>=0){
                            echo "+ Rs.". $grandTotal;

                            }else{
                                echo "- Rs.". $grandTotal*-1;
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <!--  -->
                <div class="recent_statement">
                    <div class="circle">
                        <img src="./uploads/<?=$img_loc?>" alt="" width="45px" height="45px">
                    </div>
                    <div class="value_statement">
                        <div class="statement date">
                            <?= $dayAndMonth . ' ' . $year ?>
                        </div>
                        <div class="remark_value">
                            <p><?=$remark?></p>
                        </div>
                        <div class="statement_value">
                            <?=$amount?>
                        </div>
                    </div>
                </div>
            </div>
<!-- -------------------graph----------------------- -->
                    
           <div class="graph">
                <?php
                    $graphResult=$databases->getExpenditures();
                    $incomeAmount=0;
                    $expenseAmount=0;
                    while($row=mysqli_fetch_array($graphResult)){
                        if($row['exp_type']=='income'){
                            $incomeAmount=$incomeAmount+$row['amount'];

                        }else{
                            $expenseAmount=$expenseAmount+$row['amount'];
                        }

                    }
                    // if($incomeAmount>$expenseAmount){
                    //     $max=$incomeAmount;

                    // }else{
                    //     $max=$expenseAmount;
                    // }
                    $max=80000;

                    $incomePercent=($incomeAmount/$max)*100;
                    $expensePercent=($expenseAmount/$max)*100;
                    if($incomePercent>100){
                        $incomePercent=100;
                    }
                    if($expensePercent>100){
                        $expensePercent=100;
                    }
                  

                ?>
                <div class="income-box" style="height: <?=$incomePercent?>%;">
                    
                </div>
                <div class="expense-box" style="height: <?=$expensePercent?>%;">
                    
                </div>
           </div>
        </div>  
    </div>
    
<script src="./javaScript/Date.js"></script>
</body>
</html>