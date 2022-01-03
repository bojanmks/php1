<?php
    include('connection/connection.php');
    include('functions.php');
    if(isset($_GET['deviceId'])) {
        $deviceId = $_GET['deviceId'];
        $deviceObj = fetchFromDatabase("SELECT * FROM devices WHERE device_id = $deviceId");
        $device = (array)$deviceObj[0];
        $deviceName = $device["name"];
        $devicePrice = $device["price"];
        $result = ["id"=>$deviceId, "name"=>$deviceName, "price"=>$devicePrice];
        header('Content-type: application/json');
        echo(json_encode($result));
        http_response_code(200);
    } else {
        http_response_code(400);
    }
?>