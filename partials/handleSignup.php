<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$showError='false';
if ($_SERVER['REQUEST_METHOD']=='POST') {
    include "dbconnect.php";
    $email = $_POST['signupEmail'];
    $pass = $_POST['password'];
    $cpass = $_POST['cpassword'];
    $exists="SELECT * FROM `users` WHERE Usermail='$email'";
    $result=mysqli_query($conn,$exists);
    $numrows=mysqli_num_rows($result);
    if($numrows>0){
        $showError="Username email already in use";
    }
    else{
        if($pass==$cpass){
            $hash=password_hash($pass,PASSWORD_DEFAULT);
            $sql="INSERT INTO `users` (`Usermail`, `Password`, `Date`) VALUES ('$email', '$hash', current_timestamp())";
            $result=mysqli_query($conn,$sql);
            if($result){
                $showAlert=true;
                header("location:/iDiscuss/index.php?signupsuccess=true");
                exit();
            }
        }
        else{
            $showError="Passwords do not match.";
        }
    }
    header("location:/iDiscuss/index.php?signupsuccess=false&error=$showError");
}
?>