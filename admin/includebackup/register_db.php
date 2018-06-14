<?php 

//Register
if(isset($_POST['register']))
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

		public function lasdID()
		{
			$stmt = $this->conn->lastInsertId();
			return $stmt;
		}

		public function redirect($url)
		{
			header("Location: $url");
		}


		public function register($fname,$lname,$email,$password,$phone,$code)
		{
			try
			{						
				$password = md5($password);
				$stmt = $this->conn->prepare("INSERT INTO tbl_admin_customers(cusFname,cusLname,cusEmail,cusPassword,cusPhone,cusCode) 
					VALUES(:cusFname, :cusLname, :cusEmail, :cusPassword, :cusPhone, :cusCode)");
				$stmt->bindparam(":cusFname",$fname);
				$stmt->bindparam(":cusLname",$lname);
				$stmt->bindparam(":cusEmail",$email);
				$stmt->bindparam(":cusPassword",$password);
				$stmt->bindparam(":cusPhone",$phone);
				$stmt->bindparam(":cusCode",$code);
				$stmt->execute();	
				return $stmt;
			}
			catch(PDOException $ex)
			{
				echo $ex->getMessage();
			}
		}




	}

		$reg_user = new USER();
		$fname = trim($_POST['fname']);
		$lname = trim($_POST['lname']);
		$email = trim($_POST['email']);
		$password = trim($_POST['password']);
		$phone = trim($_POST['phone']);

		$code = md5(uniqid(rand()));

		$stmt = $reg_user->runQuery("SELECT * FROM tbl_admin_customers WHERE cusEmail=:cusEmail");
		$stmt->execute(array(":cusEmail"=>$email));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		if($stmt->rowCount() > 0)
		{
			$_SESSION['userExist'] = "<strong>Sorry !</strong>  email already exists , Please Try another one";
            header("Location: registerjan-register");
            exit;
		}
		else
		{
			if($reg_user->register($fname,$lname,$email,$password,$phone,$code))
			{			
				$id = $reg_user->lasdID();		
				$key = base64_encode($id);
				$id = $key;
				$message = "					
				This is $fname,
				<br /><br />
				Welcome to webliststore.in!<br/>
				You Account is Successfully Registered.";

				$subject = "Confirm Registration";

				$reg_user->send_mail($email,$message,$subject);	

				$_SESSION['userRegistered'] = "<strong>Success!</strong>  Your Account is Created Succesfully.
					Please contact Admin to Activate your Account.";

				$reg_user->redirect('registerjan-register');

			}
			else
			{
				echo "sorry , Query could no execute...";
			}		
		}


}	
//Register



?>