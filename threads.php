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
<?php require "partials/dbconnect.php" ?>
<?php require "partials/header.php" ?>
<?php
$showAlert=false;
$id = $_GET['catid'];
$uid=$_SESSION['ID'];
$sql = "SELECT * FROM `categories` WHERE Category_ID='$id'";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    $catname = $row['Category_Name'];
    $catdesc = $row['Description'];
}
$method = $_SERVER['REQUEST_METHOD'];
if ($method == 'POST') {
    $th_title = $_POST['tid'];
    $th_des = $_POST['desc'];
    $sqlx = "INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_uid`, `thread_cid`, `date`) VALUES ('$th_title', '$th_des', '$uid', '$id', current_timestamp())";
    $resx = mysqli_query($conn, $sqlx);
    $showAlert = true;
}
if($showAlert){
    echo'<div class="alert alert-success" role="alert">
  Your thread has been successfully added,please wait for the community to respond.
</div>';
}
echo
    '<div class="container">
    <div class="container-fluid p-5 text-bg-dark rounded-3">
        <h1 class="display-5 fw-bold">Welcome to ' . $catname . ' Forums</h1>
        <p class="col-md-8 fs-4">' . $catdesc . '</p>
    </div>
</div>';
if($_SESSION['loggedin']==true){
    echo'
<div class="container p-5">
    <h2>Start a discussion.</h2>
<form action="threads.php?catid=' . $id . '" method="post">
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Problem Title</label>
        <input type="text" class="form-control" id="tid" name="tid">
        <div id="emailHelp" class="form-text">Keep your title short and crisp.</div>
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Elaborate your problem.</label>
        <div class="form-floating">
            <textarea class="form-control" id="desc" name="desc"></textarea>
        </div>
    </div>
    <button type="submit" class="btn btn-success">Submit</button>
</form>
</div>
<div  class="containers">
    <h1>Browse Questions</h1>';}
else {
    echo '<div class="alert alert-warning my-5" role="alert">
  Log in to ask questions.
</div>';
}
$noresult = true;
$sql = "SELECT * FROM `threads` WHERE `thread_cid`=$id";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    $noresult = false;
    $tid = $row['thread_id'];
    $tname = $row['thread_title'];
    $tdesc = $row['thread_desc'];
    $time=$row['date'];
    $user=$row['thread_uid'];
    $sql2="SELECT Usermail FROM `Users` WHERE user_id='$user'";
    $result2=mysqli_query($conn,$sql2);
    $row2=mysqli_fetch_assoc($result2);
    echo
        '<div class="d-flex">
        <div class="flex-shrink-0">
            <img src="https://www.kindpng.com/picc/m/24-248253_user-profile-default-image-png-clipart-png-download.png"
             alt="user" height="54px" width="54px">
        </div>
        <div class="flex-grow-1 ms-3">
            <h5 class="my-0"><a href="threaddis.php?thread_id=' . $tid . '">' . $tname . '</h5></a>' . $tdesc . '
            </div>
            <h6 class="mt-4">Asked by '.$row2['Usermail'].' at '.$time.'</h6>
    </div>
</div>';
}
if ($noresult) {
    echo '
<div class="container my-5">
<div class="h-100 p-5 bg-body-tertiary border rounded-3">
          <h2>No threads found</h2>
          <p>Be the first one to ask a question!</p>
        </div>
</div>';
}
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
<?php require "partials/footer.php" ?>
</body>
</html>
