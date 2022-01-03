<?php
    include("connection/connection.php");
    include("functions.php");
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        $id = $_POST['id'];
        if(userExists($id, 'id')) {
            $user = getUserById($id);
            header("Content-type: application/json");
            echo(json_encode($user));
        } else {
            http_response_code(404);
            echo("User doesn't exist.");
        }
    } else {
        http_response_code(400);
    }
?>