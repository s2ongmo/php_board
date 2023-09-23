<?php
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header("Location: login.php");
    }

    $host = "localhost";
    $user = "root";
    $pw = "root";
    $dbName = "board";

    // 데이터베이스 연결
    $conn = mysqli_connect($host, $user, $pw, $dbName);
    
    // 연결 실패 시 메시지 출력
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $id = mysqli_real_escape_string($conn, $_POST["id"]);
    $pw = mysqli_real_escape_string($conn, $_POST["pw"]);

    // 로그인 
    $stmt = $conn->prepare("SELECT user_id, password FROM users WHERE user_id = ?");
    $stmt->bind_param("s", $id);

    $stmt->execute();
    $result = $stmt->get_result();

    if($row = $result->fetch_assoc()) {
        // 여기서는 password_verify 함수를 사용하여 입력받은 비밀번호와 저장된 해쉬 값을 비교합니다.
        // 데이터베이스에 저장된 비밀번호가 해쉬 값이라고 가정합니다.
        if(password_verify($pw, $row["password"])) {
            $_SESSION['loggedin'] = true;
            $_SESSION['id'] = $id;
            echo "<script>location='/index.php';</script>";
            
        } else {
            echo "<script>alert('Wrong password');location='/login.php';</script>";
        }
    } else {
        echo "<script>alert('Invalid user ID');location='/login.php';</script>";
    }

    $stmt->close();
    exit();
?>