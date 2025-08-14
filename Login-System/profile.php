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
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="stylesheet" href="CSS/profile.css" />
  <title>User Profile</title>
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
<?php
$profileid = $_SESSION['profileid'];

$host="sql.freedb.tech";
$username="freedb_moamen";
$pass="Hc5Qg#WHm@sb?5u";
$database="freedb_logindb";
$port="3306";
$con=new mysqli($host,$username,$pass,$database,$port);
$result = mysqli_query($con, "SELECT * FROM `users` WHERE `id`='$profileid'");
$alldata = mysqli_fetch_assoc($result);
?>

<a class="logout" href="logout.php">Logout</a>



  <div class="profile">
        <img src="image\<?php echo $alldata['image']; ?>" alt="Profile Picture">
        <h1 class="welcome">Welcome Mr.<?php echo $alldata['username']; ?> in our website</h1>
  </div>

</body>
</html>

<?php }else {
  session_unset();
  session_destroy();
  header("location: index.php");
}?>
