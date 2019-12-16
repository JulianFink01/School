<?php
    class Benutzer
    {
        private $id = 0;
        private $vorname = '';
        private $name = '';
        private $email = '';
        private $passwort = '';
        private $registriert_seit = '';
        private $anrede = '';


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
            return $this->getVorname() . ' ' . $this->getName();
        }

        /* *** Getter und Setter *** */

        public function getId()
        {
            return $this->id;
        }

        public function getVorname()
        {
            return $this->vorname;
        }

        public function setVorname($vorname)
        {
            $this->vorname = $vorname;
        }

        public function getName()
        {
            return $this->name;
        }

        public function setName($name)
        {
            $this->name = $name;
        }

        public function getEmail()
        {
            return $this->email;
        }

        public function setEmail($email)
        {
            $this->email = $email;
        }

        public function getPasswort()
        {
            return $this->passwort;
        }

        public function setPasswort($passwort)
        {
            $this->passwort = $passwort;
        }

        public function getRegistriertSeit()
        {
            return $this->registriert_seit;
        }

        public function getAnrede()
        {
            return $this->anrede;
        }

        public function setAnrede($anrede)
        {
            $this->anrede = $anrede;
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

        /* *** Persistenz-Methoden *** */

        public function speichere()
        {
            if ( $this->getId() > 0 ) {
                // wenn die ID eine Datenbank-ID ist, also größer 0, führe ein UPDATE durch
                $this->_update();
            } else {
                // ansonsten einen INSERT
                $this->_insert();
            }
        }

        public function loesche()
        {
            $sql = 'DELETE FROM benutzer WHERE id=?';
            $abfrage = DB::getDB()->prepare($sql);
            $abfrage->execute( array($this->getId()) );
            // Objekt existiert nicht mehr in der DB, also muss die ID zurückgesetzt werden
            $this->id = 0;
        }

        /* ***** Private Methoden ***** */

        private function _insert()
        {
            // beim ersten Eintragen, setzte das Attribut registriert_seit auf 'jetzt'
            $this->registriert_seit = strftime('%Y-%m-%d');

            $sql = 'INSERT INTO benutzer (vorname, name, email, passwort, registriert_seit, anrede) '
                 . 'VALUES (:vorname, :name, :email, :passwort, :registriert_seit, :anrede)';

            $abfrage = DB::getDB()->prepare($sql);
            $abfrage->execute($this->toArray(false));
            // setze die ID auf den von der DB generierten Wert
            $this->id = DB::getDB()->lastInsertId();
        }

        private function _update()
        {
            $sql = 'UPDATE benutzer SET vorname=:vorname, name=:name, email=:email, '
                 . 'passwort=:passwort, registriert_seit=:registriert_seit, anrede=:anrede '
                 . 'WHERE id=:id';
            $abfrage = self::$db->prepare($sql);
            $abfrage->execute($this->toArray());
        }

        /* ***** Statische Methoden ***** */

        public static function finde($id)
        {
            $sql = 'SELECT * FROM benutzer WHERE id=?';
            $abfrage = DB::getDB()->prepare($sql);
            $abfrage->execute(array($id));
            $abfrage->setFetchMode(PDO::FETCH_CLASS, 'Benutzer');
            return $abfrage->fetch();
        }

        public static function findeAlle()
        {
            $sql = 'SELECT * FROM benutzer';
            $abfrage = DB::getDB()->query($sql);
            $abfrage->setFetchMode(PDO::FETCH_CLASS, 'Benutzer');
            return $abfrage->fetchAll();
        }

        public static function findeNachVorname($vorname)
        {
            $sql = 'SELECT * FROM benutzer WHERE vorname=?';
            $abfrage = DB::getDB()->prepare($sql);
            $abfrage->execute(array($vorname));
            $abfrage->setFetchMode(PDO::FETCH_CLASS, 'Benutzer');
            return $abfrage->fetchAll();
        }
        
        // Beziehungen
        public static function findeNachSeminartermin(Seminartermin $seminartermin)
        {
            $sql = 'SELECT benutzer.* FROM benutzer '
                 . 'JOIN nimmt_teil ON benutzer.id=nimmt_teil.benutzer_id '
                 . 'WHERE nimmt_teil.seminartermin_id=?';
            $abfrage = DB::getDB()->prepare($sql);
            $abfrage->execute( array($seminartermin->getId()) );
            $abfrage->setFetchMode(PDO::FETCH_CLASS, 'Benutzer');
            return $abfrage->fetchAll();
        }
        
        public function getTermine(){
            return Seminartermin::findeNachBenutzer($this);
        }
        
    }
?>