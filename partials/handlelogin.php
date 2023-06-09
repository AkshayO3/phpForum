<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$showError='false';
if ($_SERVER['REQUEST_METHOD']=='POST') {
    include "dbconnect.php";
    $email = $_POST['Usermail'];
    $pass = $_POST['password'];
    $exists="SELECT * FROM `users` WHERE Usermail='$email'";
    $result=mysqli_query($conn,$exists);
    $numrows=mysqli_num_rows($result);
    if($numrows==1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($pass, $row['Password'])) {
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['Usermail'] = $email;
            $_SESSION['ID']=$row['user_id'];
        }
        header("location:/iDiscuss/index.php");
    }
    header("location:/iDiscuss/index.php");
}
?>
