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
		    $userid = htmlentities(trim($_REQUEST['userid']));
		    $name = htmlentities(trim($_REQUEST['name']));
	        $email = htmlentities(trim($_REQUEST['email']));
	        $phone = htmlentities(trim($_REQUEST['phone']));
		    $nature_of_complaint = htmlentities(trim($_REQUEST['nature_of_complaint']));
	        $technician = htmlentities(trim($_REQUEST['technician']));
	        $description = htmlentities(trim($_REQUEST['description']));
	        
		    if(empty($userid) || empty($nature_of_complaint) || empty($description)){
			$json = array("response" => 201,"status"=>"error","message"=>"Invalid Data");
			json_enc($json );
			exit();
		    }
		   
			$stmt = $user->runQuery("INSERT INTO complaint(user_id,name,email,phone,nature_of_complaint,technician,description,status) 
			VALUES('$userid','$name','$email','$phone','$nature_of_complaint','$technician','$description','1')");
		    $stmt->execute();
        		$json = array("response"=>200,"status"=>"success","message"=>"Your complaint has been sent successfully!");
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