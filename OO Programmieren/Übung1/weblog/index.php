<?php
    require_once 'includes/konfiguration.php';
    require_once 'includes/funktionen.inc.php';
    session_start();
    
    // In Blogs werden Einträge immer in umgekehrter Reihenfolge angezeigt
    $eintraege = hole_eintraege(true);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link href="css/stylesheet.css" type="text/css" rel="stylesheet" />
    <title>Weblog - Einträge</title>
</head>

<body>

    <div id="gesamt">
        
        <div id="kopf">
            <h1>Mein Weblog</h1>
        </div>
        
        <div id="inhalt">
            
            <?php foreach ($eintraege as $e): ?>
                <h1><?php echo htmlspecialchars($e['titel']); ?></h1>
	            <?php echo nl2br(htmlspecialchars($e['inhalt'])); ?>
	            
	            <p class="eintrag_unten">
	                <span>
	                    <?php $benutzer = $benutzer_daten[$e['autor']]; ?>
	                    geschrieben von
	                    <?php echo $benutzer['vorname']; ?>
	                    <?php echo $benutzer['nachname']; ?>
	                    am <?php echo  strftime('%d.%m.%Y', $e['erstellt_am']); ?>
	                    um <?php echo strftime('%H:%M', $e['erstellt_am']); ?>
	                </span>
	            </p>
            <?php endforeach; ?>
            
        </div>
        
        <div id="menu">
            <?php
                /**
                 * Zeige das Login-Formular, wenn der Benutzer noch nicht eingeloggt ist,
                 * ansonsten das Hauptmenu.
                 */	 
                if (ist_eingeloggt()) {
				    require 'includes/hauptmenu.php';
                } else {
                	require 'includes/loginformular.php';
                } 
            ?>
        </div>
        
        <div id="fuss">
            Das ist das Ende
        </div>
            
    </div>

</body>

</html>