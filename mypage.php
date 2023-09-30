<?php
    session_start();

    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
        header("Location: index.php");
    include 'db_config.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Page</title>
</head>
<body>
    <h1>MY PAGE</h1>
    <div class="myData">
    <?php
         
        echo "Name " . $_SESSION["nickname"] . "<br>";
        echo "ID " . $_SESSION["id"] . "<br>" ;
        echo "Email " . $_SESSION["email"] . "<br>";
        echo "registration date " . $_SESSION["created"] . "<br>";

    ?>
    <button name="moveMain" onclick="location.href='index.php'">go to main</button>
    </div>
</body>
</html>