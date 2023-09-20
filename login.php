<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Login Form</title>
</head>
<body>
    <p>designed by chat gpt</p>
    <form method="post" action="/login_check.php" id="logForm">
        <input type="text" name="id" placeholder="id">
        <input type="text" name="pw" placeholder="pw">
        <input type="submit" value="login">
    </form>
    <form method="post" action="/register.php" id="regForm">
        <input type="submit" value="register">
    </form>
    <?php
    
    ?>
</body>
</html>
