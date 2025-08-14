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
    header("location: index.php");
}else{
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="CSS/login.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>4justtechnology</title>
    <link rel="icon" type="image/png" href="image/favicon-96x96.png" sizes="96x96" />
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

    <div id="content" style="display:none;">
    </div>

    <form action="handle/handlelogin.php" method='post' enctype="multipart/form-data">
        <input type="email" name="email" placeholder="email" id="" value="<?php if(isset($_SESSION['email'])){ echo "<br>"; echo $_SESSION['email'];}?>">
        <?php if(isset($_SESSION['email_e'])) echo $_SESSION['email_e'];unset($_SESSION['email_e'])?>
        <br><br>
        <input type="password" name="password" placeholder="password" id="" value="<?php if(isset($_SESSION['password'])){ echo $_SESSION['password'];}?>">
        <?php if(isset($_SESSION['password_e'])) echo $_SESSION['password_e'];unset($_SESSION['password_e'])?>
        <br><br>
        <input type="submit" value="login">

    <label>New to 4justtechnology?</label>
    <a href='register.php'>Create account</a>

</body>
</html>
<?php }?>