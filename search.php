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
<?php require "partials/dbconnect.php" ?>
<div class="container" style="min-height: 600px">
    <div class="searchResults my-3">
        <h1>Search results for: <?php echo $_GET['search'] ?></h1>
        <?php
        $noResult=true;
        $query = $_GET['search'];
        $sql = "SELECT * FROM `threads` WHERE MATCH(thread_title,thread_desc) AGAINST ('$query')";
        $result = mysqli_query($conn, $sql);
        $rows=mysqli_num_rows($result);
        while ($row = mysqli_fetch_assoc($result)) {
            $noResult=false;
            $tit = $row['thread_title'];
            $dis = $row['thread_desc'];
            $id = $row['thread_id'];
            $url = "threaddis.php?thread_id=" . $id;
            echo '
        <div class="Result">
            <h3><a href="' . $url . '" class="text-dark">' . $tit . '</a></h3>
            <p>' . $dis . '</p>
        </div>';
        }
        if($noResult){
            echo '
            <div class="p-5 mb-4 bg-body-tertiary rounded-3">
      <div class="container-fluid py-5">
        <h1 class="display-5 fw-bold">No Results Found</h1>
        <p class="col-md-8 fs-4">Suggestions:
<ul>
    <li>Make sure that all words are spelled correctly.</li>
    <li>Try different keywords.</li>
    <li>Try more general keywords.</li>
    <li>Try fewer keywords.</li>
    </ul></p>
      </div>
    </div>';
        }
        ?>
    </div>
</div>
<div class="row">
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
<?php require "partials/footer.php" ?>
</body>
</html>

