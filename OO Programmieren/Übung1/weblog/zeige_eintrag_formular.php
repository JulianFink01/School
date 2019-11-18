<?php
    require_once 'includes/konfiguration.php';
    require_once 'includes/funktionen.inc.php';
    session_start();
    
    // Nur ein eingeloggter Benutzer darf neue Einträge posten. 
    if (! ist_eingeloggt()) {
    	header('Location: index.php');
    	exit;
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link href="css/stylesheet.css" type="text/css" rel="stylesheet" />
    <title>Weblog - Neuen Eintrag schreiben</title>
</head>

<body>
    
    <div id="gesamt">
    
        <div id="kopf">
            <h1>Mein Weblog</h1>
        </div>
        
        <div id="inhalt">
            
            <h1>Schreiben Sie hier einen neuen Eintrag:</h1>
            
            <form action="speichere_eintrag.php" method="post">
                <p><input type="text" name="titel" id="titel" /></p>
                <p><textarea name="inhalt" id="eintrag" cols="50" rows="10"></textarea></p>
                <p><input type="submit" value="Eintragen" /></p>
            </form>
            
        </div>
        
        <div id="menu">
            <?php require 'includes/hauptmenu.php'; ?>
        </div>
        
        <div id="fuss">
            Das ist das Ende
        </div>
            
    </div>

</body>

</html>