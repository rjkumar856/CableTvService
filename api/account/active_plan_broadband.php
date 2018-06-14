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
		    
			$stmt = $user->runQuery("SELECT *, ip.id as packageId, ip.Name as Package_name, nt.Name as Provider_name FROM user_has_broadband ub INNER JOIN internet_pack ip ON ip.id=ub.package_id INNER JOIN network_type nt ON nt.id=ip.Network_id WHERE user_id='$username'");
			$stmt->execute();
			if($stmt->rowCount()){
        			for($i=0;$object=$stmt->fetch(PDO::FETCH_ASSOC);$i++){
			                $json = array("response"=>200,"status"=>"success","userid"=>$object['user_id'],"packageId"=>$object['packageId'],"due_date"=>$object['due_date'],"Package_name"=>($object['Package_name'])?$object['Package_name']:$object['Speed']."-".$object['Data_Transfer']." @Rs.".$object['Traiff'],
			                "Network_id"=>$object['Network_id'],"Provider_name"=>$object['Provider_name'],"Location"=>$object['Location'],"Speed"=>$object['Speed'],"Data_Transfer"=>$object['Data_Transfer'],
			                "After_Fup"=>$object['After_Fup'],"Traiff"=>$object['Traiff'],"GST"=>$object['GST'],"Total"=>$object['Total'],"Validity"=>$object['Validity']);
                            json_enc($json);
                            exit();
        			}
		        }else{
                    $json = array("response"=>202,"status"=>"success","message"=>"No active Broadband plan for this customer");
                    json_enc($json);
                    exit();
                    }
		        
		}catch(PDOException $ex){
			$json = array("response"=>204,"status"=>"error","message"=>$ex->getMessage());
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