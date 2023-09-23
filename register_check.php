<?php
    session_start();

    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true){
        header("Location: index.php");
        exit();
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

    // POST로 받은 데이터 가져오기
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $pw = mysqli_real_escape_string($conn, $_POST['pw']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    // 이메일 양식 체크
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email address.');location='/register.php';</script>";
        $conn->close();
        exit();
    }

    // 패스워드는 해싱해서 저장하는 것이 좋습니다.
    $hashed_pw = password_hash($pw, PASSWORD_DEFAULT);

    // 아이디, 이메일 중복 체크
    $stmt = $conn->prepare("SELECT user_id, email FROM users WHERE user_id = ? OR email = ?");
    $stmt->bind_param("ss", $id, $email);
    
    $stmt->execute();
    $result = $stmt->get_result();
    
    while($row = $result->fetch_assoc()) {
        if($row['user_id'] == $id) {
            echo "<script>
                alert('ID already in use.');
                location='/register.php';
                </script>";
            $stmt->close();
            exit();
        } elseif($row['email'] == $email) {
            echo "<script>
                alert('Email address already in use.');
                location='/register.php';
                </script>";
            $stmt->close();
            exit();
        }
    }
    $stmt->close();
    
    // 쿼리 준비 (플레이스홀더 사용)
    $stmt = $conn->prepare("INSERT INTO users (user_id, password, email) VALUES (?, ?, ?)");

    // 플레이스홀더에 변수 바인드
    $stmt->bind_param("sss", $id, $hashed_pw, $email); // sss는 각 변수의 데이터 타입을 나타냅니다. 여기서는 모두 문자열이므로 's'를 사용했습니다.

    // 쿼리 실행
    $stmt->execute();

    // 결과 확인 및 종료
    if ($stmt->affected_rows > 0) {
        echo "<script>alert('New record created successfully!');location='/login.php'</script>";
    } else {
        echo "<script>alert('Error!');location='/register.php';</script>";
    }

    $stmt->close();
    // 데이터베이스 연결 종료
    $conn->close();
    
?>