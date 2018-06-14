<?php
if(isset($_POST['login']))
{
    $user = new USER();
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if($user->login($email,$password))
    {
         if(isset($_SESSION['clicked'])) 
        {
        $user->redirect($_SESSION['clicked']);
        }
        else
        {
        $user->redirect('index');
        }
    }
    else
    {
        $user->redirect('login');
    }
    

}

if (isset($_POST['forgot_password'])) 
{

    session_start();

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

    class USER
    {   

        private $conn;
        
        public function __construct()
        {
            $database = new Database();
            $db = $database->dbConnection();
            $this->conn = $db;
        }
        
        public function runQuery($sql)
        {
            $stmt = $this->conn->prepare($sql);
            return $stmt;
        }

        public function redirect($url)
        {
            header("Location: $url");
        }

        function send_mail($email,$message,$subject)
        {                       
            require_once('mailer/class.phpmailer.php');
            $mail = new PHPMailer();
            $mail->IsSMTP(); 

            $mail->SMTPAuth   = true;                  
            $mail->SMTPSecure = "ssl";                 
            $mail->Host       = "mail.webliststore.in";      
            $mail->Port       = 465;             
            $mail->AddAddress($email);
            $mail->Username="info@webliststore.in";  
            $mail->Password="info@2017";            
            $mail->SetFrom('info@webliststore.in','Weblist Store');
            $mail->AddReplyTo("info@webliststore.in","Weblist Store");
            $mail->Subject    = $subject;
            $mail->MsgHTML($message);
            $mail->Send();
        }

    }


    $email = $_POST['email'];

    $user = new USER();

    $stmt = $user->runQuery("SELECT id FROM tbl_admin_customers WHERE email=:email LIMIT 1");
    $stmt->execute(array(":email"=>$email));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);  

    if($stmt->rowCount() == 1)
    {
        $id = base64_encode($row['id']);
        $code = md5(uniqid(rand()));
        
        $message= "
                   Hello , $email
                   <br /><br />
                   We got requested to reset your password, if you do this then just click the following link to reset your password, if not just ignore                   this email,
                   <br /><br />
                   Click Following Link To Reset Your Password 
                   <br /><br />
                   <a href='https://www.admin.webliststore.in/reset-password?id=$id&code=$code'>click here to reset your password</a>
                   <br /><br />
                   thank you :)
                   ";
        $subject = "Password Reset";
        
        $user->send_mail($email,$message,$subject);
        

        $_SESSION['forgotpassword_succsess'] = "<strong>Success!</strong> we've sent an email to $email.
                    Please click on the password reset link in the email to generate new password.";
        $user->redirect('login');

    }
    else
    {

        $_SESSION['forgotpassword_error'] = "<strong>Sorry!</strong>  this email not found. Please register as new customer";
        $user->redirect('login');
    }
}

?>