<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>iForum</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
<?php require "partials/header.php" ?>
<?php require "partials/dbconnect.php"?>
<div id="carouselExampleIndicators" class="carousel slide">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img width="640px" height="360px"
                 src="https://www.hp.com/us-en/shop/app/assets/images/uploads/prod/5%20Best%20Coding%20Programs%20for%20Aspiring%20Programmers1650304687858345.jpg"
                 class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img width="640px" height="360px"
                 src="https://global-uploads.webflow.com/62b397ed0ff18cefd722ad0c/62e81ca0304e5174b6fa0d78_coding_for_business.jpg"
                 class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img width="640px" height="360px"
                 src="https://gulfbusiness.com/wp-content/uploads/2021/08/GettyImages-1069786222.jpg"
                 class="d-block w-100" alt="...">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
<h1 style="text-align: center">Welcome to the iDiscuss forum</h1>
<div class="row">
<!--    Fetching all the categories-->
    <?php
    $sql="SELECT * FROM `categories`";
    $result=mysqli_query($conn,$sql);
    while($row=mysqli_fetch_assoc($result)){ //Using loop to iterate through categories
        echo ' <div class="card my-2 mx-2" style="width: 18rem;">
        <img height="200px" width="200px" src="'.$row['Image'].'"
             class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title"><a href="threads.php?catid='.$row['Category_ID'].'">' . $row['Category_Name'] . '</a></h5>
            <p class="card-text">' . substr($row['Description'],0,100).'...</p>
            <a href="threads.php?catid='.$row['Category_ID'].'" class="btn btn-success">View Threads</a>
        </div>
        </div>';}
    ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
<?php require "partials/footer.php" ?>
</body>
</html>
