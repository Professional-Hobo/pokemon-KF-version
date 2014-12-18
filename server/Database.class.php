<?php
require_once("config.php");

class Database
{
    private $db;
    public function __construct() {
        $this->connect();
    }
    public function connect() {
        try {
            $this->db = new PDO("mysql:host=localhost;port=3306;dbname=" . Config::DB_NAME, Config::DB_USER, Config::DB_PASS);
            $this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $this->db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
        } catch (PDOException $e) {
            echo "Problem connecting to DB.";
            die;
        }
    }
    public function con() {
        return $this->db;
    }
    public static function doesExist($table, $fieldname, $value, $returnObject = false) {
        $db = new self();
        $statement = $db->con()->prepare("SELECT * FROM `$table` WHERE `$fieldname` = ?");
        $statement->execute(array($value));
        $info = $statement->FetchObject();
        
        // If return object
        if ($returnObject) {
            return $info;
        }
        // Return boolean
        if ($info != null) {
            return 1;
        }
        return 0;
    }
    public static function numberOfEntries($table, $fieldname = null, $value = null) {
        $db = new self();
        if ($fieldname == null) {
            $statement = $db->con()->prepare("SELECT * FROM `$table`");
            $statement->execute();
        } else {
            $statement = $db->con()->prepare("SELECT * FROM `$table` WHERE `$fieldname` = ?");
            $statement->execute(array($value));
        }
        $num_rows = $statement->rowCount();
        return $num_rows;
    }
}
?>
