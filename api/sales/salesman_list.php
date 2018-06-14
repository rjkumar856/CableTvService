<?php
header('Content-type: application/json');
ini_set('memory_limit', '-1');

include '../db.php';
include '../config.php';
$user = new USER1();

if($_SERVER['REQUEST_METHOD']=="POST"){
    		try{
		    $json = array("response" => 200, "status" => "succes", "message"=>"Data Not Available","items"=>array());
		    
				$stmt = $user->runQuery("SELECT * FROM tbl_admin_customers WHERE role='2' AND status='1'");
				$stmt->execute();
				for($i = 0; $object = $stmt->fetch(PDO::FETCH_ASSOC); $i++){
				    $json['message']="Data Available";
					$json['items'][]= array("sales_id"=>$object['id'], "user_id"=>$object['user_id'],"name"=>$object['name'], 
					"email"=>$object['email'],"mobile"=>$object['mobile'],"address"=>$object['address']);
				}
			json_enc($json);
		}
		catch(Exception $ex){
			$json = array("response" => 202,"status"=>"error","message"=>$ex->getMessage());
			json_enc($json);
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