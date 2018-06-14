<?php 
ob_start();
header('Content-type: application/json');
ini_set('memory_limit', '-1');

if(isset($_GET['type'])){ 
$type=$_GET['type'];

if($type == 1){
$stmt = $reg_user->runQuery("SELECT *, ip.id as internetID, ip.Name as PackageName, nt.Name as NetworkName FROM internet_pack ip INNER JOIN network_type nt ON nt.id=ip.Network_id");
$stmt->execute();
for($i=0; $stmt1 = $stmt->fetchObject(); $i++){
    $json[]=array("id"=>$stmt1->internetID, "Name"=>($stmt1->PackageName)?$stmt1->PackageName:$stmt1->Speed." ".$stmt1->Data_Transfer." @Rs.".$stmt1->Traiff, "Network"=>$stmt1->NetworkName);
}
}else{
   
$stmt = $reg_user->runQuery("SELECT *, ip.id as PackID,ip.name as PackageName,nt.Name as NetworkName FROM cable_package ip INNER JOIN network_type nt ON nt.id=ip.Provider_id");
$stmt->execute();
for($i=0; $stmt1 = $stmt->fetchObject(); $i++){
    $json[]=array("id"=>$stmt1->PackID, "Name"=>$stmt1->PackageName, "Network"=>$stmt1->NetworkName);
} 
    
}
    
}else{

$stmt = $reg_user->runQuery("SELECT *, ip.id as internetID, ip.Name as PackageName, nt.Name as NetworkName FROM internet_pack ip INNER JOIN network_type nt ON nt.id=ip.Network_id");
$stmt->execute();
for($i=0; $stmt1 = $stmt->fetchObject(); $i++){
    $json[]=array("id"=>$stmt1->internetID, "Name"=>($stmt1->PackageName)?$stmt1->PackageName:$stmt1->Speed." ".$stmt1->Data_Transfer." @Rs.".$stmt1->Traiff, "Network"=>$stmt1->NetworkName);
}
}

echo json_encode($json);
exit();