<?php

class Person{

protected $name = "";
protected $surname = "";
protected $birthdate = "";
protected $id = NULL;

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
    return 'Id:'. $this->id .', Name: '.$this->name.', Surname: '.$this->surname.', Birthdate: '.$this->birthdate;
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
public function getSurname(){
  return $this->surname;
}
public function setSurname($sn){
  $this->surname = $sn;
}
public function getBirthdate(){
  return $this->birthdate;
}
public function setBirthdate($bd){
  $this->birthdate = $bd;
}
/* ***** Private Methoden ***** */

private function _insert()
{
    //Token generiren
    $this->setToken("");

    $sql = 'INSERT INTO person (name, surname, birthdate, job_id)'
         . 'VALUES (:name, :surname, :birthdate, :job_id)';

    $abfrage = DB::getDB()->prepare($sql);
    $abfrage->execute($this->toArray(false));
    // setze die ID auf den von der DB generierten Wert
    $this->id = DB::getDB()->lastInsertId();
}

private function _update()
{
    $sql = 'UPDATE person SET name=:name, surname=:surname, birthdate=:birthdate, job_id=:job_id'
        . 'WHERE id=:id';
    $abfrage = self::$db->prepare($sql);
    $abfrage->execute($this->toArray());
}

/* ***** static Methoden ***** */

public static function finde($id){
  $sql = 'SELECT * FROM person WHERE id=?';
  $abfrage = DB::getDB()->prepare($sql);
  $abfrage->execute(array($id));
  $abfrage->setFetchMode(PDO::FETCH_CLASS, 'Person');
  return $abfrage->fetch();
}
public function findeAlle()
{
    $sql = 'SELECT * FROM person';
    $abfrage = DB::getDB()->query($sql);
    $abfrage->setFetchMode(PDO::FETCH_CLASS, 'Person');
    return $abfrage->fetchAll();
}
/* ***** public Methoden ***** */
  public function findeJob(){
    return Working_on::findeJobNachPerson($this->getId());
  }
  public function findeMovie(){
    return Working_on::findeMovieNachPerson($this->getId());
  }
}


?>
