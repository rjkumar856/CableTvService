<?php
header('Content-type: application/json');
ini_set('memory_limit', '-1');
ob_start();
include '../db.php';
include '../config.php';

$user = new USER1();
if($_SERVER['REQUEST_METHOD']=="POST"){
    if(!empty($_REQUEST)){
		try{
		    $user_id = trim($_REQUEST['sales_id']);
	        $latitude = trim($_REQUEST['latitude']);
	        $longitude = trim($_REQUEST['longitude']);
	        $ip=$user->get_client_ip();

	        if(empty($user_id) || empty($latitude) || empty($longitude)){
			$json = array("response" => 201,"status"=>"error","message"=>"Invalid Data");
			json_enc($json );
			exit();
		    }

            	$stmt = $user->runQuery("UPDATE sales_location_track SET latitude='$latitude',longitude='$longitude',ip='$ip' WHERE sales_id='$user_id'");
            	$stmt->execute();
            	$json = array("response" => 200, "status" => "succes", "message"=>"Location updated successfully!");
            	json_enc($json);
			    exit();

		}catch(Exception $ex){
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