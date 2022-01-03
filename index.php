<?php
    session_start();
    include("assets/php/connection/connection.php");
    include("assets/php/functions.php");
    userStillExists();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Mobi Shop | Home</title>
        <meta name="keywords" content="Mobi Shop, smartphones, cell phones, Shop, Home"/>
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
        <section id="slider">
            <div class="cover">
                <div class="container">
                    <div id="sliderText">
                        <h2 class="font-xxl">All New Phones</h2>
                        <p class="font-medium">Special deals on the latest cell phones and smartphones. Stay connected in style, we've got you covered.</p>
                        <a href="devices.php" class="font-small">Shop now</a>
                    </div>
                </div>
            </div>
            <?php
                printSliderImages();
            ?>
        </section>
        <section id="aboutUs" class="bgWhite">
            <div class="container">
                <div id="aboutUsImage">
                    <img src="assets/img/aboutUsImage.png" alt="Image of a phone"/>
                </div>
                <div id="aboutUsText">
                    <h3 class="font-large">About Us</h3>
                    <h4 class="font-xxl">Mobi Shop</h4>
                    <p class="font-small">Mobi Shop gives you a chance to quickly and easily find the phone you want and have it delivered to your home in no time, regardless of your location, as long as it is in one of the countries of the EU.</p>
                    <br/>
                    <p class="font-small">We have been in the business for quite a while now, and it that time we have not only managed to make close relationships with numerous suppliers all over the world, but also to recognize what people need.</p>
                </div>
            </div>
        </section>
        <?php
            include("assets/php/pages/footer.php");
        ?>
        <script type="text/javascript" src="assets/js/home.min.js"></script>
    </body>
</html>