<?php
    $host = "localhost";
    $dbUser = "root";   
    $dbPw = "root";   
    $dbName = "board";

    $options = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => false,
    );
    try {
        $pdo = new PDO('mysql:host='. $host .';dbname='. $dbName .';charset=utf8', $dbUser, $dbPw, $options);
    } catch (PDOException $e) {
        die("Database connection failed: " . $e->getMessage());
    }
?>