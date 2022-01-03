<?php
    session_start();
    include("assets/php/connection/connection.php");
    include("assets/php/functions.php");
    userStillExists();
    redirectTo404();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Mobi Shop | Admin panel</title>
        <?php
            include("assets/php/pages/head-content.php");
        ?>
    </head>
    <body>
        <?php
            include("assets/php/pages/admin-header.php");
        ?>
        <div id="adminMain">
            <div class="container">
            </div>
        </div>
        <?php
            include("assets/php/pages/scripts.php");
        ?>
        <script type="text/javascript" src="assets/js/admin.min.js"></script>
    </body>
</html>