<?php
    session_start();
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    // DB Connection
    include 'db_config.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Board!</title>
</head>
<body>
    
    <div class="my_box">
        <p>
    <?php
        if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
            echo $_SESSION["nickname"] . "님 환영합니다.";
    ?>
        </p>
            <button type="button" name="logOut" onclick="location.href='logout.php'">logout</button>
            <button type="button" name="myPage" onclick="location.href='mypage.php'">mypage</button>
    <?php
        }else{
    ?>
            <button type="button" onclick="location.href='login.php'">login</button>
    <?php
        }
       
    ?>
    </div>
    <button onclick="location.href='post.php'">게시글 작성</button>
    <table border="1">
    <thead>
        <th>번호</th>
        <th>제목</th>
        <th>작성자</th>
        <th>조회수</th>
    </thead>
    <tbody>
    <?php
        $stmt = $pdo->prepare("SELECT * FROM posts");
        $stmt->execute();
        $post_result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($post_result as $row){
            $stmt = $pdo->prepare("SELECT nickname FROM users WHERE id_number = :id_number");
            $stmt->execute(array(':id_number'=>$row["id_number"]));
            $name_result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // 회원탈퇴한 유저가 아니라면
            if($name_result)
                $nickname = $name_result["nickname"];

            // 회원탈퇴한 유저라면
            if($row["id_number"] === NULL)
                $nickname = "(알수없음)";
            echo "<tr>";
            echo "<td>" . $row["post_id"] . "</td>";
            echo "<td class='title'>";
            echo "<a href='content.php?post_id=" . htmlspecialchars($row["post_id"], ENT_QUOTES, 'UTF-8') . "'>" . htmlspecialchars($row["title"], ENT_QUOTES, 'UTF-8') . "</a>";
            echo "</td>";
            echo "<td>" . $nickname . "</td>";
            echo "<td>" . $row["views"] . "</td>";
            echo "<tr>";
        }
        
    ?>
    </tbody>
</table>

</body>
</html>