<?php
    function hole_eintraege($umgedreht = false)
    {
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