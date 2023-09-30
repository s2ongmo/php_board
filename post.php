<?php
    session_start();
    if($_SERVER["REQUEST_METHOD"] === "POST") {
        include 'db_config.php';
        $title = $_POST["title"];
        $contents = $_POST["contents"];

        // 게시글 공백 검사
        if(empty(trim($title)) || empty(trim($contents))) {
           echo "<script>alert('Please fill out the contents.');location='post.php';</script>";
           exit();
        }
        
        $stmt = $pdo->prepare("INSERT INTO posts (id_number, title, content, views) VALUES (:id_number, :title, :content, :views)");
        $stmt->execute(array(
            ':id_number' => $_SESSION["id_number"],
            ':title' => $title,
            ':content' => $contents,
            ':views' => 0,
        ));
        if($stmt->rowCount() <= 0){
            echo "<script>alert('Failed to upload the post.');</script>";
        }

        echo "<script>location='/index.php';</script>";
        exit();
    }
    
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Board!</title>
</head>
<body>
    <div id="container">
        <form action="/post.php" method="POST">
            <input type="text" name="title" placeholder="title">
            <?php
                echo "<br>" . $_SESSION["nickname"] . "<br>";
            ?>
            <input type="text" name="contents">
            <input type="submit" name="write" value="등록">
        </form>
    </div>
</body>
</html>