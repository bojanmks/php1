<?php
    session_start();
    include("../../connection/connection.php");
    include("../../functions.php");
    redirectTo404();
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        $name = $_POST['name'];
        $image = $_POST['image'];
        $os = $_POST['os'];
        $brand = $_POST['brand'];
        $price = $_POST['price'];

        // regular expressions
        $regExpAddDeviceName = "/^[A-Za-z0-9\/\-\s]+$/";
        $regExpAddDeviceImage = "/^[\w\-]+(\.jpg|\.jpeg|\.png|\.gif)$/";
        $regExpAddDevicePrice = "/^[0-9]+$/";

        // validation
        $noErrors = true;
        if(!preg_match($regExpAddDeviceName, $name)) $noErrors = false;
        if(!preg_match($regExpAddDeviceImage, $image)) $noErrors = false;
        if(!preg_match($regExpAddDevicePrice, $price)) $noErrors = false;
        if(!exists('operatingsystems', 'id', $os)) {
            $noErrors = false;
            http_response_code(409);
            echo("Selected OS doesn't exist.");
            die;
        }
        if(!exists('brands', 'id', $brand)) {
            $noErrors = false;
            http_response_code(409);
            echo("Selected brand doesn't exist.");
            die;
        }

        // result
        if($noErrors) {
            $alreadyExists = false;
            $errorMessage = '';
            if(exists('devices', 'name', $name)) {
                $alreadyExists = true;
                $errorMessage .= "Device with that name already exists.";
            }
            if($alreadyExists) {
                http_response_code(409);
                echo($errorMessage);
            } else {
                if(addNewDevice($name, $image, $os, $brand, $price)) {
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