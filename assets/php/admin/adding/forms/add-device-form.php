<?php
    session_start();
    include("../../../connection/connection.php");
    include("../../../functions.php");
    redirectTo404();
    $html = "<div class='addForm'><h3 class='font-large'>Add new device</h3><form>";

    // Name
    $html .= "<div class='formGroup'>
    <label for='tbAddDeviceName'>Name:</label>
    <input type='text' autocomplete='off' name='tbAddDeviceName' id='tbAddDeviceName' class='font-small textField'/>
    <label class='errorMessage font-small'>Device name cannot contain special characters other than '-' and '/'</label>
    </div>";

    // Image
    $html .= "<div class='formGroup'>
    <label for='tbAddDeviceImage'>Image name:</label>
    <input type='text' autocomplete='off' name='tbAddDeviceImage' id='tbAddDeviceImage' class='font-small textField'/>
    <label class='errorMessage font-small'><ul><li>- Allowed formats: .jpg, .jpeg, .png, .gif</li><li>- Cannot contain special characters other than '-' and '_'</li></ul></label>
    </div>";

    // OS
    $html .= "<div class='formGroup'>
    <label for='ddlOS'>OS:</label>
    <select name='ddlOS' id='ddlOS' class='font-small textField'>";
    $operatingSystems = fetchAllFromDatabase('operatingsystems');
    foreach($operatingSystems as $os) {
        $html .= "<option value='$os->id'>$os->name</option>";
    }
    $html .= "</select></div>";

    // Brand
    $html .= "<div class='formGroup'>
    <label for='ddlBrand'>Brand:</label>
    <select name='ddlBrand' id='ddlBrand' class='font-small textField'>";
    $brands = fetchAllFromDatabase('brands');
    foreach($brands as $brand) {
        $html .= "<option value='$brand->id'>$brand->name</option>";
    }
    $html .= "</select></div>";

    // Price
    $html .= "<div class='formGroup'>
    <label for='tbAddDevicePrice'>Price (in Euros):</label>
    <input type='number' autocomplete='off' name='tbAddDevicePrice' id='tbAddDevicePrice' class='font-small textField'/>
    <label class='errorMessage font-small'>Has to be a number</label>
    </div>";

    // Add button
    $html .= "<span class='textCenter'><button id='btnAddDevice' class='btnPrimary font-small'>Add device</button></span>";

    $html .= "</form></div>";

    http_response_code(200);
    $response = ["response"=>$html];
    echo(json_encode($response));
?>