<?php

class Controller{

    private $context = array();


    public function run($aktion){
        $this->$aktion();
        $this->generatePage($aktion);
    }

    // Alle Seminartermine auslesen
    public function alleST(){
      $this->addContext("seminartermine", Seminartermin::findeAlle());
    }
    public function zeigeSInfos(){
      $this->addContext("seminar", Seminar::finde($_GET["s_id"]));
    }

    private function generatePage($template){
        extract($this->context);        
        require_once 'view/'.$template.".tpl.php";

    }

    private function addContext($key, $value){
        $this->context[$key] = $value;
    }

    public function loescheST(){
      $SeminarTermin = Seminartermin::finde($_GET["st_id"]);
      $SeminarTermin->loesche();
      header("Location: index.php");
    }
}

?>
