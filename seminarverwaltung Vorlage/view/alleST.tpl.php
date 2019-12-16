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
            <tr><th>Beginn</th><th>Ende</th><th>Raum</th><th>Titel</th></tr>
            <?php foreach ($seminartermine as $seminartermin) { ?>
            <tr>
                <th><?php echo $seminartermin->getBeginn()?></th>
                <th><?php echo $seminartermin->getEnde()?></th>
                <th><?php echo $seminartermin->getRaum()?></th>
                <th><a href="index.php?aktion=zeigeSInfos&s_id=<?php echo $seminartermin->getSeminar()->getId()?>"><?php echo $seminartermin->getSeminar()->getTitel()?></a></th>
                <th><a href="index.php?aktion=loescheST&st_id=<?php echo $seminartermin->getId()?>">Löschen</a></th>
            </tr>
            <?php } ?>
        </table>

    </body>
</html>
