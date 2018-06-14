<?php
header('Content-type: application/json');
ini_set('memory_limit', '-1');

include '../db.php';
include '../config.php';
$user = new USER1();

if($_SERVER['REQUEST_METHOD']=="POST"){
    		try{
		    $json = array("response" => 200, "status" => "succes", "message"=>"Data Not Available","items"=>array());
		    
				$stmt = $user->runQuery("SELECT *,st.date_added as Ticdate_added,st.date_modified as Ticdate_modified,us.email as CustEmail,us.phone as CustPhone,ac.id as SalesID, ac.name as SalesName,st.user_id as usrID,st.id as TicketID,uc.package_id as cablePackID,cp.name as cableName,uc.due_date as cableDue_date, ub.package_id as broadbandPackID,ip.Name as broadbandName,ub.due_date as broadbandDue_date FROM sales_tickets st 
				INNER JOIN tbl_admin_customers ac ON ac.id=st.sales_id INNER JOIN user us ON us.id=st.user_id LEFT JOIN profile pr ON pr.user_id=st.user_id 
				LEFT JOIN user_has_cable uc ON uc.user_id=st.user_id LEFT JOIN cable_package cp ON uc.package_id=cp.id 
				LEFT JOIN user_has_broadband ub ON ub.user_id=st.user_id LEFT JOIN internet_pack ip ON ip.id=ub.package_id 
				WHERE st.date=date(NOW()) ORDER BY st.date_added DESC");
				$stmt->execute();
				for($i = 0; $object = $stmt->fetch(PDO::FETCH_ASSOC); $i++){
				    $json['message']="Data Available";
					$json['items'][]= array("TicketID"=>$object['TicketID'], "sales_id"=>$object['SalesID'],"Salesman_name"=>$object['SalesName'], 
					"user_id"=>$object['usrID'],"CustName"=>$object['full_name'],"CustEmail"=>$object['CustEmail'],"CustPhone"=>$object['CustPhone'],
					"CustAddress"=>$object['address_1'],"CustDoor_no"=>$object['door_no'],"cable_package_id"=>$object['cablePackID'],"cable_package_name"=>$object['cableName'],"cable_due_date"=>$object['cableDue_date'],
					"broadband_package_id"=>$object['broadbandPackID'],"broadband_package_name"=>(isset($object['broadbandName']))?(($object['broadbandName'])?$object['broadbandName']:$object['Speed']."-".$object['Data_Transfer']." @Rs.".$object['Traiff']):'',"broadband_due_date"=>$object['broadbandDue_date'],
					"due_amount"=>$object['amount'],"mode_of_pay"=>$object['mode_of_pay'],"collected_amount"=>$object['collected_amount'],"comments"=>$object['comments'],"status"=>$object['tickets_status'],
					"created_on"=>$object['Ticdate_added'],"date_modified"=>$object['Ticdate_modified']);
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