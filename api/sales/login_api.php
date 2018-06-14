<?php
header('Content-type: application/json');
ini_set('memory_limit', '-1');

include '../db.php';
include '../config.php';
$user = new USER1();

if($_SERVER['REQUEST_METHOD']=="POST"){
    
    if(!empty($_REQUEST)){
    
		try{
		    $username = htmlentities(trim($_REQUEST['username']));
	        $password = trim($_REQUEST['password']);
	        
		    if(empty($username) || empty($password)){
			$json = array("response" => 201, "status" => "Invalid Data");
			json_enc($json );
			exit();
		    }
		    
			$stmt = $user->runQuery("SELECT * FROM tbl_admin_customers WHERE user_id='$username' OR email='$username'");
			$stmt->execute();
			if($stmt->rowCount()){
        			for($i=0;$object=$stmt->fetch(PDO::FETCH_ASSOC);$i++){
        			    if($object['password'] === md5($password)){
        			        
        			        if($object['status'] == 1){
        			            
        			            $stmt_details = $user->runQuery("SELECT * FROM tbl_admin_customers WHERE user_id='$username'");
			                    $stmt_details->execute();
			                    if($object_details=$stmt_details->fetch(PDO::FETCH_ASSOC)){
        			                $json = array("response"=>200,"status"=>"success","message"=>"Logged in successfully!","id"=>$object_details['id'],"user_id"=>$object_details['user_id'],
        			                "name"=>$object_details['name'],"email"=>$object_details['email'],"mobile"=>$object_details['mobile'],"address"=>$object_details['address'],"role_type"=>$object_details['role']);
                                    json_enc($json);
                                    exit();
			                    }
            			    }else{
                                $json = array("response"=>207,"status"=>"error","message"=>"Username was disabled. Please contact Management Provider!");
                                json_enc($json);
                                exit();
                                }
        			        
        			    }else{
                            $json = array("response"=>205,"status"=>"error","message"=>"Invalid Password!");
                            json_enc($json);
                            exit();
                            }
        			}
        			
        			json_enc($json);
		        }else{
                    $json = array("response"=>204,"status"=>"error","message"=>"Invalid Username!");
                    json_enc($json);
                    exit();
                    }
		        
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