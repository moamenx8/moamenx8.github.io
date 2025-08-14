<?php
// Turn off error reporting
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);

// Optional: Enable logging errors to a file
ini_set('log_errors', 1);
ini_set('error_log', '../logs/./errors.log'); // Customize path

session_start();
$email=$_POST['email'];
$password=$_POST['password'];
$login_time=date("Y-m-d H:i:s");


$host="sql.freedb.tech";
$username="freedb_moamen";
$pass="Hc5Qg#WHm@sb?5u";
$database="freedb_logindb";
$port="3306";
$con=new mysqli($host,$username,$pass,$database,$port);
$result=mysqli_query($con,"SELECT * FROM users WHERE `email`='$email'");
$alldata = mysqli_fetch_assoc($result);
$check=password_verify($password,$alldata['password']);

if (empty($email)) {
    $_SESSION['email_e']='email required';
}


if (empty($password)) {
    $_SESSION['password_e']='password required';
}


if(isset($_SESSION['email_e'])||isset($_SESSION['password_e'])){
    header('location:../index.php');
}elseif(mysqli_num_rows($result)>0 && $check=TRUE){
        $_SESSION['login']='yes';
        header('location:../profile.php');
    //id used for profile page
        $getdata=mysqli_query($con,"SELECT * FROM users WHERE `email`='$email'");
        $data=mysqli_fetch_assoc($getdata);
        $_SESSION['profileid']=$data['id'];
}elseif(mysqli_num_rows($result)==0 || mysqli_num_rows($result1)==0){
        $_SESSION['password_e']='wrong email or password';
        header('location:../index.php');
}