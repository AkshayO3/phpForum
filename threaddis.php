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
$id = $_GET['thread_id'];
$sql = "SELECT * FROM `threads` WHERE `thread_id`=$id";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    $tname = $row['thread_title'];
    $tdesc = $row['thread_desc'];
}
echo
    '<div class="container">
    <div class="container-fluid py-5 text-bg-dark rounded-3">
        <h1 class="display-5 fw-bold">'.$tname.'</h1>
        <p class="col-md-8 fs-4">'.$tdesc.'</p>
        <p>Asked by '.$_SESSION['Usermail'].'</p>
    </div>
</div>
<div class="container mt-5">
    <h1>Discussions</h1>
    <form action="threaddis.php?thread_id=' . $id . '" method="post">
    <div class="mb-3">';
if($_SESSION['loggedin']==true){
    echo'
        <label for="exampleInputPassword1" class="form-label">Post your comment.</label>
        <div class="form-floating">
            <textarea class="form-control" id="desc" name="desc"></textarea>
        </div>
    </div>
    <button type="submit" class="btn btn-success">Submit</button>
</form>
</div>';}
else{
    echo '<div class="alert alert-warning" role="alert">
  Log in to add a comment.
</div>';
}?>
<?php
$showAlert=false;
    $method=$_SERVER['REQUEST_METHOD'];
    if ($method == 'POST') {
        $con = $_POST['desc'];
        $author = $_SESSION['Usermail'];
        $sqlx = "INSERT INTO `comments` (`c_con`, `thread_id`, `c_by`, `comment_time`) VALUES ('$con', '$id', '$author', current_timestamp());";
        $resx = mysqli_query($conn, $sqlx);
        $showAlert = true;
        }
        if ($showAlert) {
            echo '<div class="alert alert-success" role="alert">
  Your comment has been successfully added.
</div>';
    }
$id = $_GET['thread_id'];
$sql = "SELECT * FROM `comments` WHERE `thread_id`=$id";
$result = mysqli_query($conn, $sql);
$noresult=true;
if($rx>0){
while ($row = mysqli_fetch_assoc($result)) {
    $noresult = false;
    $author = $row['c_by'];
    $content = $row['c_con'];
    $date = $row['comment_time'];
    echo
        '<div class="d-flex">
        <div class="flex-shrink-0">
            <img src="https://www.kindpng.com/picc/m/24-248253_user-profile-default-image-png-clipart-png-download.png"
             alt="user" height="54px" width="54px">
        </div>
        <div class="flex-grow-1 ms-3 my-2">
          <p style="font-weight: bold">' . $content . '</p>
        </div>
        <p class="mt-4">' . $author . ' at  ' . $date . '</p>
    </div>
</div>';
}}
    if ($noresult) {
        echo '
<div class="container my-5">
<div class="h-100 p-5 bg-body-tertiary border rounded-3">
          <h2>No comments found</h2>
          <p>Be the first one to start the conversation.</p>
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

