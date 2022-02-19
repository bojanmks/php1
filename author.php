<?php
    session_start();
    include("assets/php/connection/connection.php");
    include("assets/php/functions.php");
    userStillExists();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Mobi Shop | Author</title>
        <meta name="keywords" content="Mobi Shop, smartphones, cell phones, Portfolio, Author"/>
        <meta name="description" content="My name is Bojan and I am an aspiring front-end web developer. My approach to website design is to create a website..."/>
        <?php
            include("assets/php/pages/head-content.php");
        ?>
    </head>
    <body>
        <?php
            include("assets/php/pages/header.php");
            include("assets/php/pages/survey.php");
        ?>
        <section id="authorMain" class="bgWhite main">
            <div class="heading">
                <h2 class="font-xl">Author</h2>
                <div class="underline"></div>
            </div>
            <div class="container">
                <div id="authorInfo" class="authorCol">
                    <div id="authorImage">
                        <img src="assets/img/author.jpg" alt="Photo of the author">
                    </div>
                    <span class="font-medium bold">Bojan Maksimović 92/19</span>
                    <span class="font-small">Web Developer</span>
                    <span id="authorSocial">
                        <ul>
                            <?php
                                printAuthorSocials();
                            ?>
                        </ul>
                    </span>
                </div>
                <div id="authorText" class="authorCol">
                    <p class="font-small">My name is Bojan and I am an aspiring front-end web developer. My approach to website design is to create a website that strengthens your company’s brand while ensuring ease of use and simplicity for your audience.</p>
                    <br/>
                    <p class="font-small">The way I look at it, a front-end developer's role is to combine design and business logic to achieve a user-facing product. To do this successfully, a wide skill set is necessary to produce a quality user experience that leads to meeting business goals, and I guarantee I've got exactly what's needed.</p>
                    <div class="portfolioLink">
                        <a href="https://bojanmaksimovic.com/" target="_blank" class="font-small uppercase btnPrimary">Portfolio</a>
                    </div>
                </div>
            </div>
        </section>
        <?php
            include("assets/php/pages/footer.php");
        ?>
    </body>
</html>
