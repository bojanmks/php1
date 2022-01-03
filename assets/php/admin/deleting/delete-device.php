<?php
    session_start();
    include("../../connection/connection.php");
    include("../../functions.php");
    redirectTo404();
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        $id = $_POST['id'];
        if(!exists('devices', 'device_id', $id)) {
            http_response_code(409);
            echo("Device doesn't exist.");
        } else {
            if(delete('devices', 'device_id', $id)) {
                if(exists('orderdetails', 'device_id', $id)) {
                    setNull('orderdetails', 'device_id', $id);
                }
                http_response_code(200);
                echo(true);
            } else {
                http_response_code(500);
                echo("Error.");
            }
        }
    } else {
        http_response_code(400);
    }
?>