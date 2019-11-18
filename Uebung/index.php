<?php 
    $bool = false;
    $text = "MyTextIsLame";
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
       
        <?php
            if($bool){
        ?>
        <p>
            <?php echo $text ?>
        </p>
        <?php
            }
        ?>
    </body>
</html>
