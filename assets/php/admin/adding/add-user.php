<?php
    session_start();
    include("../../connection/connection.php");
    include("../../functions.php");
    redirectTo404();
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $role = $_POST['role'];

        // regular expressions
        $regExpUsername = "/^[a-zA-Z]\w{4,}$/";
        $regExpEmail = "/^[a-z][a-z0-9\-_\.]{2,}@([a-z0-9\-_]{2,}\.)+[a-z]{2,}$/";
        $regExpPassword = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/";

        // validation
        $noErrors = true;
        if(!preg_match($regExpUsername, $username)) $noErrors = false;
        if(!preg_match($regExpEmail, $email)) $noErrors = false;
        if(!preg_match($regExpPassword, $password)) $noErrors = false;
        if(!exists('roles', 'id', $role)) {
            $noErrors = false;
            http_response_code(409);
            echo("Selected role doesn't exist.");
            die;
        }

        // result
        if($noErrors) {
            $alreadyExists = false;
            $errorMessage = '';
            if(userExists($email, 'email')) {
                $alreadyExists = true;
                $errorMessage .= "- That email is already in use.<br/>";
            }
            if(userExists($username, 'username')) {
                $alreadyExists = true;
                $errorMessage .= "- That username is already in use.<br/>";
            }
            if($alreadyExists) {
                http_response_code(409);
                echo($errorMessage);
            } else {
                if(adminAddNewUser($username, $email, $password, $role)) {
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