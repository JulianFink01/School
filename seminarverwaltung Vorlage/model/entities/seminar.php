<?php
    class Seminar
    {
        private $id = 0;
        private $titel = '';
        private $beschreibung = '';
        private $preis = '';
        private $kategorie = '';

        public function __construct(array $daten = array())
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
            return $this->getTitel();
        }

        /* *** Getter und Setter *** */

        public function getId()
        {
            return $this->id;
        }

        public function getTitel()
        {
            return $this->titel;
        }

        public function setTitel($titel)
        {
            $this->titel = $titel;
        }

        public function getBeschreibung()
        {
            return $this->beschreibung;
        }

        public function setBeschreibung($beschreibung)
        {
            $this->beschreibung = $beschreibung;
        }

        public function getPreis()
        {
            return $this->preis;
        }

        public function setPreis($preis)
        {
            $this->preis = $preis;
        }

        public function getKategorie()
        {
            return $this->kategorie;
        }

        public function setKategorie($kategorie)
        {
            $this->kategorie = $kategorie;
        }

        public function toArray($mitId = true)
        {
            $attribute = get_object_vars($this);
            if ($mitId === false) {
                // wenn $mitId false ist, entferne den Schlüssel
                // id aus dem Ergebnis
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
            $sql = 'DELETE FROM seminare WHERE id=?';
            $abfrage = DB::getDB()->prepare($sql);
            $abfrage->execute( array($this->getId()) );
            // Objekt existiert nicht mehr in der DB,
            // also muss die ID zurückgesetzt werden
            $this->id = 0;
        }

        /* ***** Private Methoden ***** */

        private function _insert()
        {
            $sql = 'INSERT INTO seminare (titel, beschreibung, preis, kategorie) '
                 . 'VALUES (:titel, :beschreibung, :preis, :kategorie)';

            $abfrage = DB::getDB()->prepare($sql);
            $abfrage->execute($this->toArray(false));
            // setze die ID auf den von der DB generierten Wert
            $this->id = DB::getDB()->lastInsertId();
        }

        private function _update()
        {
            $sql = 'UPDATE seminare SET titel=:titel, beschreibung=:beschreibung, '
                 . 'preis=:preis, kategorie=:kategorie '
                 . 'WHERE id=:id';
            $abfrage = DB::getDB()->prepare($sql);
            $abfrage->execute($this->toArray());
        }

        /* ***** Statische Methoden ***** */
        
        public static function finde($id)
        {
            $sql = 'SELECT * FROM seminare WHERE id=?';
            $abfrage = DB::getDB()->prepare($sql);
            $abfrage->execute(array($id));
            $abfrage->setFetchMode(PDO::FETCH_CLASS, 'Seminar');
            return $abfrage->fetch();
        }

        public static function findeAlle()
        {
            $sql = 'SELECT * FROM seminare';
            $abfrage = DB::getDB()->query($sql);
            $abfrage->setFetchMode(PDO::FETCH_CLASS, 'Seminar');
            return $abfrage->fetchAll();
        }

        public static function findeNachTitel($titel)
        {
            $sql = 'SELECT * FROM seminare WHERE titel=?';
            $abfrage = DB::getDB()->prepare($sql);
            $abfrage->execute(array($titel));
            $abfrage->setFetchMode(PDO::FETCH_CLASS, 'Seminar');
            return $abfrage->fetchAll();
        }

        public static function findeNachPreis($vonPreis, $bisPreis)
        {
            $sql = 'SELECT * FROM seminare WHERE preis>=? AND preis<=?';
            $abfrage = DB::getDB()->prepare($sql);
            $abfrage->execute(array($vonPreis, $bisPreis));
            $abfrage->setFetchMode(PDO::FETCH_CLASS, 'Seminar');
            return $abfrage->fetchAll();
        }
        
        public function getSeminartermine()
        {
            return Seminartermin::findeNachSeminar($this);
        }   
    }
?>