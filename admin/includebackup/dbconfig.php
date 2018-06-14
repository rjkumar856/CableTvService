<?php
class Database
{
        private $host = "localhost";
        private $db_name = "weblist_world_vision_cable";
        private $username = "weblist_worldvis";
        private $password = "world@123!";
    public $conn;
     
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
    
}
?>