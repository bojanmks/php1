<?php
    session_start();
    include("../../connection/connection.php");
    include("../../functions.php");
    redirectTo404();
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        $id = $_POST['id'];
        if(!exists('contactmessages', 'message_id', $id)) {
            http_response_code(409);
            echo("Message doesn't exist.");
        } else {
            if(delete('contactmessages', 'message_id', $id)) {
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