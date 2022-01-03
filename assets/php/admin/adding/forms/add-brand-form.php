<?php
    session_start();
    include("../../../connection/connection.php");
    include("../../../functions.php");
    redirectTo404();
    $html = "<div class='addForm'><h3 class='font-large'>Add new brand</h3><form>";

    // Name
    $html .= "<div class='formGroup'>
    <label for='tbAddBrandName'>Name:</label>
    <input type='text' autocomplete='off' name='tbAddBrandName' id='tbAddBrandName' class='font-small textField'/>
    <label class='errorMessage font-small'>Brand name cannot contain special characters or numbers.</label>
    </div>";

    // Add button
    $html .= "<span class='textCenter'><button id='btnAddBrand' class='btnPrimary font-small'>Add brand</button></span>";

    $html .= "</form></div>";

    http_response_code(200);
    $response = ["response"=>$html];
    echo(json_encode($response));
?>