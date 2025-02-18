<?php
    session_start();
    if(!isset($_SESSION['user_id'])){
        header('location:loginpage.php');
    }
    include("./component/Database.php");
    $database = new Database();

    if(isset($_POST['submit'])){
        if($_POST['submit']=='catButton'){
            $transactionType=$_POST['transactionType'];

            $file = $_FILES["catImage"];
            $catImage_location=basename($file["name"]);
            $categoriesName=$_POST['categoriesName'];
            $uploadDirectory = "uploads/";
            $targetFilePath = $uploadDirectory . $catImage_location;
            move_uploaded_file($file["tmp_name"], $targetFilePath); 

            $database->addCategories($transactionType,$catImage_location,$categoriesName);


        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/setting.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500;700&display=swap" rel="stylesheet">

</head>
<body>
    <div class="whole">
        <?php include("./component/nav.php"); ?>
        <div class="look">
            <div class="container">
                <div class="down-container">
                </div>
            </div>
        </div>
        <div class="bar">
            <div class="bar_heading">
                <h1>Setting</h1>
            </div>
            <div class="main-setting">
                <div class="DoSetting">
                    <div class="thing-add-profile" onclick="showProfile()">
                        profile
                    </div>
                    <div class="thing-add-categories" onclick="showCategories()">
                        categories
                    </div>
                </div>
                <div class="view-setting-profile" id="show-profile">
                    <div class="change-profile">
                        <div class="show-profile">
                            <img src="./img/profile.png" alt="">
                            <p>Update Profile</p>
                        </div>
                        <div class="update-profile">
                            <!-- change profile form -->
                            <form action="" method="POST" enctype="multipart/form-data">
                                    <div class="fullname">
                                        <div class="first">
                                            <label for="firstname" >First Name</label><br>
                                            <input type="text" name="firstname" >
                                        </div>
                                        <div class="second">
                                            <label for="lastname">Last Name</label><br>
                                            <input type="text" name="lastname">
                                        </div>
                                    </div>
                                        <div class="third">
                                        <div class="one">
                                        <label for="pImage">change photo</label>
                                        </div>
                                        <div class="two">
                                        <input type="file" name="pImage" accept="image/*">
                                        </div>
                                    </div>
                                    <div class="ok-submit">
                                        <button type="submit" value="profileButton" name="submit">Save</button>
                                    </div>
                                    
                            </form>
                        </div>
                    </div>
                </div>
                <!-- ---------------------------------------add categories------ -->
                <div class="view-setting-categories" id="show-categories" >
                    <div class="change-categories">
                        <div class="show-categories">
                            <img src="./img/add-categories.png" alt="">
                            <p>Add categories</p>
                        </div>
                        <div class="update-categories">
                            <form action="" method="POST" enctype="multipart/form-data">
                                <div class="categories-selection">
                                    <label for="transactionType">Transaction Type</label>
                                    <select name="transactionType" id="">
                                        <option value="income">Income</option>
                                        <option value="expense">Expense</option>
                                    </select>
                                </div>
                                <div class="categories-image">
                                    <label for="catImage">Category Image</label>
                                    <div class="rough">
                                        <input type="file" name="catImage" accept="image/*" required>
                                    </div>
                                </div>
                                <div class="categories-name">
                                    <label for="categoriesName">Categories Name</label>
                                    
                                    <input type="text" name="categoriesName">
                                </div>
                                <div class="button-category">
                                    <button type="submit" class="save" value="catButton" name="submit">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

    <script src="./javaScript/Cdate.js"></script>
</body>
</html>