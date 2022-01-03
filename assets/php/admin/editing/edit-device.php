<?php
    session_start();
    include("../../connection/connection.php");
    include("../../functions.php");
    redirectTo404();
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $image = $_POST['image'];
        $os = $_POST['os'];
        $brand = $_POST['brand'];
        $price = $_POST['price'];
        $active = $_POST['active'];

        // regular expressions
        $regExpName = "/^[A-Za-z0-9\/\-\s]+$/";
        $regExpImage = "/^[\w\-]+(\.jpg|\.jpeg|\.png|\.gif)$/";
        $regExpPrice = "/^[0-9]+$/";

        // form validation
        $noErrors = true;
        if(!exists('devices', 'device_id', $id)) {
            $noErrors = false;
            http_response_code(404);
            echo("Selected device doesn't exist.");
            die;
        }
        if(!preg_match($regExpName, $name)) $noErrors = false;
        if(!preg_match($regExpImage, $image)) $noErrors = false;
        if(!preg_match($regExpPrice, $price)) $noErrors = false;
        if(!exists('brands', 'id', $brand)) {
            $noErrors = false;
            http_response_code(404);
            echo("Selected brand doesn't exist.");
            die;
        }
        if(!exists('operatingsystems', 'id', $os)) {
            $noErrors = false;
            http_response_code(404);
            echo("Selected OS doesn't exist.");
            die;
        }
        if($active != 1 && $active != 0) $noErrors = false;
        if($noErrors) {
            $alreadyExists = false;
            $errorMessage = '';
            if(exists('devices', 'name', $name) && getDeviceById($id)->name != $name) {
                $alreadyExists = true;
                $errorMessage .= "That device already exists.";
            }
            if($alreadyExists) {
                http_response_code(409);
                echo($errorMessage);
            } else {
                if(updateDevice($id, $name, $image, $os, $brand, $price, $active)) {
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