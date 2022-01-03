<?php
    session_start();
    include("../../connection/connection.php");
    include("../../functions.php");
    redirectTo404();
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        $id = $_POST['id'];
        if(!exists('operatingsystems', 'id', $id)) {
            http_response_code(409);
            echo("Operating system doesn't exist.");
        } else {
            if(delete('operatingsystems', 'id', $id)) {
                if(exists('devices', 'os', $id)) {
                    setNull('devices', 'os', $id);
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