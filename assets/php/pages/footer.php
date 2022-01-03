<footer id="footer">
    <div class="container">
        <div id="sitemap">
            <ul>
                <?php
                    printNavLinks();
                ?>
            </ul>
        </div>
        <div id="social">
            <ul>
                <?php
                    printFooterSocials();
                ?>
            </ul>
        </div>
    </div>
    <span id="copyright" class="font-xs">&copy;2021 Bojan Maksimović</span>
</footer>
<?php
    include("scripts.php");
?>