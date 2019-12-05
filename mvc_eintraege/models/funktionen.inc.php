<?php

    function leerer_eintrag(){
        $eintrag = array('vorname' => '', 'nachname' => '', 'email' => '', 'id' => '');

        return $eintrag;
    }

    function hole_eintrag($id)
    {
        if (empty($id)) {
            $id = 0;
        }
        $eintraege = unserialize(file_get_contents('eintraege.txt'));
        $eintrag = $eintraege[$id];
        $eintrag['id'] = $id;
        return $eintrag;
    }

    function loesche_eintrag($id){
      $eintraege = unserialize(file_get_contents('eintraege.txt'));
      unset($eintraege[$id]);
      file_put_contents('eintraege.txt', serialize($eintraege));
    }

    function speichere_eintrag($post)
    {
        $eintraege = unserialize(file_get_contents('eintraege.txt'));
        $eintrag = array('vorname' => $post['vorname'], 'nachname' => $post['nachname'], 'email' => $post['email']);
        // wenn eine id mit übergben wurde, gibt es den Eintrag schon
        if (!empty($post['id'])) {
            $id = $post['id'];
            $eintraege[$id] = $eintrag;
        } else {
            $eintraege[] = $eintrag;
        }

        file_put_contents('eintraege.txt', serialize($eintraege));
    }

    function hole_alle(){
      $eintrage = unserialize(file_get_contents('eintraege.txt'));
      return $eintrage;
    }
?>
