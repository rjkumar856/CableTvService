<?php
header('Content-type: application/json');
ini_set('memory_limit', '-1');

include '../db.php';
include '../config.php';
$user = new USER1();

if($_SERVER['REQUEST_METHOD']=="POST"){
    if(!empty($_REQUEST)){
    		try{
		    $userid = trim($_REQUEST['user_id']);

		    if(empty($userid)){
			$json = array("response" => 201, "status" => "Invalid Data");
			json_enc($json );
			exit();
		    }
		    
		    $json = array("response" => 200, "status" => "succes", "message"=>"Data Not Available","items"=>array());
				$stmt = $user->runQuery("SELECT *,us.id as usrID,uc.package_id as cablePackID,cp.name as cableName,uc.due_date as cableDue_date,cp.price as cableAmount, ub.package_id as broadbandPackID,ip.Name as broadbandName,ub.due_date as broadbandDue_date,ip.Total as broadbandAmount FROM user us LEFT JOIN profile pr ON pr.user_id=us.id 
				LEFT JOIN user_has_cable uc ON uc.user_id=us.id LEFT JOIN cable_package cp ON uc.package_id=cp.id 
				LEFT JOIN user_has_broadband ub ON ub.user_id=us.id LEFT JOIN internet_pack ip ON ip.id=ub.package_id 
				WHERE us.id='$userid'");
				$stmt->execute();
				for($i = 0; $object = $stmt->fetch(PDO::FETCH_ASSOC); $i++){
				    $json['message']="Data Available";
					$json['items'][]= array("user_id"=>$object['usrID'],"name"=>$object['full_name'],"email"=>$object['email'],"phone"=>$object['phone'],"address"=>$object['address_1'],"door_no"=>$object['door_no'],
					"cable_package_id"=>$object['cablePackID'],"cable_package_name"=>$object['cableName'],"cable_due_date"=>$object['cableDue_date'],"cable_amount"=>$object['cableAmount'],
					"broadband_package_id"=>$object['broadbandPackID'],"broadband_package_name"=>(isset($object['broadbandName']))?(($object['broadbandName'])?$object['broadbandName']:$object['Speed']."-".$object['Data_Transfer']." @Rs.".$object['Traiff']):'',"broadband_due_date"=>$object['broadbandDue_date'],
					"broadband_amount"=>$object['broadbandAmount']);
				}
			json_enc($json);
		}
		catch(Exception $ex){
			$json = array("response" => 202,"status"=>"error","message"=>$ex->getMessage());
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