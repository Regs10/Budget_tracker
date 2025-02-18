<?php
    session_start();
    if(isset($_SESSION['user_id'])){
        header('location:index.php');
    }
    include("./component/Database.php");
    $database = new Database();

    if (isset($_POST['submit'])) {
        if ($_POST['submit'] == 'Register') {
            if ($_POST['password'] == $_POST['cpassword']) {
                $encrypted = md5($_POST['password']);
                if ($database->insertUser($_POST['username'], $encrypted)) {
                    echo '<script>alert("Registration successful. You can now login.");</script>';
                } else {
                    echo '<script>alert("Registration failed.");</script>';
                }
            } else {
                echo '<script>alert("Password does not match.");</script>';
            }
        } else {
            // Login attempt
            $user = $database->CheckUserExist($_POST['username'], md5($_POST['password']));
            if ($user) {
                // Start a session and store user information
                session_start();
                $_SESSION['user_id'] = $user['user_id']; // Adjust the key according to your database structure
                $_SESSION['username'] = $user['user_name']; 
                header('location:index.php');
            } else {
                echo 'Password did not match';
            }
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/register.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="log">
            <div class="topic" id="headed">
                <h1>login</h1>
                <!-- <?= $errors['password']; ?>
                <?= $errors['username']; ?> -->
            </div>
            <div class="box">
                <form action="" method="post">
                    <div class="row">
                        <label for="username"><img src="./img/email.png" alt="" height="30px" height="30px"></label>
                        
                        <input type="text" name="username" placeholder="user name" required class="username" autocomplete="off">
                    </div>
                    <div class="row">
                        <label for="username"><img src="./img/password.png" alt="" height="30px" height="30 px"></label>
                        <input type="password" name="password" placeholder="password" required class="password" autocomplete="off">
                    </div>
                    <div class="row" id="confirmPass">
                        <label for="username"><img src="./img/password.png" alt="" height="30px" height="30 px"></label>
                        
                        <input type="password" name="cpassword" placeholder="confirm password" class="password">
                    </div>
                    <input type="submit" value="Login" name="submit" class="signup">
                </form>
               
            </div>
            <div class="create" id="register" onclick="showRegister()">
                <h4>create new account</h4>
            </div>
        </div>    
        
    </div>
    <script src="./javaScript/login.js"></script>
</body>
</html>





