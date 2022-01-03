<?php
    session_start();
    include("../../../connection/connection.php");
    include("../../../functions.php");
    redirectTo404();

    $deviceId = $_POST['id'];
    $device = getDeviceById($deviceId);

    $html = "<div class='addForm'><h3 class='font-large'>Edit device</h3><form>";

    // Name
    $html .= "<div class='formGroup'>
    <label for='tbEditDeviceName'>Name:</label>
    <input type='text' autocomplete='off' name='tbEditDeviceName' id='tbEditDeviceName' class='font-small textField' value='$device->name'/>
    <label class='errorMessage font-small'>Device name cannot contain special characters other than '-' and '/'</label>
    </div>";

    // Image
    $html .= "<div class='formGroup'>
    <label for='tbEditDeviceImage'>Image name:</label>
    <input type='text' autocomplete='off' name='tbEditDeviceImage' id='tbEditDeviceImage' class='font-small textField' value='$device->image'/>
    <label class='errorMessage font-small'><ul><li>- Allowed formats: .jpg, .jpeg, .png, .gif</li><li>- Cannot contain special characters other than '-' and '_'</li></ul></label>
    </div>";

    // OS
    $html .= "<div class='formGroup'>
    <label for='ddlEditOS'>OS:</label>
    <select name='ddlEditOS' id='ddlEditOS' class='font-small textField'>";
    $operatingSystems = fetchAllFromDatabase('operatingsystems');
    foreach($operatingSystems as $os) {
        $html .= "<option value='$os->id'>$os->name</option>";
    }
    $html .= "</select></div>";

    // Brand
    $html .= "<div class='formGroup'>
    <label for='ddlEditBrand'>Brand:</label>
    <select name='ddlEditBrand' id='ddlEditBrand' class='font-small textField'>";
    $brands = fetchAllFromDatabase('brands');
    foreach($brands as $brand) {
        $html .= "<option value='$brand->id'>$brand->name</option>";
    }
    $html .= "</select></div>";

    // Price
    $html .= "<div class='formGroup'>
    <label for='tbEditDevicePrice'>Price (in Euros):</label>
    <input type='number' autocomplete='off' name='tbEditDevicePrice' id='tbEditDevicePrice' class='font-small textField' value='$device->price'/>
    <label class='errorMessage font-small'>Has to be a number</label>
    </div>";

    // Active
    $html .= "<div class='formGroup'>
    <label for='ddlEditDeviceActive'>Active:</label>
    <select name='ddlEditDeviceActive' id='ddlEditDeviceActive' class='font-small textField'><option value='0'>0</option><option value='1'>1</option></select></div>";

    // Edit button
    $html .= "<span class='textCenter'><button id='btnEditDevice' class='btnPrimary font-small'>Update device</button></span>";

    $html .= "</form></div>";

    http_response_code(200);
    $response = ["response"=>$html];
    echo(json_encode($response));
?>