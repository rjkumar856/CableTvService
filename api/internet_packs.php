<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin:*');
ini_set('memory_limit', '-1');
error_reporting(0);

include 'db.php';
include 'config.php';

$user = new USER1();

if($_SERVER['REQUEST_METHOD']=="GET"){
    
		try{
		    $json = array("response" => 200, "status" => "succes", "message"=>"Data Not Available");
			$stmt = $user->runQuery("SELECT * FROM network_type WHERE package_type='1'");
			$stmt->execute();
			for($i = 0;  $object = $stmt->fetch(PDO::FETCH_ASSOC); $i++)
			{
				 $json['message'] ="Data Not Available";
				 $json["Network_type"][]=$object['Name'];
				$stmt1 = $user->runQuery("SELECT * FROM internet_pack WHERE Network_id='".$object['id']."' AND status='1'");
				$stmt1->execute();
				for($i = 0;  $object1 = $stmt1->fetch(PDO::FETCH_ASSOC); $i++)  
				{
					$json[$object['Name']][] = array("id"=>$object1['id'],"Speed"=>$object1['Speed'],"Data_Transfer"=>$object1['Data_Transfer'],"After_Fup"=>$object1['After_Fup'],
					"Traiff"=>$object1['Traiff'],"GST"=>$object1['GST'],"Total"=>$object1['Total'],"Validity"=>$object1['Validity'],"GST"=>$object1['GST']);
				}
				
			}
			
			json_enc($json);
		}
		
		catch(PDOException $ex){
			$json = array("response" => 202, "status" =>$ex->getMessage());
			json_enc($json);
		}
}
else
{
$json = array("response" => 202, "status" => "Empty Data");
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