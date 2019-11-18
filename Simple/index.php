<?php session_start();?>
<!DOCTYPE html>

<html>
    <head>
        <?php
        include("head.php");
        ?>
    </head>
    <body>
        <div class="Start">
            <?php
            include("Navigation.php");
            include("Navigation-Smartphone.php");
            ?>
            <a id="start-text">Take it Simple</a>
        </div>

        <?php
        include("about.php");
        include("services.php");
        include("work_tmp.php");
        include("team.php");
        include("scrollToTop.php");
       
        ?>




        <br id="pc-br">
        <br id="pc-br">
        <br id="pc-br">
        <?php
        include("footer.php");
        ?>
    </body>
</html>
