<?php

$database = new Database();

$grandTotal=$database->getGrandTotal();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/nav.css">
    
</head>
<body class="super">
   
    <div class="nav">
        <div class="box">
            <div class="inside">
                <div class="logo">
                    BUDGET
                </div>
                <div class="profile">
                    <img src="./img/profile.png" alt="" width="95px" height="95px">
                </div>
                <div class="user">
                    <?=$_SESSION['username']?>
                </div>
                <div class="amount">
                        <?php
                            if($grandTotal>=0){
                            echo "+ Rs.". $grandTotal;

                            }else{
                                echo "- Rs.". $grandTotal*-1;
                            }
                        ?>
                </div>
                <!------------------------------------------ date --------------------------- -->
                <div class="date">
                    <div class="img">
                        <img src="./img/nav/calender.png" alt="" height="38px" width="38px">
                    </div>
                    <div id="time">
                        
                    </div>
                </div>
                <div class="quick">
                    <div class="name"> 
                        Quick menu
                    </div>
                    <div class="menu">
                        <div class="add">
                            <a href="./add.php"><img src="./img/nav/add.png" alt=""  height="45px" width="45px"></a>
                        </div>
                        <div class="add">
                            <a href="./statement.php"><img src="./img/nav/statement.png" alt="" height="45px" width="45px"></a>
                        </div>
                        <div class="add">
                            <a href="./index.php"><img src="./img/nav/home.png" alt="" height="45px" width="45px"></a>
                        </div>
                    </div>
                    <div class="alone-add">
                        <a href="./setting.php"><img src="./img/nav/setting.png" alt="" height="45px" width="45px"></a>
                    </div>        
                </div>
            </div>
        </div>
    </div>
</body>
<script src="../javaScript/Date.js"></script>
</html>