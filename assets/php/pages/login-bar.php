<?php
    $html = "<div id='loginBar'><div class='container'><ul>";
    if(!isset($_SESSION['user'])) {
        $html .= "<li><a href='#' id='btnLogin' class='btnLogin font-xs'>Log in</a></li><li><a href='#' id='btnRegister' class='btnLogin font-xs'>Register</a></li>";
    } else {
        $user = $_SESSION['user'];
        if(getRoleName($user->role) == 'admin') {
            if(strpos($_SERVER['REQUEST_URI'], "admin.php")) {
                $html .= "<li><a href='index.php' class='font-xs' id='btnAdmin'>Return to site</a></li>";
            } else {
                $html .= "<li><a href='admin.php' class='font-xs' id='btnAdmin'>Admin panel</a></li>";
            }
        }
        $userUsername = $user->username;
        $html .= "<li><label class='font-xs bold'>Welcome $userUsername!</label></li><li><a href='assets/php/pages/logout.php' id='btnLogout' class='font-xs'>Log out</a></li>";
    }
    $html .= "</ul></div></div>";
    echo($html);
?>