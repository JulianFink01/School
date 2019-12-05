 <?php
    require_once 'models/funktionen.inc.php';
    if (isset ($_REQUEST['aktion']))
        $aktion = $_REQUEST['aktion'];
    else
        $aktion = 'neu';
    switch($aktion) {
    	case "zeige":
        	$eintrag = hole_eintrag($_REQUEST['id']);
    		break;
    	case "neu":
          $eintrag = leerer_eintrag();
        	$aktion = 'formular_anzeigen';
    		break;
    	case "speichere":
        	speichere_eintrag($_POST);
    		break;
    	case "editiere":
        	$eintrag = hole_eintrag($_REQUEST['id']);
        	$aktion = 'formular_anzeigen';
    		break;
      case "zeige_alle":
        $eintraege = hole_alle();
        break;
      case "loesche":
          loesche_eintrag($_REQUEST['id']);
          header("Location: index.php?aktion=zeige_alle");
          break;
    }

    require_once 'views/' . $aktion . '.tpl.html';
?>
