<?php
    include("../connection/connection.php");
    include("../functions.php");
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email'];
        $name = $_POST['name'];
        $message =  $_POST['message'];

        // regular expressions
        $regExpName = "/^[A-ZŠĐČĆŽ][a-zšđčćž]{2,}(\s[A-ZŠĐČĆŽ][a-zšđčćž]{2,})*$/";
        $regExpEmail = "/^[a-z][a-z0-9\-_\.]{2,}@([a-z0-9\-_]{2,}\.)+[a-z]{2,}$/";

        // validation
        $noErrors = true;
        if(!preg_match($regExpEmail, $email)) $noErrors = false;
        if(!preg_match($regExpName, $name)) $noErrors = false;
        $numberOfSpaces = substr_count($message, ' ');
        if(strlen($message) - $numberOfSpaces < 20 || strlen($message) > 500) $noErrors = false;

        // result
        if($noErrors) {
            if(addContactMessage($email, $name, $message)) {
                http_response_code(200);
                $response = ["response"=>'Sent! Expect an answer from one of our agents soon.'];
                header("Content-type: application/json");
                echo(json_encode($response));
            } else {
                http_response_code(500);
                echo("Error.");
            }
        } else {
            http_response_code(400);
        }
    } else {
        http_response_code(400);
    }
?>