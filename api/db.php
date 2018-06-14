<?php
error_reporting(0);

class Database1{
private $host = "localhost";
private $db_name = "weblist_world_vision_cable";
private $username = "weblist_worldvis";
private $password = "world@123!";
public $conn;

public function dbConnection1()
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

class USER1{
private $conn;

public function __construct(){
$database = new Database1();
$db = $database->dbConnection1();
$this->conn = $db;
}

public function runQuery($sql){
$stmt = $this->conn->prepare($sql);
return $stmt;
}

public function lasdID(){
$stmt = $this->conn->lastInsertId();
return $stmt;
}


function send_mail($email,$message,$subject)
{
$message_html = '<!DOCTYPE html>
<html lang="en">
<head>
<title>Security Agencies in Bangalore, Karnataka, India</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Security Agencies in Bangalore, Karnataka, India." />
<meta name="keywords" content="Security Agencies in Bangalore, Karnataka, India" />
<meta name="Abstract" content="Best Classifieds Site in Bangalore - Weblist Store">
<meta name="Subject" content="Largest classifieds portal in bangalore">
<meta name="robots" content="index, follow">
<meta name="format-detection" content="telephone=no"/>
<link rel="icon" href="images/favicon.ico" type="image/x-icon">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<style type="text/css">
html, body {  margin: 0; padding: 0; outline: 0; font-family: "Lucida Grande",Verdana,Arial,Helvetica,sans-serif; font-size: 13px; font-weight: normal; width:100%; height:100%; }
body{min-width:320px; margin:0; padding:0; background:#fff; }
*, *:before, *:after { -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box; }
.main { width:100%; margin:0; padding:0; display:block; position:relative; }
.main-center {background: #f6f6f6; width:100%; max-width:800px; margin:0 auto; display:block; }
.center { width:100%; max-width:650px; margin:0 auto; display:block; padding-top:0px; }
</style>
</head>
<body class="background">
<div class="main">
<div class="main-center">
<div class="center">
<table style="border: 0px solid #ccc" border="0" cellpadding="0" cellspacing="0" align="center" width="600" bgcolor="#FFFFFF">
<tbody>
<tr>
    <td width="500" height="80" align="left" bgcolor="#FFFFFF" style="font-size: 0; line-height: 0; padding: 0 10px">
    <span style="font-size: 0; line-height: 0"><a href="https://www.webliststore.in" target="_blank" rel="noreferrer"><img src="https://www.webliststore.in/image/demo/logos/theme_logo.png" border="0"></a></span>
    </td>

    <td width="100" align="right" bgcolor="#FFFFFF" class="m_-8518122674246736728responsive-image" style="font-size: 0; line-height: 0; padding: 0 10px">
    <span style="font-size: 0; line-height: 0"><a href="https://play.google.com/store/apps/details?id=in.webliststore" target="_blank" rel="noreferrer"><img src="https://www.webliststore.in/image/icon-andriod.png" width="22" height="24" border="0"></a></span>
    </td>

    <td width="25" align="right" bgcolor="#FFFFFF" style="font-size: 0; line-height: 0; padding: 0 10px 0 0">
    <a href="https://itunes.apple.com/us/app/weblist-store-classified-and-online-shopping/id1256935760?ls=1&mt=8" target="_blank" rel="noreferrer"><img src="https://www.webliststore.in/image/icon-ios.png" width="22" height="24" border="0"></a>
    </td>
</tr>
<tr>
    <td colspan="4" bgcolor="#bf023c" style="padding: 30px; font-size: 16px;font-weight: bold; text-align: center; color: #fff"><span style="color:#fff;">Weblist Store! </span> Now Sell, Buy, List and shop in the Best Way</td>
</tr>
<tr>
    <td colspan="4" style="padding: 30px 20px 10px; font-size: 14px">
    <div>'.$message.'</div>
    <br>
    <br>
    <div>Grow your business online. Grow your business with <a href="https://www.webliststore.in" style="color:#de1d3c;"><b>Weblist Store</b></a>.</div>
    <br>
    </td>
</tr>
<tr><td colspan="4" style="padding: 20px; font-size: 14px"><div style="font-size: 14px"> <span>Regards,</span></div>
    <div style="font-size: 14px; padding-top: 10px"> <span>Team Weblist Store</span> </div></td>
</tr>
<tr>
<td colspan="4" style="padding: 10px 20px; font-size: 14px;background: #bf023c;color:#fff;font-size: 10px;">
<p>The information contained in this e-mail is private & confidential and may also be legally privileged. If you are not the intended recipient of this mail, please notify us, preferably by e-mail; and do not read, copy or disclose the contents of this message to anyone. Whilst we have taken reasonable precautions to ensure that any attachment to this e-mail has been swept for viruses, e-mail communications cannot be guaranteed to be secure or error free, as information can be corrupted, intercepted, lost or contain viruses. We do not accept liability for such matter or their consequences.</p>
</td>
</tr>
<tr>
    <td colspan="4" bgcolor="#5b5b5b" style="padding: 0; text-align: center">
    <a href="https://www.webliststore.in/support-app"><img src="https://www.webliststore.in/image/app-download-mail.jpg" alt="app-download" border="0" usemap="#m_-8518122674246736728_Map"></a>
    </td>
</tr>
</tbody>
</table>

</div>
</div>
</div>
</body>
</html>';

$this->send_mail_post($email,$message_html,$subject);
}


function send_mail_post($email,$message,$subject)
{                       
require_once(DIR_APPLICATION.'mailer/class.phpmailer.php');
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
$mail->AddBCC("form@webliststore.in", "Weblist Store");
$mail->Subject    = $subject;
$mail->MsgHTML($message);
$mail->Send();
}

public function sendSMS($sender, $message="Hello"){
            $message= $message;
            $senderID="WEBLST";
            $mobiles=$sender;
            $url= "http://sms.bulksmsserviceproviders.com/api/send_http.php?authkey=2e3c63f4c3fe3ed5a13cf1e7ff3b7c3a&mobiles=".urlencode($mobiles)."&message=".urlencode($message)."&sender=WEBLST&route=B";
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $curl_scraped_page = curl_exec($ch);
            curl_close($ch);

}


public function redirect($url)
{
header("Location: $url");
}

public function get_client_ip()
		{
    		$ipaddress = '';
    		if (isset($_SERVER['HTTP_CLIENT_IP'])){
        		$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    		}
    		else if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
        		$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    		}
    		else if(isset($_SERVER['HTTP_X_FORWARDED'])){
        		$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    		}
    		else if(isset($_SERVER['HTTP_FORWARDED_FOR'])){
        		$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    		}
    		else if(isset($_SERVER['HTTP_FORWARDED'])){
        		$ipaddress = $_SERVER['HTTP_FORWARDED'];
    		}
    		else if(isset($_SERVER['REMOTE_ADDR'])){
        		$ipaddress = $_SERVER['REMOTE_ADDR'];
    		}
    		else{
        		$ipaddress = 'UNKNOWN';
    		}
    		return $ipaddress;
		}

}

?>