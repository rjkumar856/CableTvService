<?php
session_start();
class Database
{
        private $host = "localhost";
        private $db_name = "weblist_store";
        private $username = "weblist_store";
        private $password = "weblist_store@123#";
    public $conn;

    public function __construct()
    {
        $database = new Database();
        $db = $database->dbConnection();
        $this->conn = $db;
    }
    
     
    public function dbConnection()
	{
     
	    $this->conn = null;    
        try
		{
            if (!isset($_SESSION['userSession'])) 
            {
                header('location: /');
            }
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
        }
		catch(PDOException $exception)
		{
            echo "Connection error: " . $exception->getMessage();
        }
         
        return $this->conn;
    }
    public function runQuery($sql)
    {
        $stmt = $this->conn->prepare($sql);
        return $stmt;
    }
}
?>