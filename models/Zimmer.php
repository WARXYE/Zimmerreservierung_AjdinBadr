<?php
require_once "Database.php";

class Zimmer
{
    private $nr = 0;
    private $Name = '';
    private $Personen = '';
    private $Preis = '';
    private $Balkon = '';

    private $errors = [];

    public function validate()
    {
        return $this->validateHelper('Name', 'name', $this->Name, 32, true) &
            $this->validateHelper('Space', 'space', $this->Personen, 128) &
            $this->validateHelper('Preis', 'preis', $this->Preis, 64) &
            $this->validateHelper('Balkon', 'balkon', $this->Balkon, 64);
    }

    public function save()
    {
        if ($this->validate()) {
            if ($this->nr != null && $this->nr > $this->biggestId()) {
                $this->update();
            } else {
                $this->nr = $this->create();
            }

            return true;
        }

        return false;
    }

    public function create()
    {
        $db = Database::connect();
        $sql = "INSERT INTO zimmer (Name, Personen, Preis, Balkon) values(?, ?, ?, ?)";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($this->Name, $this->Personen, $this->Preis, $this->Balkon));
        $lastId = $db->lastInsertId();
        Database::disconnect();
        return $lastId;
    }

    public function update()
    {
        $db = Database::connect();
        $sql = "UPDATE zimmer set name = ?, personen = ?, preis = ?, balkon = ? WHERE nr = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($this->Name, $this->Personen, $this->Preis, $this->Balkon, $this->nr));
        Database::disconnect();
    }

    public static function get($id)
    {
        $db = Database::connect();
        $sql = "SELECT * FROM zimmer WHERE nr = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($id));
        $item = $stmt->fetchObject('Zimmer');
        Database::disconnect();

        return $item !== false ? $item : null;
    }

    public static function getAll()
    {
        $db = Database::connect();
        $sql = "SELECT * FROM zimmer";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $items = $stmt->fetchAll(PDO::FETCH_CLASS, 'Zimmer');
        Database::disconnect();

        return $items;
    }

    public static function delete($id)
    {
        $db = Database::connect();
        $sql = "DELETE FROM zimmer WHERE nr = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute(array($id));
        Database::disconnect();
    }

    public static function biggestId(){
        $db = Database::connect();
        $sql = "SELECT * FROM zimmer WHERE NR = (SELECT MAX(NR) FROM zimmer)";
        $stmt = $db->prepare($sql);
        $latestId = $stmt->fetchObject('Zimmer');
        Database::disconnect();
        print_r($latestId);
        return $latestId;
    }

    private function validateHelper($label, $key, $value, $max)
    {
        if (strlen($value) == 0) {
            $this->errors[$key] = "$label darf nicht leer sein";
            return false;
        } else if (strlen($value) > $max) {
            $this->errors[$key] = "$label zu lang (max. $max Zeichen)";
            return false;
        } else {
            return true;
        }
    }

    /**
     * @return int
     */
    public function getNr()
    {
        return $this->nr;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->Name;
    }

    /**
     * @return string
     */
    public function getPersonen()
    {
        return $this->Personen;
    }

    /**
     * @return string
     */
    public function getPreis()
    {
        return $this->Preis;
    }

    /**
     * @return string
     */
    public function getBalkon()
    {
        return $this->Balkon;
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @param int $nr
     */
    public function setNr($nr)
    {
        $this->nr = $nr;
    }

    /**
     * @param string $Name
     */
    public function setName($Name)
    {
        $this->Name = $Name;
    }

    /**
     * @param string $Personen
     */
    public function setPersonen($Personen)
    {
        $this->Personen = $Personen;
    }

    /**
     * @param string $Preis
     */
    public function setPreis($Preis)
    {
        $this->Preis = $Preis;
    }

    /**
     * @param string $Balkon
     */
    public function setBalkon($Balkon)
    {
        $this->Balkon = $Balkon;
    }
}

