<?php

    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true){
        header("Location: index.php");
        exit();
    }
    echo "<link rel='stylesheet' href='login_form.css'>"
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <p>designed by chat gpt</p>
    <form method="post" action="/register_check.php">
        <input type="text" name="id" placeholder="id">
        <input type="password" name="pw" placeholder="pw">
        <input type="text" name="email" placeholder="email">
        <input type="text" name="nickname" placeholder="nickname">
        <input type="submit" value="register">
    </form>
    
</body>
</html>
