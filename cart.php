<?php
    session_start();
    include("assets/php/connection/connection.php");
    include("assets/php/functions.php");
    userStillExists();
    if(!isset($_SESSION['user'])) {
        header('Location: 401.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Mobi Shop | Cart</title>
        <meta name="keywords" content="Mobi Shop, smartphones, cell phones, Checkout, Cart"/>
        <meta name="description" content="Mobi Shop gives you a chance to quickly and easily find the phone you want and have it delivered to your home in no time..."/>
        <?php
            include("assets/php/pages/head-content.php");
        ?>
    </head>
    <body>
        <?php
            include("assets/php/pages/header.php");
            include("assets/php/pages/survey.php");;
        ?>
        <section id="cartMain" class="bgWhite main">
            <div class="container">
                <div id="cartList" class="tableWrapper">
                    <table class="font-small table" cellspacing="0">
                        <thead>
                            <tr>
                                <td class="colDeviceName">Device name</td>
                                <td class="colPrice">Price</td>
                                <td class="colQuantity">Quantity</td>
                                <td class="colRemove"><i class="fas fa-trash"></i></td>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div id="checkout">
                    <form>
                        <div class="formGroup">
                            <label for="tbName" class="font-small">Full name:</label>
                            <input type="text" name="tbName" id="tbName" class="textField font-small" autocomplete="off"/>
                            <label class="errorMessage">
                                <ul class="font-small">
                                    <li>- A name cannot have less than 3 characters</li>
                                    <li>- Has to be at least 2 words</li>
                                    <li>- Each word must be capitalized</li>
                                </ul>
                            </label>
                        </div>
                        <div class="formGroup">
                            <label for="tbEmail" class="font-small">Email:</label>
                            <input type="email" name="tbEmail" id="tbEmail" class="textField font-small" autocomplete="off"/>
                            <label class="errorMessage font-small">examplename@example.com</label>
                        </div>
                        <div class="formGroup">
                            <label for="tbAddress" class="font-small">Address:</label>
                            <input type="text" name="tbAddress" id="tbAddress" class="textField font-small" autocomplete="off"/>
                            <label class="errorMessage font-small">[Street Name] [Home Number]/[Apartment Number]</label>
                        </div>
                    </form>
                    <br/>
                    <span id="totalPrice" class="font-small">Total Price: <span class="bold"></span></span>
                    <br/>
                    <button id="btnCheckout" class="font-small btnPrimary">Checkout</button>
                </div>
            </div>
        </section>
        <?php
            include("assets/php/pages/footer.php");
        ?>
        <script type="text/javascript" src="assets/js/cart.min.js"></script>
    </body>
</html>