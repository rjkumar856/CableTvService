<?php
header('Content-type: application/json');
ini_set('memory_limit', '-1');

include '../db.php';
include '../config.php';
$user = new USER1();

if($_SERVER['REQUEST_METHOD']=="POST"){
    if(!empty($_REQUEST)){
    		try{
		    $username = htmlentities(trim($_REQUEST['userid']));
		    if(empty($username)){
			$json = array("response" => 201, "status" => "Invalid Data");
			json_enc($json );
			exit();
		    }
		    
		    $json = array("response" => 200, "status" => "succes", "message"=>"Data Not Available","items"=>'');
				$stmt = $user->runQuery("SELECT * FROM complaint cp WHERE cp.user_id='$username' AND status='1'");
				$stmt->execute();
				for($i = 0; $object = $stmt->fetch(PDO::FETCH_ASSOC); $i++)  
				{
				    $json['message']="Data Available";
					$json['items'][]= array("id"=>$object['id'], "name"=>$object['name'], "email"=>$object['email'],"phone"=>$object['phone'],"nature_of_complaint"=>$object['nature_of_complaint'],
					"technician"=>$object['technician'],"description"=>$object['description'],"status"=>$object['complaint_status'],"created_on"=>$object['created_at']);
				}
			json_enc($json);
		}
		catch(PDOException $ex){
			$json = array("response" => 202,"username"=>$username, "status" =>$ex->getMessage());
			json_enc($json);
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
$json = array("response"=>204,"status"=>"error","message"=>"Wrong method!");
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