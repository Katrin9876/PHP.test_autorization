<?php
try {
    // подключаемся к серверу
    $HOSTNAME='localhost';
    $USERNAME='root';
    $PASSWORD='SQLtest2';
    $DATABASE='usersdb';
    $conn = new PDO("mysql:host=$HOSTNAME; dbname=$DATABASE", $USERNAME, $PASSWORD);
    //$conn = new PDO("mysql:host=localhost; dbname=usersdb", "root", "SQLtest2");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    }


catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    }

?>