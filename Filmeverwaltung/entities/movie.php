<?php

class Movie{

protected $title = "";
protected $releaseDate = "";
protected $id = 0;

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
    return 'Id:'. $this->id .', Title: '.$this->title.', ReleaseDate: '.$this->releaseDate;
}
public function toArray($mitId = true)
{
    $attribute = get_object_vars($this);
    if ($mitId === false) {
        // wenn $mitId false ist, entferne den Schlüssel id aus dem Ergebnis
        unset($attribute['id']);
    }
    return $attribute;
}

//Allgemeine Funktionen

public function speichere()
{
    if ( $this->getId() > 0 ) {
        $this->_update();
    } else {
      $this->_insert();
    }
}

public function loesche()
{
    $sql = 'DELETE FROM job WHERE id=?';
    $abfrage = DB::getDB()->prepare($sql);
    $abfrage->execute( array($this->getId()) );
    $this->id = 0;
}
//Getter & Setter

public function getTitle(){
  return $this->title;
}
public function setTitle($title){
  $this->title = $title;
}
public function getId(){
  return $this->id;
}
public function getReleaseDate(){
  return $this->releaseDate;
}
public function setReleaseDate($rd){
  $this->releaseDate = $rd;
}
/* ***** Private Methoden ***** */

private function _insert()
{
    //Token generiren
    $this->setToken("");

    $sql = 'INSERT INTO movie (title, releaseDate)'
         . 'VALUES (:title, :releaseDate)';

    $abfrage = DB::getDB()->prepare($sql);
    $abfrage->execute($this->toArray(false));
    // setze die ID auf den von der DB generierten Wert
    $this->id = DB::getDB()->lastInsertId();
}

private function _update()
{
    $sql = 'UPDATE movie SET title=:title, releaseDate=:releaseDate'
        . 'WHERE id=:id';
    $abfrage = self::$db->prepare($sql);
    $abfrage->execute($this->toArray());
}

/* ***** static Methoden ***** */
public static function finde($id){
  $sql = 'SELECT * FROM movie WHERE id=?';
  $abfrage = DB::getDB()->prepare($sql);
  $abfrage->execute(array($id));
  $abfrage->setFetchMode(PDO::FETCH_CLASS, 'Movie');
  return $abfrage->fetch();
}
public static function findeAlle()
{
    $sql = 'SELECT * FROM movie';
    $abfrage = DB::getDB()->query($sql);
    $abfrage->setFetchMode(PDO::FETCH_CLASS, 'Movie');
    return $abfrage->fetchAll();
}

//public Methoden
public function findeJobs(){
  return Working_on::findeJobNachMovie($this->getId());
}
public function findePersonen(){
  return Working_on::findePersonNachMovie($this->getId());
}
}


?>
