<?php
    session_start();
    if(!isset($_SESSION['user'])) {
        http_response_code(403);
        echo("You need to be logged in to access your cart.");
    } else {
        http_response_code(200);
        echo(true);
    }
?>