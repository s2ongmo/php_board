<?php
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

    // 패스워드는 해싱해서 저장하는 것이 좋습니다.
    $hashed_pw = password_hash($pw, PASSWORD_DEFAULT);

    // SQL 쿼리 작성
    $sql = "INSERT INTO users (user_id, password, email) VALUES ('$id', '$hashed_pw', '$email')";

    // 쿼리 실행
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('New record created successfully!');location.href='/login.php'</script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // 데이터베이스 연결 종료
    mysqli_close($conn);
    
?>