<?php

    function getDB(){

        $db = null;
        try{
        $db = new PDO('mysql:host=localhost;dbname=webblog;port=3306',
        'root','');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
          echo $e->getMessage();
        }

        return $db;
    }


    function hole_eintraege($umgedreht = false)
    {

    $sql= "select beitraege.titel, beitraege.inhalt, benutzer.vorname, benutzer.nachname, beitraege.datum from beitraege join benutzer on benutzer.id = beitraege.benutzer_id";
    $db = getDB();
    $ergebnis=array();
    if($db !=null){
      $erg=$db->query($sql);
      $ergebnis=$erg->fetchAll();
    }else{

    }
    	return $ergebnis;
    }

    function ist_eingeloggt()
    {
        $erg = false;
        if (isset($_SESSION['eingeloggt'])){
            if (!empty($_SESSION['eingeloggt']))
                    $erg = true;
        }
        return $erg;
    }

    function logge_ein($benutzername)
    {
    	$_SESSION['eingeloggt'] = $benutzername;
    }

    function logge_aus()
    {
    	unset($_SESSION['eingeloggt']);
    }
?>
