<?php
    include("connection/connection.php");
    include("functions.php");
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        $id = $_POST['id'];
        if(exists('devices', 'device_id', $id)) {
            $device = getDeviceById($id);
            header("Content-type: application/json");
            echo(json_encode($device));
        } else {
            http_response_code(404);
            echo("Device doesn't exist.");
        }
    } else {
        http_response_code(400);
    }
?>