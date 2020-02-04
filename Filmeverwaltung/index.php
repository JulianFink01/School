<?php

  require_once("entities/db.php");
  require_once("entities/job.php");
  require_once("entities/person.php");
  require_once("entities/movie.php");
  require_once("entities/working_on.php");

  //Beispiele

  //finde Alle Jobs
  $job = Job::findeAlle();

  //Für jeden Job
  foreach($job as $j){
    //Ausgabe von Job
    echo $j->__toString().'<br>';

    //Finde zu jeden Job alle Teilnehmer und Ausgabe
    $jt = $j->findeAlleJobTeilnehmer();
    var_dump($jt).'<br>';

    //Finde zu jeden Job alle Movies und Ausgabe
    $jm = $j->findeAlleMovies();
    var_dump($jm);
  }
?>
