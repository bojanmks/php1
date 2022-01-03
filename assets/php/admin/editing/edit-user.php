<?php
    session_start();
    include("../../connection/connection.php");
    include("../../functions.php");
    redirectTo404();
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        $id = $_POST['id'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $changePassword = $_POST['changePassword'];
        $role = $_POST['role'];
        $active = $_POST['active'];

        // regular expressions
        $regExpUsername = "/^[a-zA-Z]\w{4,}$/";
        $regExpEmail = "/^[a-z][a-z0-9-_\.]{2,}@([a-z0-9-_]{2,}\.)+[a-z]{2,}$/";
        $regExpPassword = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/";

        // form validation
        $noErrors = true;
        if(!exists('users', 'id', $id)) {
            $noErrors = false;
            http_response_code(404);
            echo("Selected user doesn't exist.");
            die;
        }
        if(!preg_match($regExpUsername, $username)) $noErrors = false;
        if(!preg_match($regExpEmail, $email)) $noErrors = false;
        if($changePassword) {
            if(!preg_match($regExpPassword, $password)) $noErrors = false;
        }
        if(!exists('roles', 'id', $role)) {
            $noErrors = false;
            http_response_code(404);
            echo("Selected role doesn't exist.");
            die;
        }
        if($active != 1 && $active != 0) $noErrors = false;
        if($noErrors) {
            $alreadyExists = false;
            $errorMessage = '';
            if(userExists($email, 'email') && getUserById($id)->email != $email) {
                $alreadyExists = true;
                $errorMessage .= "- That email is already in use.<br/>";
            }
            if(userExists($username, 'username') && getUserById($id)->username != $username) {
                $alreadyExists = true;
                $errorMessage .= "- That username is already in use.<br/>";
            }
            if($alreadyExists) {
                http_response_code(409);
                echo($errorMessage);
            } else {
                if($changePassword) {
                    if(updateUser($id, $username, $email, $password, $role, $active)) {
                        http_response_code(200);
                        echo(true);
                    } else {
                        http_response_code(500);
                        echo("Error.");
                    }
                } else {
                    if(updateUserNoPassword($id, $username, $email, $role, $active)) {
                        http_response_code(200);
                        echo(true);
                    } else {
                        http_response_code(500);
                        echo("Error.");
                    }
                }
            }
        } else {
            http_response_code(409);
            var_dump($changePassword);
        }
    } else {
        http_response_code(400);
    }
?>