<?php
    session_start();
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header("Location: login.php");
    }

    include 'db_config.php';

    $id = $_POST["id"];
    $userPw = $_POST["pw"];

    // 로그인
    $stmt = $pdo->prepare("SELECT * FROM users WHERE user_id = :id");
    $stmt->execute(array(':id' => $id));

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if($result && password_verify($userPw, $result["password"])) {
        $_SESSION["loggedin"] = true;
        $_SESSION["id_number"] = $result["id_number"];
        $_SESSION["id"] = $id;
        $_SESSION["email"] = $result["email"];
        $_SESSION["nickname"] = $result["nickname"];
        $_SESSION["created"] = $result["created_at"];

        echo "<script>location='/index.php';</script>";
        exit();
    }
    else{
        echo "<script>alert('Invalid information.');location='/login.php';</script>";
        exit();
    }
?>