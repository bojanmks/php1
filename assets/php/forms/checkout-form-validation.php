<?php
    include("../connection/connection.php");
    include("../functions.php");
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $address =  $_POST['address'];
        $totalPrice = $_POST['totalPrice'];
        $details = $_POST['details'];

        // regular expressions
        $regExpName = "/^[A-ZŠĐČĆŽ][a-zšđčćž]{2,}(\s[A-ZŠĐČĆŽ][a-zšđčćž]{2,})*$/";
        $regExpEmail = "/^[a-z][a-z0-9\-_\.]{2,}@([a-z0-9\-_]{2,}\.)+[a-z]{2,}$/";
        $regExpAddress = "/^[A-ZŠĐČĆŽ][a-zšđčćž]{2,}(\s[A-ZŠĐČĆŽa-zšđčćž][a-zšđčćž]{2,})*\s\d+[A-Z]?(\/\d+)*$/";

        // validation
        $noErrors = true;
        if(!preg_match($regExpEmail, $email)) $noErrors = false;
        if(!preg_match($regExpName, $name)) $noErrors = false;
        if(!preg_match($regExpAddress, $address)) $noErrors = false;

        // result
        if($noErrors) {
            if(checkout($name, $email, $address, $totalPrice, $details)) {
                http_response_code(200);
                $response = ["response"=>'Success! We will reach out to you in the next couple of days to confirm the provided information.'];
                echo(json_encode($response));
            } else {
                http_response_code(500);
                echo("Error");
            }
        } else {
            http_response_code(400);
        }
    } else {
        http_response_code(400);
    }
?>