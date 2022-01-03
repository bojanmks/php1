<?php
    session_start();
    include("../../connection/connection.php");
    include("../../functions.php");
    redirectTo404();
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        $id = $_POST['id'];
        if($_SESSION['user']->id == $id) {
            http_response_code(409);
            echo("You can't delete your own account.");
        } else {
            if(!userExists($id, 'id')) {
                http_response_code(409);
                echo("User doesn't exist.");
            } else {
                if(delete('users', 'id', $id)) {
                    if(exists('survey', 'user_id', $id)) {
                        delete('survey', 'user_id', $id);
                    }
                    if(exists('contactmessages', 'user_id', $id)) {
                        setNull('contactmessages', 'user_id', $id);
                    }
                    if(exists('orders', 'user_id', $id)) {
                        setNull('orders', 'user_id', $id);
                    }
                    http_response_code(200);
                    echo(true);
                } else {
                    http_response_code(500);
                    echo("Error.");
                }
            }
        }
    } else {
        http_response_code(400);
    }
?>