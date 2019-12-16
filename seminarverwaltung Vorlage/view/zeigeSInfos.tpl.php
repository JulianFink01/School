<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <table>
            <tr><th>Titel</th><th>Beschreibung</th><th>Preis</th><th>Kategorie</th></tr>
            <tr>
                <th><?php echo $seminar->getTitel()?></th>
                <th><?php echo $seminar->getBeschreibung()?></th>
                <th><?php echo $seminar->getPreis()?></th>
                <th><?php echo $seminar->getKategorie()?></th>
            </tr>
        </table>

        <a href="index.php">Zurürck</a>
    </body>
</html>
