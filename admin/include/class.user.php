<?php
require_once 'dbconfig.php';

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
	
	
	public function register($fname,$lname,$email,$password,$phone,$dob,$company,$address1,$address2,$city,$state,$pincode,$newsletter,$code,$bannerpic,$pic,$role)
	{
		try
		{						
			$password = md5($password);
			$stmt = $this->conn->prepare("INSERT INTO tbl_admin_customers(cusFname,cusLname,cusEmail,cusPassword,cusPhone,cusDob,cusCompany,cusAddress1,cusAddress2,cusCity,cusState,cusPincode,cusNewsletter,cusCode,cusBannerpic,cusPic,role) 
			                                             VALUES(:cusFname, :cusLname, :cusEmail, :cusPassword, :cusPhone, :cusDob, :cusCompany, :cusAddress1, :cusAddress2, :cusCity, :cusState, :cusPincode, :cusNewsletter, :cusCode, :cusBannerpic, :cusPic, :role)");
			$stmt->bindparam(":cusFname",$fname);
			$stmt->bindparam(":cusLname",$lname);
			$stmt->bindparam(":cusEmail",$email);
			$stmt->bindparam(":cusPassword",$password);
			$stmt->bindparam(":cusPhone",$phone);
			$stmt->bindparam(":cusDob",$dob);
			$stmt->bindparam(":cusCompany",$company);
			$stmt->bindparam(":cusAddress1",$address1);
			$stmt->bindparam(":cusAddress2",$address2);
			$stmt->bindparam(":cusCity",$city);
			$stmt->bindparam(":cusState",$state);
			$stmt->bindparam(":cusPincode",$pincode);
			$stmt->bindparam(":cusNewsletter",$newsletter);
			$stmt->bindparam(":cusCode",$code);
			$stmt->bindparam(":cusBannerpic",$bannerpic);
			$stmt->bindparam(":cusPic",$pic);
			$stmt->bindparam(":role",$role);
			$stmt->execute();	
			return $stmt;
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}
	
	
	public function login($email,$upass)
	{
		try
		{
			$stmt = $this->conn->prepare("SELECT * FROM tbl_admin_customers WHERE email=:email_id AND role='1'");
			$stmt->execute(array(":email_id"=>$email));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
			
			if($stmt->rowCount() > 0)
			{
				if($userRow['status']=="1")
				{
					if($userRow['password']==md5($upass))
					{
						$_SESSION['userSession'] = $userRow['id'];
						return true;
					}
					else
					{
						$_SESSION['userPasswordWrong'] = "Password dint matched with the given email id";
						header("Location: login");
						exit;
					}
				}
				else
				{
					$_SESSION['userInactive'] = "User is inactive we have sent a email please check to active.";
					header("Location: login");
					exit;
				}	
			}
			else
			{
				$_SESSION['userNotExist'] = "User not found please register as new user";
				header("Location: login");
				exit;
			}		
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}
	
	
	public function is_logged_in()
	{
		if(isset($_SESSION['userSession']))
		{
			return true;
		}
	}
	
	public function redirect($url)
	{
		header("Location: $url");
	}
	
	public function logout()
	{
		session_destroy();
		$_SESSION['userSession'] = false;
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

	public function cities($city)
	{
		try
		{
			$stmt = $this->conn->prepare("SELECT * FROM cities WHERE state_id=:state_id");
			$stmt->execute(array(":state_id"=>$city));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
			if($stmt->rowCount() == 1)
			{
				return $stmt;
			}		
				
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}
}