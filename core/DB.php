<?php
class DatabaseConnection {
    private static $instance = null;
    protected $pdo;

private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $dbname = 'mutah_form';


    public function __construct() {

        $host = 'localhost';
        $username = 'root';
        $password = '';
        $dbname = 'mutah_form';

        try {
            $this->pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public static function getInstance() {
        $host = 'localhost';
        $username = 'root';
        $password = '';
        $dbname = 'mutah_form';


        if (self::$instance === null) {
            self::$instance = new DatabaseConnection($host, $dbname, $username, $password);
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->pdo;
    }
}
