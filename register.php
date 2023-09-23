<?php
    session_start();

    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true){
        header("Location: index.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Register</title>
</head>
<body>
    <p>designed by chat gpt</p>
    <form method="post" action="/register_check.php">
        <input type="text" name="id" placeholder="id">
        <input type="text" name="pw" placeholder="pw">
        <input type="text" name="email" placeholder="email">
        <input type="submit" value="register">
    </form>
    
</body>
</html>
