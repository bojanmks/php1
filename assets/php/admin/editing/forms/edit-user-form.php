<?php
    session_start();
    include("../../../connection/connection.php");
    include("../../../functions.php");
    redirectTo404();
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        $userId = $_POST['id'];
        $user = getUserById($userId);

        $html = "<div class='addForm'><h3 class='font-large'>Edit user</h3><form>";

        // Username
        $html .= "<div class='formGroup'>
        <label for='tbEditUserUsername'>Username:</label>
        <input type='text' autocomplete='off' name='tbEditUserUsername' id='tbEditUserUsername' class='font-small textField' value='$user->username'/>
        <label class='errorMessage font-small'>Username must:<ul><li>- start with a letter</li><li>- be 5 characters or longer</li><li>- not contain special characters other than '_'</li></ul></label>
        </div>";

        // Email
        $html .= "<div class='formGroup'>
        <label for='tbEditUserEmail'>Email:</label>
        <input type='text' autocomplete='off' name='tbEditUserEmail' id='tbEditUserEmail' class='font-small textField' value='$user->email'/>
        <label class='errorMessage font-small'>examplename@example.com</label>
        </div>";

        // Password
        $html .= "<div class='formGroup'>
        <label for='tbEditUserPassword'>Password:</label>
        <input type='text' autocomplete='off' name='tbEditUserPassword' id='tbEditUserPassword' class='font-small textField' disabled/>
        <label class='errorMessage font-small'>Password must:<ul>
        <li>- contain 1 lowercase letter</li>
        <li>- contain 1 uppercase letter</li>
        <li>- contain 1 number</li>
        <li>- contain 1 special character</li>
        <li>- be 8 characters or longer</li>
        </ul></label>
        <div class='checkboxGroup'><input type='checkbox' id='chbChangePassword' name='chbChangePassword'/><label for='chbChangePassword' class='font-small'>Change password</label></div>
        </div>";

        // Role
        $html .= "<div class='formGroup'>
        <label for='ddlEditRole'>Role:</label>
        <select name='ddlEditRole' id='ddlEditRole' class='font-small textField'>";
        $roles = fetchAllFromDatabase('roles');
        foreach($roles as $role) {
            $html .= "<option value='$role->id'>$role->name</option>";
        }
        $html .= "</select></div>";

        // Active
        $html .= "<div class='formGroup'>
        <label for='ddlEditActive'>Active:</label>
        <select name='ddlEditActive' id='ddlEditActive' class='font-small textField'><option value='0'>0</option><option value='1'>1</option></select></div>";

        // Edit button
        $html .= "<span class='textCenter'><button id='btnEditUser' class='btnPrimary font-small'>Update user</button></span>";

        $html .= "</form></div>";

        http_response_code(200);
        $response = ["response"=>$html];
        echo(json_encode($response));
    } else {
        http_response_code(400);
    }
?>