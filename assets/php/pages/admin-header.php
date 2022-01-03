<header id="header" class="adminHeader">
    <?php
        include("login-bar.php");
    ?>
    <div class="container">
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
                            printAdminNavLinks();
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>