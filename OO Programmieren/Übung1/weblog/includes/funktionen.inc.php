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

    $sql= "select * beitraege natural join benutzer";




    	$eintraege = unserialize(file_get_contents(PFAD_EINTRAEGE));
    	if ($umgedreht === true) {
    		$eintraege = array_reverse($eintraege);
    	}
    	return $eintraege;
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
