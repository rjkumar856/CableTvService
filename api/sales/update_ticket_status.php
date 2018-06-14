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
	        $ticket_id = trim($_REQUEST['ticket_id']);
	        $customerid = trim($_REQUEST['customerid']);
	        $mode_of_pay = trim($_REQUEST['mode_of_pay']);
	        $collected_amount = trim($_REQUEST['collected_amount']);
	        $comments = trim($_REQUEST['comments']);
	        $tickets_status = trim($_REQUEST['tickets_status']);
	        
	        $ip=$user->get_client_ip();

	        if(empty($user_id) || empty($ticket_id) || empty($mode_of_pay) || empty($collected_amount) || empty($tickets_status)){
			$json = array("response" => 201,"status"=>"error","message"=>"Invalid Data");
			json_enc($json );
			exit();
		    }

            	$stmt = $user->runQuery("UPDATE sales_tickets SET tickets_status='$tickets_status',mode_of_pay='$mode_of_pay',collected_amount='$collected_amount',comments='$comments',ip='$ip' WHERE id='$ticket_id' AND sales_id='$user_id'");
            	$stmt->execute();
            	$json = array("response" => 200, "status" => "succes", "message"=>"Ticket Status updated successfully!");
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