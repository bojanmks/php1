<?php
    session_start();
    $_SESSION['user']->preventSurvey = true;
    if(isset($_SESSION['user']->preventSurvey)) {
        http_response_code(200);
        echo(true);
    } else {
        http_response_code(400);
        echo("Error.");
    }
?>