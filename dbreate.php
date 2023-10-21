<?php
try {
    // подключаемся к серверу
    $HOSTNAME='localhost';
    $USERNAME='root';
    $PASSWORD='SQLtest2';
    $conn = new PDO("mysql:host=$HOSTNAME", $USERNAME, $PASSWORD);
    //$conn = new PDO("mysql:host=localhost; dbname=usersdb", "root", "SQLtest2");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    
    $sql="CREATE DATABASE usersdb1;";
    $conn->exec($sql);
    $sql="USE usersdb1;";
    $conn->exec($sql);
    $sql="CREATE TABLE `registration` (
        id INT PRIMARY KEY AUTO_INCREMENT, 
        username VARCHAR(50) UNIQUE,
        password VARCHAR(30)
    );";
    $conn->exec($sql);

    }


catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    }

?>