<?php
    session_start();
    include("../../../connection/connection.php");
    include("../../../functions.php");
    redirectTo404();

    $id = $_POST['id'];
    $brand = getBrandById($id);

    $html = "<div class='addForm'><h3 class='font-large'>Edit brand</h3><form>";

    // Name
    $html .= "<div class='formGroup'>
    <label for='tbEditBrandName'>Name:</label>
    <input type='text' autocomplete='off' name='tbEditBrandName' id='tbEditBrandName' class='font-small textField' value='$brand->name'/>
    <label class='errorMessage font-small'>Brand name cannot contain special characters or numbers.</label>
    </div>";

    // Edit button
    $html .= "<span class='textCenter'><button id='btnEditBrand' class='btnPrimary font-small'>Update brand</button></span>";

    $html .= "</form></div>";

    http_response_code(200);
    $response = ["response"=>$html];
    echo(json_encode($response));
?>