<?php
// Turn off error reporting
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);

// Optional: Enable logging errors to a file
ini_set('log_errors', 1);
ini_set('error_log', 'logs/./errors.log'); // Customize path

session_start();
if (isset($_SESSION['login'])) {
    session_unset();
    session_destroy();
    header("location: register.php");
}else{
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="CSS/register.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>itgate</title>
    
</head>
<body>
    <!-- Header -->
    <header class="main-header">
        <div class="container">
            <h1 class="logo">4justtechnology</h1>
            <nav class="nav-links">
                <a href ="#">Home</a>
                <a href ="#">About</a>
                <a href ="#">Contact</a>
            </nav>
        </div>
    </header>

    <form action="handle/handleregister.php" method='post' enctype="multipart/form-data">
        <input type="text" name="username" placeholder="enter ur username" id="" value="<?php if(isset($_SESSION['username'])){echo $_SESSION['username'];}?>">
         <?php if(isset($_SESSION['username_error'])) echo $_SESSION['username_error'];unset($_SESSION['username_error'])?>
        <br><br>
        <input type="email" name="email" placeholder="email" id="" value="<?php if(isset($_SESSION['email'])){ echo $_SESSION['email'];}?>">
        <?php if(isset($_SESSION['email_error'])) echo $_SESSION['email_error'];unset($_SESSION['email_error'])?>
        <br><br>
        <input type="password" name="password" placeholder="password" id="" value="<?php if(isset($_SESSION['password'])){ echo $_SESSION['password'];}?>">
        <?php if(isset($_SESSION['password_error'])) echo $_SESSION['password_error'];unset($_SESSION['password_error'])?>
        <br><br>
        <label>image</label>
        <input type="file" name="image" id="">
        <?php if(isset($_SESSION['image_error'])) echo $_SESSION['image_error'];unset($_SESSION['image_error'])?>
        <br><br>
        <label>gender</label>
        <input type="radio" name="gender" value="male" id="" <?php if(isset($_SESSION['gender'])){ if($_SESSION['gender']=='male'){echo 'checked';}}?>>male
        <input type="radio" name="gender" value="female" id="" <?php if(isset($_SESSION['gender'])){ if($_SESSION['gender']=='female'){echo 'checked';}}?>>female
         <?php if(isset($_SESSION['gender_error'])) echo "<br><br>". $_SESSION['gender_error'];unset($_SESSION['gender_error'])?>
        <input type="submit" value="register">
    <label>Already have account,</label>
    <a href='index.php'>Login</a>
</body>
</html>
<?php }?>