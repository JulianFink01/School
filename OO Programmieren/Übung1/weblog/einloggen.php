<?php
    require_once 'includes/konfiguration.php';
    require_once 'includes/funktionen.inc.php';
    session_start();
    
    // Prüfe alle Benutzer, ob einer mit den übergebenen Daten übereinstimmt
    foreach ($benutzer_daten as $benutzername => $daten) {
    	if (
			($benutzername === trim($_POST['benutzername'])) &&
    	    ($daten['passwort'] === trim($_POST['passwort']))
		) {
    	   	// Wenn ja, logge den Benutzer ein
			logge_ein($benutzername);
    	}
    }
    
    /*
     * Leite zu index.php um. Der Besucher wird entweder das Login-Formular
     * sehen, wenn die Daten falsch waren, oder das Hauptmenu, wenn der Login
     * erfolgreich war. 
     */
    header('Location: index.php');
?>