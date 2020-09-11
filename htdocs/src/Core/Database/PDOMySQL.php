<?php
/**
 * src/Core/Database/PDOMySQL.php
 *  Classe concrète de connexion à MySQL en utilisant PDO
 */
require_once(__DIR__ . '/AbstractDatabaseLayer.php');

class PDOMySQL extends AbstractDatabaseLayer {
    public function __construct() {
        parent::__construct();
    }

    public function connect() {
        $dsn = 'mysql:host=' . $this->host . ';';
        $dsn .= 'port=' . $this->port . ';';
        $dsn .= 'dbname=' . $this->dbName;
        
        try {
          $this->db = new \PDO($dsn, $this->username, $this->password);  
        } catch(\PDOException $e) {
            echo $dsn;
            var_dump($e);
        }
        
    }
}