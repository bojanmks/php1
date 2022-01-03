<?php
    session_start();
    include("../../../connection/connection.php");
    include("../../../functions.php");
    redirectTo404();

    $id = $_POST['id'];
    $order = getOrderById($id);

    $html = "<div class='addForm'><h3 class='font-large'>Edit order</h3><form>";

    // Buyer name
    $html .= "<div class='formGroup'>
    <label for='tbEditOrderBuyerName'>Buyer name:</label>
    <input type='text' autocomplete='off' name='tbEditOrderBuyerName' id='tbEditOrderBuyerName' class='font-small textField' value='$order->buyer_name'/>
    <label class='errorMessage font-small'><ul><li>- A name cannot have less than 3 characters</li><li>- Has to be at least 2 words</li><li>- Each word must be capitalized</li></ul></label>
    </div>";

    // Buyer email
    $html .= "<div class='formGroup'>
    <label for='tbEditOrderBuyerEmail'>Buyer email:</label>
    <input type='text' autocomplete='off' name='tbEditOrderBuyerEmail' id='tbEditOrderBuyerEmail' class='font-small textField' value='$order->buyer_email'/>
    <label class='errorMessage font-small'>examplename@example.com</label>
    </div>";

    // Buyer address
    $html .= "<div class='formGroup'>
    <label for='tbEditOrderBuyerAddress'>Buyer address:</label>
    <input type='text' autocomplete='off' name='tbEditOrderBuyerAddress' id='tbEditOrderBuyerAddress' class='font-small textField' value='$order->buyer_address'/>
    <label class='errorMessage font-small'>[Street Name] [Home Number]/[Apartment Number]</label>
    </div>";

    // Edit button
    $html .= "<span class='textCenter'><button id='btnEditOrder' class='btnPrimary font-small'>Update order</button></span>";

    $html .= "</form></div>";

    http_response_code(200);
    $response = ["response"=>$html];
    echo(json_encode($response));
?>