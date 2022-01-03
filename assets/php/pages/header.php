<?php
    $_SESSION['page'] = $_SERVER['REQUEST_URI'];
?>
<header id="header">
    <?php
        include("assets/php/pages/login-bar.php");
    ?>
    <div id="logoAndNav">
        <div class="container">
            <div id="logo">
                <a href="index.php">
                    <h1 class="font-xl">MS</h1>
                </a>
            </div>
            <div id="navAndCart">
                <nav id="nav">
                    <ul>
                        <?php
                            printNavLinks();
                        ?>
                    </ul>
                </nav>
                <div id="cart">
                    <a href="cart.php">
                        <i class="fas fa-shopping-cart font-medium"></i>
                    </a>
                    <label id="cartNumber" class="font-xs"></label>
                </div>
                <div id="hamburger">
                    <a href="#">
                        <i class="fas fa-bars font-large"></i>
                    </a>
                </div>
                <div id="sideNav">
                    <div class="cover">
                        <div id="sideNavContent">
                            <ul>
                                <?php
                                    printNavLinks();
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>