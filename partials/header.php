<?php
session_start();
echo'
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="/iDiscuss">iForum</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.php">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">Contact</a>
                </li>
            </ul>
            ';
if((isset($_SESSION['loggedin']))&&($_SESSION['loggedin']==true)) {
    echo '
            <form class="d-flex my-0 py-0" role="search" action="search.php" method="get">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search">
                <button class="btn btn-outline-success" type="submit">Search</button></form>
            <p class="py-0 my-0 mx-2">Welcome'.$_SESSION['Usermail'].'</p>
            <a href="partials/logout.php" role="button"><button class="btn btn-success">Sign Out</button></a> ';}
else {
    echo '
            <button class="btn btn-success mx-2" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
            <button class="btn btn-success mx-2" data-bs-toggle="modal" data-bs-target="#signupModal">SignUp</button>';
}
            echo'
        </div>
    </div>
</nav>';
include "partials/loginmodal.php";
include "partials/signupmodal.php";
if((isset($_GET['signupsuccess']))&&($_GET['signupsuccess']==true)){
    echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
  <strong>Sign-In Successful.</strong> You can now login.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
?>

