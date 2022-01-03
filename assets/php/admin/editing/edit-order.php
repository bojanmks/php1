<?php
    session_start();
    include("../../connection/connection.php");
    include("../../functions.php");
    redirectTo404();
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        $id = $_POST['id'];
        $buyerName = $_POST['buyerName'];
        $buyerEmail = $_POST['buyerEmail'];
        $buyerAddress = $_POST['buyerAddress'];

        // regular expressions
        $regExpName = "/^[A-ZŠĐČĆŽ][a-zšđčćž]{2,}(\s[A-ZŠĐČĆŽ][a-zšđčćž]{2,})*$/";
        $regExpEmail = "/^[a-z][a-z0-9\-_\.]{2,}@([a-z0-9\-_]{2,}\.)+[a-z]{2,}$/";
        $regExpAddress = "/^[A-ZŠĐČĆŽ][a-zšđčćž]{2,}(\s[A-ZŠĐČĆŽa-zšđčćž][a-zšđčćž]{2,})*\s\d+[A-Z]?(\/\d+)*$/";

        // form validation
        $noErrors = true;
        if(!exists('orders', 'order_id', $id)) {
            $noErrors = false;
            http_response_code(404);
            echo("Selected order doesn't exist.");
            die;
        }
        if(!preg_match($regExpName, $buyerName)) $noErrors = false;
        if(!preg_match($regExpEmail, $buyerEmail)) $noErrors = false;
        if(!preg_match($regExpAddress, $buyerAddress)) $noErrors = false;
        if($noErrors) {
            if(updateOrder($id, $buyerName, $buyerEmail, $buyerAddress)) {
                http_response_code(200);
                echo(true);
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