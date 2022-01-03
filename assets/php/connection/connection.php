<?php
    include("login.ini");
    try {
        $connection = new PDO("$driver:host=$host;dbname=$db;charset=utf8", $username, $password);
    } catch (PDOException $ex) {
        echo("Connection error: " . $ex->getMessage());
    }
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
?>