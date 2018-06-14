<?php


class Database1
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

class USER1
{   

    private $conn;
    
    public function __construct()
    {
        $database = new Database1();
        $db = $database->dbConnection();
        $this->conn = $db;
    }
    
    public function runQuery($sql)
    {
        $stmt = $this->conn->prepare($sql);
        return $stmt;
    }
    
    public function lasdID()
    {
        $stmt = $this->conn->lastInsertId();
        return $stmt;
    }


    function send_mail($email,$message,$subject)
{                       
			require_once('mailer/class.phpmailer.php');
			$mail = new PHPMailer();
			$mail->IsSMTP(); 
			                 
			$mail->SMTPAuth   = true;                  
			$mail->SMTPSecure = "ssl";                 
			$mail->Host       = "smtp.gmail.com";      
			$mail->Port       = 465;             
			$mail->AddAddress($email);
			$mail->Username="support@worldvisioncable.in";  
			$mail->Password="support@123";            
			$mail->SetFrom('support@worldvisioncable.in','Worldvisioncable');
			$mail->AddReplyTo("support@worldvisioncable.in","Worldvisioncable");
			$mail->Subject    = $subject;
			$mail->MsgHTML($message);
			$mail->Send();
}






    public function post($name, $email, $comment, $id_post)
        {
            try
            {

                $stmt = $this->conn->prepare("INSERT INTO comments (name, email, comment, id_post) 
                                                         VALUES(:name, :email, :comment, :id_post)");
                $stmt->bindparam(":name",$name);
                $stmt->bindparam(":email",$email);
                $stmt->bindparam(":comment",$comment);
                $stmt->bindparam(":id_post",$id_post);
                $stmt->execute();   
                return $stmt;
            }
            catch(PDOException $ex)
            {
                echo $ex->getMessage();
            }
        }



}


?>