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
		    $json = array("response" => 200, "status" => "success", "message"=>"Data Not Available");
			$stmt = $user->runQuery("SELECT *, ca.Name as package_name FROM channel_package cp INNER JOIN cable_package ca ON ca.id=cp.cp_id INNER JOIN channel ch ON ch.id=cp.channel_id INNER JOIN genre ge ON ge.id=ch.genre_id WHERE cp.status='1' AND ch.status='1' AND ge.status='1' ORDER BY ge.priority ASC, cp.cp_id ASC");
			$stmt->execute();
			for($i = 0;  $object = $stmt->fetch(PDO::FETCH_ASSOC); $i++)
			{
				 //$json[]=$object;
				 $json[$object['package_name']]['price']=$object['price'];
				 $json[$object['package_name']]['Validity']=$object['Validity'];
				 $json[$object['package_name']][$object['name']]['description']=$object['description'];
				 $json[$object['package_name']][$object['name']]['name']=$object['name'];
				 
				$json[$object['package_name']][$object['name']][] = array("id"=>$object['id'],"cp_id"=>$object['cp_id'],"channel_id"=>$object['channel_id'],"Provider_id"=>$object['Provider_id'],
					"channel_name"=>$object['channel_name'],"channel_image"=>"https://www.worldvisioncable.in/uploads/channels/".$object['channel_image']);
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