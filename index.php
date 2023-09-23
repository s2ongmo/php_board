<?php
    $host = "localhost";
    $user = "root";
    $pw = "root";
    $dbName = "board";
    $charset = 'utf8mb4';

    $conn = mysqli_connect($host, $user, $pw, $dbName);


    $query = "SELECT * FROM posts";


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>change WORLD!</title>
</head>
<body>
    <table border="1">
    <thead>
        <tr>
            <th>번호</th>
            <th>제목</th>
            <th>작성자</th>
            <th>조회수</th>
        </tr>
    </thead>
    <tbody>
        <?php
        
        ?>
    </tbody>
</table>

</body>
</html>