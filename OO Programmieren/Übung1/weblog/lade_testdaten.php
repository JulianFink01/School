<?php
    require_once 'includes/konfiguration.php';
    require_once 'includes/funktionen.inc.php';
    session_start();
    
    $testdaten = array(
        array(
            'titel'       => 'Blindheit per Definition',
            'erstellt_am' => time(),
            'autor'       => 'inewton',
            'inhalt'      => 'Mit Blindheit per Definition geschlagen, dennoch nicht unsichtbar, 
                              präsentiere ich mich als unbeachtetes und ungeliebtes Stiefkind 
                              zeitgenössischer Literatur. Meine Bestimmung liegt - wie ich selbst -
                              in engen Grenzen und ist rein platzhalterischer Natur.

                              Kann ein missbrauchtes Wortgefüge eigentlich noch Schlimmeres erleiden, 
                              als als Blindtext erdacht und vor der Öffentlichkeit versteckt zu werden?'
        ),
        array(
            'titel'       => 'Langweilig',
            'erstellt_am' => time(),
            'autor'       => 'jsartre',
            'inhalt'      => 'Dies ist ein Blindtext. Blindtexte sind zumeist weder informativ noch interessant, 
                              sondern ausgesprochen langweilig.
                              
                              So auch dieser.'
        ),
        array(
            'titel'       => 'Wenn ich gross bin',
            'erstellt_am' => time(),
            'autor'       => 'ghegel',
            'inhalt'      => 'Ich bin nur ein kleiner Blindtext. Wenn ich gross bin, will ich Ulysses 
                              von James Joyce werden. Aber jetzt lohnt es sich noch nicht, mich weiterzulesen. 
                              Denn vorerst bin ich nur ein kleiner Blindtext.'
        ),
    );
    
    // Überschreibe oder erzeuge eintraege.txt mit den Testdaten
    file_put_contents(PFAD_EINTRAEGE, serialize($testdaten));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link href="css/stylesheet.css" type="text/css" rel="stylesheet" />
    <title>Weblog - Testdaten laden</title>
</head>

<body>
    
    <div id="gesamt">
    
        <div id="kopf">
            <h1>Mein Weblog</h1>
        </div>
        
        <div id="inhalt">
            <h3>Testdaten</h3>
            <p>Die Testdaten wurden erfolgreich gespeichert.</p>
            <p>
                <a href="index.php" class="backlink">Zurück zur Hauptseite</a>
            </p>
        </div>
        
        <div id="fuss">
            Das ist das Ende
        </div>
            
    </div>

</body>

</html>