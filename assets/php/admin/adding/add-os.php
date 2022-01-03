<?php
    session_start();
    include("../../connection/connection.php");
    include("../../functions.php");
    redirectTo404();
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        $name = $_POST['name'];

        // regular expressions
        $regExpAddOSName = "/^[A-Za-z\s]+$/";

        // validation
        $noErrors = true;
        if(!preg_match($regExpAddOSName, $name)) $noErrors = false;

        // result
        if($noErrors) {
            $alreadyExists = false;
            $errorMessage = '';
            if(exists('operatingsystems', 'name', $name)) {
                $alreadyExists = true;
                $errorMessage .= "OS with that name already exists.";
            }
            if($alreadyExists) {
                http_response_code(409);
                echo($errorMessage);
            } else {
                if(addNewOS($name)) {
                    http_response_code(200);
                    echo(true);
                } else {
                    http_response_code(500);
                    echo("Error.");
                }
            }
        } else {
            http_response_code(400);
            echo("Invalid input.");
        }
    } else {
        http_response_code(400);
    }
?>