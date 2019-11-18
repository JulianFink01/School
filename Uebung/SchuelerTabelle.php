<?php
$schueler[] = array("Vorname" => "Alex", "Nachname" => "Larentis");
$schueler[] = array("Vorname" => "Julian", "Nachname" => "Fink");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>

        <table border="1px" style="border-collapse:collapse;">
            <?php
            foreach ($schueler as $index => $name) {
                ?>
                <tr>                
                    <td><?php echo $index + 1; ?></td>
                    <td><?php echo $name["Vorname"]; ?></td>
                    <td><?php echo $name["Nachname"]; ?></td>
                </tr>
                <?php
            }
            ?> 
        </table>
    </body>
</html>

