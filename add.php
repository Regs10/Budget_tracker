<?php
    session_start();
    if(!isset($_SESSION['user_id'])){
        header('location:loginpage.php');
    }
    include("./component/Database.php");
    $database=new Database();
    $userId=$_SESSION['user_id'];
    


    $catResult = $database->getCategoryIncome();
    $catResult2 = $database->getCategoryExpense();
    
    while ($row = mysqli_fetch_assoc($database->getCategoryIncome())) {
        $imageLoc = $row['image_loc'];
        break;
    }
    while ($row = mysqli_fetch_assoc($database->getCategoryExpense())) {
        $imageLoc2 = $row['image_loc'];
        break;
    }         


    if(isset($_POST['submit'])){
        if($_POST['submit'] == 'Add income'){
            $categories=$_POST['categories'];
            $date=$_POST['date'];
            $remark=$_POST['remark'];
            $amount=$_POST['money'];
            $expType='income';
            $database->insertExpenditure($categories,$date,$remark,$amount,$expType,$userId);
        }
        if($_POST['submit']=='Add expense'){
            $categories=$_POST['categories'];
            $date=$_POST['date'];
            $remark=$_POST['remark'];
            $amount=$_POST['money'];
            $expType='expense';
            $database->insertExpenditure($categories,$date,$remark,$amount,$expType,$userId);
        }
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/add.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500;700&display=swap" rel="stylesheet">

</head>
<body>
    <div class="whole">
        <?php include("./component/nav.php"); ?>
        <!-- --------------------------------add------------------- -------------------->
        <div class="look">
            <div class="container">
                <div class="down-container">
                </div>
            </div>
        </div>

        <div class="bar">
            <div class="option">
                <div class="income" onclick="showIncomeTab()">
                    Income
                </div>
                <div class="expense" onclick="showExpenseTab()">
                    Expense
                </div>
            </div>
<!-- =--------------------------------income insert data------------------------------------- -->
            <div class="insert-items" id="income">
                    
                <form action="" method="POST">

                    <div class="col">
                        <div class="row-cat">



                        
                        <div class="selection">
                            <img src="uploads/<?= $imageLoc ?>" alt="" id="selectionImg1" height="42px" width="42px">
                        </div>

                            <select name="categories" id="categories1" class="categories" onchange="showCategoriesImg()">
                                <?php
                                // Generate options dynamically
                                while ($row = mysqli_fetch_assoc($catResult)) {
                                    $cid = $row['cid'];
                                    $imageLoc = $row['image_loc'];
                                    $categoryType = $row['categories_type'];
                                    $categoryName = $row['category_name'];
                                    ?>
                                    <option value="<?= $categoryName ?>" data-image="<?= $imageLoc ?>"><?= $categoryName ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            




                        </div>
                        <div class="row">
                            <label for="date"><img src="./img/date.png" alt="" width="38px" height="38px">Date</label>
                            <input type="Date" name="date" class="shadow">
                        </div>    
                        <div class="row">
                            <label for="date"><img src="./img/remark.png" alt=""  width="38px" height="38px">Remark</label>
                            <input type="text" name="remark" placeholder="" class="shadow">
                        </div>
                        <div class="row">
                            <label for="money"><img src="./img/money.png" alt=""  width="38px" height="38px">Money</label>
                            <input type="number" name="money" placeholder="000000" class="shadow">
                        </div>
                    </div>
                    <input type="submit" value="Add income" name="submit" class="incomeButton">
                </form>  
            </div>

<!-- -------------------------------expenses insert data----------------------------------- -->
            <div class="insert-expense" id="expense">
                <form action="" method="POST">
                    <div class="col">
                        <div class="row-cat">
                            <div class="selection">
                            <img src="uploads/<?= $imageLoc2 ?>" alt="" id="selectionImg2" height="42px" width="42px">
                        </div>


                        <!-- <select name="categories" id="categories2" class="categories" onchange="showCategoriesImg2()">
                            <option value="food">Food</option>
                            <option value="clothing">Clothing</option>
                            <option value="bill">Bill</option>
                            <option value="gift">Gift</option>
                            <option value="girlfriend">Girlfriend</option>
                            <option value="educaion">Education</option>
                        </select> -->
                        <select name="categories" id="categories2" class="categories" onchange="showCategoriesImg2()">
                                <?php
                                // Generate options dynamically
                                while ($row = mysqli_fetch_assoc($catResult2)) {
                                    $cid = $row['cid'];
                                    $imageLoc = $row['image_loc'];
                                    $categoryType = $row['categories_type'];
                                    $categoryName = $row['category_name'];
                                    ?>
                                    <option value="<?= $categoryName ?>" data-image="<?= $imageLoc ?>"><?= $categoryName ?></option>
                                    <?php
                                }
                                ?>
                            </select>



                        </div>
                        <div class="row">
                            <label for="date"><img src="./img/date.png" alt="" width="38px" height="38px"> Date</label>
                            <input type="Date" name="date" class="shadow">
                        </div>
                        <div class="row">
                            <label for="date"><img src="./img/remark.png" alt=""  width="38px" height="38px"> Remark</label>
                            <input type="text" name="remark" placeholder="" class="shadow">
                        </div>
                        <div class="row">
                            <label for="money"><img src="./img/money.png" alt=""  width="38px" height="38px"> Money</label>
                            <input type="number" name="money" placeholder="000000" class="shadow">
                        </div>
                    </div>
                    <input type="submit" value="Add expense" name="submit" class="expenseButton">
                </form>  
            </div>

<!-- ----------------------------------------------reminder insert data------------------ -->
        </div> 
    </div>
    
    <script src="./javaScript/Date.js"></script>    
</body>
</html>
