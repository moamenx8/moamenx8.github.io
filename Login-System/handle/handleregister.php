<?php
// Turn off error reporting
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);

// Optional: Enable logging errors to a file
ini_set('log_errors', 1);
ini_set('error_log', '../logs/./errors.log'); // Customize path

session_start();
$username = $_POST['username'];
$password=$_POST['password'];
$email=$_POST['email'];
$gender=$_POST['gender'];
$image_name = $_FILES['image']['name'];
$image_temp = $_FILES['image']['tmp_name'];
$image_error= $_FILES['image']['error'];
$extension=pathinfo($image_name,PATHINFO_EXTENSION);
$allow_extenstion=array('png','jpg');
$allow_gender=array('male','female');

$random_name=uniqid();
$newimage=$random_name . "." . $extension;

$hashedpassword=password_hash($password, PASSWORD_DEFAULT);

$host="sql.freedb.tech";
$usernamedb="freedb_moamen";
$passdb="Hc5Qg#WHm@sb?5u";
$database="freedb_logindb";
$port="3306";
$con=new mysqli($host,$usernamedb,$passdb,$database,$port);
$sql = "INSERT INTO users (`username`, `password`, `email`, `gender`, `image`) VALUES ('$username', '$hashedpassword', '$email', '$gender', '$newimage')";
$result = mysqli_query($con, "SELECT * FROM `users` WHERE `email`='$email'");

if(empty($username)) {
    $_SESSION['username_error']='username required';
}elseif (is_numeric($username)) {
    $_SESSION['username_error']='username must be string';
}

if(empty($password)) {
    $_SESSION['password_error']='password required';
}elseif (is_numeric($password)) {
    $_SESSION['password_error']='password must be string';
}

if(empty($email)) {
    $_SESSION['email_error']='email required';
}elseif (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
    $_SESSION['email_error']='data must be string';
}elseif (mysqli_num_rows($result)>0) {
    $_SESSION['email_error']='email already exists';
}

if($image_error==4) {
    $_SESSION['image_error']='imag required';
}elseif (!in_array($extension,$allow_extenstion)) {
    $_SESSION['image_error']='extention not allowed';
}

if(empty($gender)) {
    $_SESSION['gender_error']='gender required';
}elseif (!in_array($gender, $allow_gender)) {
    $_SESSION['gender_error']='gender not allowed';
}


if(isset($_SESSION['username_error'])||isset($_SESSION['password_error'])||isset($_SESSION['email_error'])||isset($_SESSION['gender_error'])||isset($_SESSION['image_error'])){
    header('location:../register.php');
}else{
    $_SESSION['login']='yes';
    $sqlinstert=mysqli_query($con, $sql);
    move_uploaded_file($image_temp, "../image/$newimage");
    //session
    $_SESSION['username']=$username;
    $_SESSION['email']=$email;
    $_SESSION['gender']=$gender;
    $_SESSION['image']=$newimage;

    $getdata=mysqli_query($con,"SELECT * FROM users WHERE `email`='$email'");
    $data=mysqli_fetch_assoc($getdata);
    $_SESSION['profileid']=$data['id'];

    header('location:../profile.php');
}
