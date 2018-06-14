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
		    
			$stmt = $user->runQuery("SELECT *, cp.id as packageId, cp.name as Package_name, pr.name as Provider_name FROM user_has_cable uc INNER JOIN cable_package cp ON cp.id=uc.package_id INNER JOIN provider pr ON pr.id=cp.Provider_id WHERE uc.user_id='$username'");
			$stmt->execute();
			if($stmt->rowCount()){
        			for($i=0;$object=$stmt->fetch(PDO::FETCH_ASSOC);$i++){
			                $json = array("response"=>200,"status"=>"success","userid"=>$object['user_id'],"packageId"=>$object['packageId'],"due_date"=>$object['due_date'],"Package_name"=>$object['Package_name'],
			                "Provider_name"=>$object['Provider_name'],"price"=>$object['price'],"description"=>$object['description'],"Validity"=>$object['Validity']);
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