<?php
    session_start();
    include("assets/php/connection/connection.php");
    include("assets/php/functions.php");
    userStillExists();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Mobi Shop | Contact</title>
        <meta name="keywords" content="Mobi Shop, smartphones, cell phones, Form, Contact"/>
        <meta name="description" content="If you wish to reach out to us, you can do so via social media, the information listed below, or by filling out the contact form."/>
        <?php
            include("assets/php/pages/head-content.php");
        ?>
    </head>
    <body>
        <?php
            include("assets/php/pages/header.php");
            include("assets/php/pages/survey.php");
        ?>
        <section id="contactMain" class="bgWhite main">
            <div class="heading">
                <h2 class="font-xl">Contact</h2>
                <span class="underline"></span>
            </div>
            <div class="container">
                <div id="contactText" class="contactCol">
                    <p class="font-small">If you wish to reach out to us, you can do so via social media, the information listed below, or by filling out the contact form.</p>
                    <ul>
                        <li class="font-small">
                            <i class="fas fa-phone"></i>
                            <span>+381 60/123-4567</span>
                        </li>
                        <li class="font-small">
                            <i class="fas fa-envelope"></i>
                            <span>bojan.maxim075@gmail.com</span>
                        </li>
                    </ul>
                </div>
                <div id="contactForm" class="contactCol">
                    <div class="heading">
                        <h2 class="font-large">Contact form</h2>
                    </div>
                    <form>
                        <div class="formGroup">
                            <label for="tbEmail" class="font-small">Email:</label>
                            <input type="email" name="tbEmail" id="tbEmail" class="font-small textField" autocomplete="off"/>
                            <label class="errorMessage font-small">examplename@example.com</label>
                        </div>
                        <div class="formGroup">
                            <label for="tbName" class="font-small">Name:</label>
                            <input type="text" name="tbName" id="tbName" class="font-small textField" autocomplete="off"/>
                            <label class="errorMessage font-small">
                                <ul>
                                    <li>- A name cannot have less than 3 characters</li>
                                    <li>- Each word of your name must be capitalized</li>
                                </ul>
                            </label>
                        </div>
                        <div class="formGroup">
                            <label for="tbMessage" class="font-small">Message:</label>
                            <textarea name="tbMessage" id="tbMessage" cols="30" rows="10" class="font-small textField" maxlength="500"></textarea>
                            <label class="errorMessage font-small">Your message (without spacing characters) cannot be shorter than 20 characters or longer than 500 characters in total.</label>
                        </div>
                        <span class="textCenter">
                            <button name="btnSend" id="btnSend" class="btnPrimary">
                                <i class="fas fa-paper-plane font-small"></i>
                            </button>
                        </span>
                    </form>
                </div>
            </div>
        </section>
        <?php
            include("assets/php/pages/footer.php");
        ?>
        <script type="text/javascript" src="assets/js/contact.min.js"></script>
    </body>
</html>
