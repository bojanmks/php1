<?php
    session_start();
    include("../../connection/connection.php");
    include("../../functions.php");
    redirectTo404();
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        $id = $_POST['id'];
        $name = $_POST['name'];

        // regular expressions
        $regExpOS = "/^[A-Za-z\s]+$/";

        // form validation
        $noErrors = true;
        if(!exists('operatingsystems', 'id', $id)) {
            $noErrors = false;
            http_response_code(404);
            echo("Selected OS doesn't exist.");
            die;
        }
        if(!preg_match($regExpOS, $name)) $noErrors = false;
        if($noErrors) {
            $alreadyExists = false;
            $errorMessage = '';
            if(exists('operatingsystems', 'name', $name) && getOSById($id)->name != $name) {
                $alreadyExists = true;
                $errorMessage .= "That OS already exists.";
            }
            if($alreadyExists) {
                http_response_code(409);
                echo($errorMessage);
            } else {
                if(updateOS($id, $name)) {
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
    } else {
        http_response_code(400);
    }
?>