<?php

class Working_on{

protected $movie_id = 0;
protected $job_id = 0;
protected $person_id = 0;

public function __construct($daten = array())
{
    // wenn $daten nicht leer ist, rufe die passenden Setter auf
    if ($daten) {
        foreach ($daten as $k => $v) {
            $setterName = 'set' . ucfirst($k);
            // wenn ein ungültiges Attribut übergeben wurde
            // (ohne Setter), ignoriere es
            if (method_exists($this, $setterName)) {
                $this->$setterName($v);
            }
        }
    }
}
public function  __toString()
{
    return 'Movie_id:'. $this->movie_id .', Job_id: '.$this->job_id;
}
public function toArray()
{
    $attribute = get_object_vars($this);
    return $attribute;
}

//Allgemeine Funktionen

public function speichere()
{
      $this->_insert();
}

public function loesche()
{
    $sql = 'DELETE FROM working_on WHERE movie_id=?';
    $abfrage = DB::getDB()->prepare($sql);
    $abfrage->execute( array($this->getMovie_id()) );
    $this->id = 0;
}
//Getter & Setter

public function getMovie_id(){
  return $this->movie_id;
}
public function setMovie_id($m_id){
  $this->movie_id = $m_id;
}
public function getJob_id(){
  return $this->job_id;
}
public function setJob_id($j_id){
   $this->job_id = $j_id;
}
public function getPerson_id(){
  return $this->person_id;
}
public function setPerson_id($pid){
  $this->person_id = $pid;
}

/* ***** Private Methoden ***** */

private function _insert()
{
    //Token generiren
    $this->setToken("");

    $sql = 'INSERT INTO working_on (movie_id, job_id)'
         . 'VALUES (:movie_id, :job_id)';

    $abfrage = DB::getDB()->prepare($sql);
    $abfrage->execute($this->toArray());
    // setze die ID auf den von der DB generierten Wert
    $this->id = DB::getDB()->lastInsertId();
}

private function _update()
{
    $sql = 'UPDATE working_on SET movie_id=:movie_id, job_id=:job_id'
        . 'WHERE id=:id';
    $abfrage = self::$db->prepare($sql);
    $abfrage->execute($this->toArray());
}

/* ***** public Methoden ***** */
public static function findeJobNachMovie($movieid){
  $sql = 'SELECT job.* FROM working_on, job WHERE working_on.job_id = job.id AND person_id=?';
  $abfrage = DB::getDB()->prepare($sql);
  $abfrage->execute(array($movieid));
  $abfrage->setFetchMode(PDO::FETCH_CLASS, 'Job');
  return $abfrage->fetch();
}
public static function findeJobNachPerson($personid){
  $sql = 'SELECT job.* FROM working_on, job WHERE working_on.job_id = job.id AND person_id=?';
  $abfrage = DB::getDB()->prepare($sql);
  $abfrage->execute(array($personid));
  $abfrage->setFetchMode(PDO::FETCH_CLASS, 'Job');
  return $abfrage->fetch();
  echo $sql.' '.$personid;
}
public static function findeMovieNachJob($jobid){
  $sql = 'SELECT movie.* FROM movie,working_on WHERE working_on.movie_id = movie.id AND job_id=? ';
  $abfrage = DB::getDB()->prepare($sql);
  $abfrage->execute(array($jobid));
  $abfrage->setFetchMode(PDO::FETCH_CLASS, 'Movie');
  return $abfrage->fetch();
}
public static function findeMovieNachPerson($personid){
  $sql = 'SELECT movie.* FROM movie,working_on WHERE working_on.movie_id = movie.id AND person_id=? ';
  $abfrage = DB::getDB()->prepare($sql);
  $abfrage->execute(array($personid));
  $abfrage->setFetchMode(PDO::FETCH_CLASS, 'Movie');
  return $abfrage->fetch();
}
public static function findePersonNachJob($jobid){
  $sql = 'SELECT person.* FROM person,working_on WHERE working_on.person_id = person.id AND job_id=? ';
  $abfrage = DB::getDB()->prepare($sql);
  $abfrage->execute(array($jobid));
  $abfrage->setFetchMode(PDO::FETCH_CLASS, 'Person');
  return $abfrage->fetch();
}
public static function findePersonNachMovie($movieid){
  $sql = 'SELECT person.* FROM person,working_on WHERE working_on.person_id = person.id AND movie_id=? ';
  $abfrage = DB::getDB()->prepare($sql);
  $abfrage->execute(array($movieid));
  $abfrage->setFetchMode(PDO::FETCH_CLASS, 'Person');
  return $abfrage->fetch();
}

public static function findePersonNachMovieUndJob($movieid, $jobid){
  $sql = 'SELECT person.* FROM person,working_on WHERE working_on.person_id = person.id AND movie_id=? AND job_id = ?';
  $abfrage = DB::getDB()->prepare($sql);
  $abfrage->execute(array($movieid, $jobid));
  $abfrage->setFetchMode(PDO::FETCH_CLASS, 'Person');
  return $abfrage->fetch();

}
public static function findeMovieNachPersonUndJob($personid,  $jobid){
  $sql = 'SELECT movie.* FROM movie,working_on WHERE working_on.movie_id = movie.id AND job_id=? and person_id=?';
  $abfrage = DB::getDB()->prepare($sql);
  $abfrage->execute(array($jobid, $personid));
  $abfrage->setFetchMode(PDO::FETCH_CLASS, 'Movie');
  return $abfrage->fetch();

}
public static function findeJobNachMovieUndPerson($movieid, $personid){
  $sql = 'SELECT job.* FROM working_on, job WHERE working_on.job_id = job.id AND person_id=? AND movie_id=?';
  $abfrage = DB::getDB()->prepare($sql);
  $abfrage->execute(array($movieid, $personid));
  $abfrage->setFetchMode(PDO::FETCH_CLASS, 'Job');
  return $abfrage->fetch();
}
}


?>
