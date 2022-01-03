<?php
    session_start();
    include("assets/php/connection/connection.php");
    include("assets/php/functions.php");
    userStillExists();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Mobi Shop | Devices</title>
        <meta name="keywords" content="Mobi Shop, smartphones, Android, iOS, Devices"/>
        <meta name="description" content="Mobi Shop gives you a chance to quickly and easily find the phone you want and have it delivered to your home in no time..."/>
        <?php
            include("assets/php/pages/head-content.php");
        ?>
    </head>
    <body>
        <?php
            include("assets/php/pages/header.php");
            include("assets/php/pages/survey.php");
        ?>
        <section id="devicesMain" class="bgWhite main">
            <div class="container">
                <div id="filters">
                    <form>
                        <div class="formGroup">
                            <input type="text" name="tbSearch" id="tbSearch" class="font-small textField" placeholder="Search" autocomplete="off"/>
                        </div>
                        <div class="formGroup">
                            <select name="ddlOrder" id="ddlOrder" class="textField font-small filterAction">
                                <option value="0">Sort order</option>
                                <option value="nameAZ">Name A-Z</option>
                                <option value="nameZA">Name Z-A</option>
                                <option value="priceASC">Price Ascending</option>
                                <option value="priceDESC">Price Descending</option>
                            </select>
                        </div>
                        <div id="chbGroups">
                            <?php
                                printChbGroup('OS', 'operatingsystems');
                                printChbGroup('Brand', 'brands');
                            ?>
                        </div>
                        <div class="formGroup">
                            <input type="range" name="rnPrice" id="rnPrice" min="0" max="2000" value="2000" class="filterAction"/>
                            <label id="priceRange" class="font-small"></label>
                        </div>
                    </form>
                </div>
                <div id="devicesContainer">
                </div>
            </div>
        </section>
        <?php
            include("assets/php/pages/footer.php");
        ?>
        <script type="text/javascript" src="assets/js/devices.min.js"></script>
    </body>
</html>