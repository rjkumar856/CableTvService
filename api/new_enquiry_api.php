<?php
header('Content-type: application/json');
ini_set('memory_limit', '-1');
ob_start();
error_reporting(0);
include 'db.php';
include 'config.php';

$user = new USER1();
if($_SERVER['REQUEST_METHOD']=="POST"){
    if(!empty($_REQUEST)){
		try{
		    $name = htmlentities(trim($_REQUEST['name']));
	        $email = htmlentities(trim($_REQUEST['email']));
	        $phone = htmlentities(trim($_REQUEST['phone']));
	        $city = htmlentities(trim($_REQUEST['city']));
	        $message = htmlentities(trim($_REQUEST['message']));
	        
		    if(empty($name) || empty($email) || empty($phone) || empty($city) || empty($message)){
			$json = array("response" => 201,"status"=>"error","message"=>"Invalid Data");
			json_enc($json );
			exit();
		    }
		   
			$stmt = $user->runQuery("INSERT INTO contact(name,email,phone,city,address,message,status) 
			VALUES('$name','$email','$phone','$city','','$message','1')");
		    $stmt->execute();
        		$json = array("response"=>200,"status"=>"success","message"=>"Your Enquiry has been sent successfully!");
        		json_enc($json);
        		exit();
		        
		}catch(PDOException $ex){
			$json = array("response"=>206,"status"=>"error","message"=>$ex->getMessage());
			json_enc($json);
			exit();
		}
    }else
    {
    $json = array("response"=>203,"status"=>"error","message"=>"Empty Data");
    json_enc($json);
    exit();
    }
}
else
{
$json = array("response"=>202,"status"=>"error","message"=>"Wrong method!");
json_enc($json);
}
exit;

function json_enc($str){
	if(is_array($str)){
		echo $json_response = json_encode($str);
	}
	else{
		$response['response'] = $str;
		echo $json_response = json_encode($response);
	}
	return;
}
?>