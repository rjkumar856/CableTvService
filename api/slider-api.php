<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin:*');
ini_set('memory_limit', '-1');
error_reporting(0);

include 'db.php';
include 'config.php';

$user = new USER1();
	try
		{
			$response['result']=array(DIR_SYSTEM."assets/images/app-slider/banner-1.jpg", 
			DIR_SYSTEM."assets/images/app-slider/banner-2.jpg", 
			DIR_SYSTEM."assets/images/app-slider/banner-3.jpg");
			echo json_enc($response);
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
exit;
if($jfo==null)die(json_enc("400"));

function json_enc($str)
{
if(is_array($str))
{
echo $json_response = json_encode($str);
}
else
{
$response['response'] = $str;
echo $json_response = json_encode($response);
}
return;
}


?>