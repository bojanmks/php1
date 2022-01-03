<?php
    session_start();
    include("../../connection/connection.php");
    include("../../functions.php");
    redirectTo404();
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        $id = $_POST['id'];
        if(!exists('orders', 'order_id', $id)) {
            http_response_code(409);
            echo("Order doesn't exist.");
        } else {
            if(delete('orders', 'order_id', $id)) {
                if(exists('orderdetails', 'order_id', $id)) {
                    delete('orderdetails', 'order_id', $id);
                }
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
?>