<?php

class Job{

protected $name = "";
protected $description = "";
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
    return 'Id:'. $this->id .', Name: '.$this->name.', Description: '.$this->description;
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

public function getName(){
  return $this->name;
}
public function setName($name){
  $this->name = $name;
}
public function getId(){
  return $this->id;
}
public function getDescription(){
  return $this->description;
}
public function setDescription($des){
  $this->description = $des;
}
/* ***** Private Methoden ***** */

private function _insert()
{
    //Token generiren
    $this->setToken("");

    $sql = 'INSERT INTO job (name, description)'
         . 'VALUES (:name, :description)';

    $abfrage = DB::getDB()->prepare($sql);
    $abfrage->execute($this->toArray(false));
    // setze die ID auf den von der DB generierten Wert
    $this->id = DB::getDB()->lastInsertId();
}

private function _update()
{
    $sql = 'UPDATE job SET name=:name, desciption=:description'
        . 'WHERE id=:id';
    $abfrage = self::$db->prepare($sql);
    $abfrage->execute($this->toArray());
}

/* ***** static Methoden ***** */
public static function finde($id){
  $sql = 'SELECT * FROM job WHERE id=?';
  $abfrage = DB::getDB()->prepare($sql);
  $abfrage->execute(array($id));
  $abfrage->setFetchMode(PDO::FETCH_CLASS, 'Job');
  return $abfrage->fetch();
}
public static function findeAlle()
{
    $sql = 'SELECT * FROM job';
    $abfrage = DB::getDB()->query($sql);
    $abfrage->setFetchMode(PDO::FETCH_CLASS, 'Job');
    return $abfrage->fetchAll();
}
//public get_class_methods
public function findeAlleJobTeilnehmer()
{
  return Working_on::findePersonNachJob($this->getId());
}
public function findeAlleMovies()
{
  return Working_on::findeMovieNachJob($this->getId());
}


}


?>
