<?php
ob_start();
class Database
{

		private $host = "localhost";
		private $db_name = "weblist_store";
		private $username = "weblist_store";
		private $password = "weblist_store@123#";
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

}



$user = new USER();

if(empty($_GET['id']) && empty($_GET['code']))
{
	$user->redirect('login-register');
}

if(isset($_GET['id']) && isset($_GET['code']))
{
	$id = base64_decode($_GET['id']);
	$code = $_GET['code'];
	
	$stmt = $user->runQuery("SELECT * FROM tbl_admin_customers WHERE id=:id AND cusCode=:code");
	$stmt->execute(array(":id"=>$id,":code"=>$code));
	$rows = $stmt->fetch(PDO::FETCH_ASSOC);
	
	if($stmt->rowCount() == 1) 
	{
		if(isset($_POST['password_reset']))
		{
			$pass = $_POST['password'];
			$cpass = $_POST['confirm_password'];
			
			if($cpass!==$pass)
			{

				$_SESSION['passwordResetError'] = "Password Doesn't match.";
			}
			else
			{
				$password = md5($cpass);
				$stmt = $user->runQuery("UPDATE tbl_admin_customers SET cusPassword=:cuspass WHERE id=:id");
				$stmt->execute(array(":cuspass"=>$password,":id"=>$rows['id']));
				
				$_SESSION['passwordResetSuccess'] = "<strong>Success! </strong>password changed now you can login with your new password wait while we redirect you to our login page";
                 header("refresh:7;login");
			}
		}	
	}
	else
	{
		$_SESSION['accountNotFound'] = "No Account Found, Try again";
				
	}
	
	
}

?>
<link rel="stylesheet" href="vendor/bootstrap4/css/bootstrap.min.css">
		<link rel="stylesheet" href="vendor/themify-icons/themify-icons.css">
		<link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="css/core.css">

	<body class="img-cover" style="background-image: url(img/photos-1/2.jpg);">
		
		<div class="container-fluid">
			<div class="sign-form">
				<div class="row">
					<div class="col-md-4 offset-md-4 px-3">
						<div class="box b-a-0">
							<div class="logodiv">
								<img src="img/lrlogo.png">
							</div>
<?php 
if(isset($_SESSION['passwordResetError'])) 
{ ?>
<div class='alert alert-warning'>
<button class='close' data-dismiss='alert'>&times;</button>
<?php echo $_SESSION['passwordResetError']; ?>
</div>
<?php 
unset($_SESSION['passwordResetError']);
}
if(isset($_SESSION['passwordResetSuccess'])) 
{ ?>
<div class='alert alert-success'>
<button class='close' data-dismiss='alert'>&times;</button>
<?php echo $_SESSION['passwordResetSuccess']; ?>
</div>
<?php 
unset($_SESSION['passwordResetSuccess']);
}
if(isset($_SESSION['accountNotFound'])) 
{ ?>
<div class='alert alert-warning'>
<button class='close' data-dismiss='alert'>&times;</button>
<?php echo $_SESSION['accountNotFound'].""."Or click link to register as a new customer"; ?>
<a href="login-register"></a>
</div>
<?php 
unset($_SESSION['accountNotFound']);
}
?>

<form action="#" method="post" enctype="multipart/form-data" class="form-material mb-1">
<div class="form-group">
<input type="password" class="form-control" id="input-npassword" placeholder="New Password" value="" name="password">
</div>
<div class="form-group">
<input type="password" class="form-control" id="input-cnpassword" placeholder="Confirm New Password" value="" name="confirm_password">
</div>
<div class="px-4 form-group mb-0">
	<input type="submit" value="Change Password" name="password_reset" class="btn btn-purple btn-block text-uppercase">
</div></div>
</form>
</div>
</div>

</div>
</div>
</div>