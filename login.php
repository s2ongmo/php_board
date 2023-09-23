<?php
    session_start();
    
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true){
        echo "<script>alert('you're logged in');</script>";
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
    <title>Login</title>
</head>
<body>
    <p>designed by chat gpt</p>
    <form method="post" action="/login_check.php" id="logForm">
        <input type="text" name="id" placeholder="id">
        <input type="password" name="pw" placeholder="pw">
        <input type="submit" value="login">
    </form>
    <form method="post" action="/register.php" id="regForm">
        <input type="submit" value="register">
    </form>
</body>
</html>
