<?php
header('Content-type: application/json');
ini_set('memory_limit', '-1');

include '../db.php';
include '../config.php';
$user = new USER1();

if($_SERVER['REQUEST_METHOD']=="POST"){
    if(!empty($_REQUEST)){
    		try{
		    $userid = trim($_REQUEST['sales_id']);

		    if(empty($userid)){
			$json = array("response" => 201, "status" => "Invalid Data");
			json_enc($json );
			exit();
		    }
		    
		    $json = array("response" => 200, "status" => "succes", "message"=>"Data Not Available","items"=>array());
				$stmt = $user->runQuery("SELECT * FROM sales_location_track WHERE sales_id='$userid'");
				$stmt->execute();
				for($i = 0; $object = $stmt->fetch(PDO::FETCH_ASSOC); $i++){
				    $json['message']="Data Available";
				    $active="Inactive";
				    if(isset($object['date_modified'])){ 
				        $old_time=strtotime($object['date_modified']); 
				        $current_time=time(); 
				        $diff_time=$current_time - $old_time; 
				        $mints=round($diff_time/60);
        				    if($mints <= 5){
        				        $active="Active";
        				    }else{
        				        $active="Inactive";
        				    }
				    }
				    
					$json['items'][]= array("id"=>$object['id'], "sales_id"=>$object['sales_id'],"latitude"=>$object['latitude'],"longitude"=>$object['longitude'],
					"last_date_modified"=>$object['date_modified'],"current_time"=>date('Y-m-d H:i:s',time()),"status"=>$active);
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