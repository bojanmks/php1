<?php
    session_start();
    include("../../../connection/connection.php");
    include("../../../functions.php");
    redirectTo404();
    $html = "<div class='addForm'><h3 class='font-large'>Add new user</h3><form>";

    // Username
    $html .= "<div class='formGroup'>
    <label for='tbAddUserUsername'>Username:</label>
    <input type='text' autocomplete='off' name='tbAddUserUsername' id='tbAddUserUsername' class='font-small textField'/>
    <label class='errorMessage font-small'>Username must:<ul><li>- start with a letter</li><li>- be 5 characters or longer</li><li>- not contain special characters other than '_'</li></ul></label>
    </div>";

    // Email
    $html .= "<div class='formGroup'>
    <label for='tbAddUserEmail'>Email:</label>
    <input type='text' autocomplete='off' name='tbAddUserEmail' id='tbAddUserEmail' class='font-small textField'/>
    <label class='errorMessage font-small'>examplename@example.com</label>
    </div>";

    // Password
    $html .= "<div class='formGroup'>
    <label for='tbAddUserPassword'>Password:</label>
    <input type='text' autocomplete='off' name='tbAddUserPassword' id='tbAddUserPassword' class='font-small textField'/>
    <label class='errorMessage font-small'>Password must:<ul>
    <li>- contain 1 lowercase letter</li>
    <li>- contain 1 uppercase letter</li>
    <li>- contain 1 number</li>
    <li>- contain 1 special character</li>
    <li>- be 8 characters or longer</li>
    </ul></label>
    </div>";

    // Role
    $html .= "<div class='formGroup'>
    <label for='ddlRole'>Role:</label>
    <select name='ddlRole' id='ddlRole' class='font-small textField'>";
    $roles = fetchAllFromDatabase('roles');
    foreach($roles as $role) {
        $html .= "<option value='$role->id'>$role->name</option>";
    }
    $html .= "</select></div>";

    // Add button
    $html .= "<span class='textCenter'><button id='btnAddUser' class='btnPrimary font-small'>Add user</button></span>";

    $html .= "</form></div>";

    http_response_code(200);
    $response = ["response"=>$html];
    echo(json_encode($response));
?>