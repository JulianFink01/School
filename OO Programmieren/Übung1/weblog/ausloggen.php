<?php
    require_once 'includes/konfiguration.php';
    require_once 'includes/funktionen.inc.php';
    session_start();
    
    logge_aus();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link href="css/stylesheet.css" type="text/css" rel="stylesheet" />
    <title>Weblog - Ausloggen</title>
</head>

<body>
    
    <div id="gesamt">
    
        <div id="kopf">
            <h1>Mein Weblog</h1>
        </div>
        
        <div id="inhalt">
            
            <p>
                Sie wurden ausgeloggt.<br />
                Besuchen Sie uns bald wieder.
            </p>
            
            <p>
                <a href="index.php" class="backlink">Zurück zur Hauptseite</a>
            </p>
            
        </div>
            
        <div id="menu">
            <?php require 'includes/loginformular.php'; ?>
        </div>
            
        <div id="fuss">
            Das ist das Ende
        </div>
            
    </div>

</body>

</html>
