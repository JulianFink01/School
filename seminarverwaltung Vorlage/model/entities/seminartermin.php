<?php
    class Seminartermin
    {
        private $id = 0;
        private $beginn = '';
        private $ende = '';
        private $raum = '';
        private $seminar_id = '';
        
        public function __construct($daten = array())
        {
            // wenn $daten nicht leer ist, rufe die passenden Setter auf
            if ($daten) {
                foreach ($daten as $k => $v) {
                    $setterName = 'set' . ucfirst($k);
                    // wenn ein ungültiges Attribut übergeben wurde (ohne Setter), ignoriere es
                    if (method_exists($this, $setterName)) {
                        $this->$setterName($v);
                    }
                }
            }
        }

        public function  __toString()
        {
            return 'Von: ' . $this->getBeginn() . ', Bis: ' . $this->getEnde();
        }

        /* *** Getter und Setter *** */

        public function getId()
        {
            return $this->id;
        }

        public function getBeginn()
        {
            return $this->beginn;
        }

        public function setBeginn($beginn)
        {
            $this->beginn = $beginn;
        }

        public function getEnde()
        {
            return $this->ende;
        }

        public function setEnde($ende)
        {
            $this->ende = $ende;
        }

        public function getRaum()
        {
            return $this->raum;
        }

        public function setRaum($raum)
        {
            $this->raum = $raum;
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
                // wenn die ID eine Datenbank-ID ist, also größer 0,
                // führe ein UPDATE durch
                $this->_update();
            } else {
                // ansonsten einen INSERT
                $this->_insert();
            }
        }

        public function loesche()
        {
            $sql = 'DELETE FROM seminartermine WHERE id=?';
            $abfrage = DB::getDB()->prepare($sql);
            $abfrage->execute( array($this->getId()) );
            // Objekt existiert nicht mehr in der DB,
            // also muss die ID zurückgesetzt werden
            $this->id = 0;
        }

        /* ***** Private Methoden ***** */

        private function _insert()
        {
            $sql = 'INSERT INTO seminartermine (beginn, ende, raum, seminar_id) '
                 . 'VALUES (:beginn, :ende, :raum, :seminar_id)';

            $abfrage = DB::getDB()->prepare($sql);
            $abfrage->execute($this->toArray(false));
            // setze die ID auf den von der DB generierten Wert
            $this->id = self::$db->lastInsertId();
        }

        private function _update()
        {
            $sql = 'UPDATE seminartermine SET beginn=:beginn, ende=:ende, raum=:raum, '
                 . 'seminar_id=:seminar_id WHERE id=:id';
            $abfrage = DB::getDB()->prepare($sql);
            $abfrage->execute($this->toArray());
        }

        /* ***** Statische Methoden ***** */


        public static function finde($id)
        {
            $sql = 'SELECT * FROM seminartermine WHERE id=?';
            $abfrage = DB::getDB()->prepare($sql);
            $abfrage->execute(array($id));
            $abfrage->setFetchMode(PDO::FETCH_CLASS, 'Seminartermin');
            return $abfrage->fetch();
        }

        public static function findeAlle()
        {
            $sql = 'SELECT * FROM seminartermine';
            $abfrage = DB::getDB()->query($sql);
            $abfrage->setFetchMode(PDO::FETCH_CLASS, 'Seminartermin');
            return $abfrage->fetchAll();
        }

        public static function findeNachRaum($raum)
        {
            $sql = 'SELECT * FROM seminartermine WHERE raum=?';
            $abfrage = DB::getDB()->prepare($sql);
            $abfrage->execute(array($raum));
            $abfrage->setFetchMode(PDO::FETCH_CLASS, 'Seminartermin');
            return $abfrage->fetchAll();
        }
        
        public static function findeNachSeminar(Seminar $seminar)
        {
            $sql = 'SELECT * FROM seminartermine WHERE seminar_id=?';
            $abfrage = DB::getDB()->prepare($sql);
            $abfrage->execute(array($seminar->getId()));
            $abfrage->setFetchMode(PDO::FETCH_CLASS, 'Seminartermin');
            return $abfrage->fetchAll();
        }
       
        // Beziehungen
        public static function findeNachBenutzer(Benutzer $benutzer)
        {
            $sql = 'SELECT st.* FROM seminartermine st '
                 . 'JOIN nimmt_teil nt ON st.id=nt.seminartermin_id '
                 . 'WHERE nt.benutzer_id=?';
            $abfrage = DB::getDB()->prepare($sql);
            $abfrage->execute( array($benutzer->getId()) );
            $abfrage->setFetchMode(PDO::FETCH_CLASS, 'Seminartermin');
            return $abfrage->fetchAll();
        }
        
        public function setSeminar(Seminar $seminar)
        {
            $this->seminar_id = $seminar->getId();
        }
        
        public function getSeminar()
        {
            return Seminar::finde($this->seminar_id);
        }
        
        public function getTeilnehmer()
        {
            return Benutzer::findeNachSeminartermin($this);
        }
        
        public function addTeilnehmer(Benutzer $teilnehmer)
        {
            if ( $teilnehmer->getId() === 0 ) {
                // Der Benutzer muss gespeichert sein, damit die Zuordnung in
                // nimmt_teil vorgenommen werden kann.
                $teilnehmer->speichere();
            }

            $sql = 'INSERT INTO nimmt_teil '
                 . '(benutzer_id, seminartermin_id) VALUES (?, ?)';
            $abfrage = DB::getDB()->prepare($sql);
            $abfrage->execute(array( $teilnehmer->getId(), $this->getId() ));
        }
        
        public function loescheTeilnehmer(Benutzer $teilnehmer)
        {
            $sql = 'DELETE FROM nimmt_teil '
                 . 'WHERE benutzer_id=? AND seminartermin_id=?';
            $abfrage = DB::getDB()->prepare($sql);
            $abfrage->execute(array(
                $teilnehmer->getId(),
                $this->getId()
            ));
        }
    }
?>