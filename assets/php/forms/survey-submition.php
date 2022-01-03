<?php
    session_start();
    include("../connection/connection.php");
    include("../functions.php");
    $rating = $_GET['rating'];
    if(isset($rating)) {
        if(!surveyAlreadyCompleted($_SESSION['user']->id)) {
            $result = addSurveyAnswer($_SESSION['user']->id, $rating);
            if($result) {
                http_response_code(200);
                echo(true);
            } else {
                http_response_code(500);
                echo("Error.");
            }
        } else {
            http_response_code(409);
            echo("You already completed this survey.");
        }
    } else {
        http_response_code(400);
    }
?>