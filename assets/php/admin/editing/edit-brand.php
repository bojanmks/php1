<?php
    session_start();
    include("../../connection/connection.php");
    include("../../functions.php");
    redirectTo404();
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        $id = $_POST['id'];
        $name = $_POST['name'];

        // regular expressions
        $regExpBrand = "/^[A-Za-z\s]+$/";

        // form validation
        $noErrors = true;
        if(!exists('brands', 'id', $id)) {
            $noErrors = false;
            http_response_code(404);
            echo("Selected brand doesn't exist.");
            die;
        }
        if(!preg_match($regExpBrand, $name)) $noErrors = false;
        if($noErrors) {
            $alreadyExists = false;
            $errorMessage = '';
            if(exists('brands', 'name', $name) && getBrandById($id)->name != $name) {
                $alreadyExists = true;
                $errorMessage .= "That brand already exists.";
            }
            if($alreadyExists) {
                http_response_code(409);
                echo($errorMessage);
            } else {
                if(updateBrand($id, $name)) {
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