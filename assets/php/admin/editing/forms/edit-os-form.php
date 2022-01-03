<?php
    session_start();
    include("../../../connection/connection.php");
    include("../../../functions.php");
    redirectTo404();

    $id = $_POST['id'];
    $os = getOSById($id);

    $html = "<div class='addForm'><h3 class='font-large'>Edit OS</h3><form>";

    // Name
    $html .= "<div class='formGroup'>
    <label for='tbEditOSName'>Name:</label>
    <input type='text' autocomplete='off' name='tbEditOSName' id='tbEditOSName' class='font-small textField'/ value='$os->name'>
    <label class='errorMessage font-small'>OS name cannot contain special characters or numbers.</label>
    </div>";

    // Edit button
    $html .= "<span class='textCenter'><button id='btnEditOS' class='btnPrimary font-small'>Update OS</button></span>";

    $html .= "</form></div>";

    http_response_code(200);
    $response = ["response"=>$html];
    echo(json_encode($response));
?>