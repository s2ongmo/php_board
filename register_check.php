<?php

    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true){
        header("Location: index.php");
        exit();
    }
    
    if($_SERVER["REQUEST_METHOD"] !== "POST"){
        header("Location: register.php");
    }

    include "db_config.php";

    // POST로 받은 데이터 가져오기
    $id = $_POST["id"];
    $userPw = $_POST["pw"];
    $email = $_POST["email"];
    $nickname = $_POST["nickname"];

    // 이메일 양식 체크
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email address.');location='/register.php';</script>";
        exit();
    }

    // 패스워드는 해싱해서 저장하는 것이 좋습니다.
    $hashed_pw = password_hash($userPw, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("SELECT user_id, email, nickname FROM users WHERE user_id = :id OR email = :email OR nickname = :nickname");
    $stmt->execute(array(
        ':id' => $id,
        ':email' => $email,
        ':nickname' => $nickname
    ));
    //  id, email duplicate check
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row){
        if ($row['user_id'] == $id){
            echo "<script>alert('The ID is duplicated.');</script>";
        }else if ($row['email'] == $email){
            echo "<script>alert('The Email is duplicated.');</script>";
        }
        else if ($row['nickname'] == $nickname){
            echo "<script>alert('The Nickname is duplicated.');</script>";
        }
        echo "<script>location='/register.php';</script>";
        exit();
    }
    
    // register query
    $stmt = $pdo->prepare("INSERT INTO users (user_id, password, email, nickname) VALUES (:id, :password, :email, :nickname)");
    $stmt->execute(array(
        ':id' => $id,
        ':password' => $hashed_pw,
        ':email' => $email,
        ':nickname' => $nickname
    ));

    // 결과 확인 및 종료
    if ($stmt->rowCount() > 0) {
        echo "<script>alert('New record created successfully!');location='/login.php';</script>";
    } else {
        echo "<script>alert('Error!');location='/register.php';</script>";
    }
    exit();
?>