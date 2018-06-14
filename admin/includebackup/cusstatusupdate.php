<?php
$user = new USER();
$id = $_GET['id'];
$stmt = $user->runQuery("SELECT * FROM tbl_admin_customers where id='$id'");
$stmt->execute();
for($i=0; $stmt1 = $stmt->fetchObject(); $i++)
{ 
$result=$stmt1->cusStatus;
// echo $result;
if($result == 'Y')
{
$update=$user->runQuery("UPDATE tbl_admin_customers SET cusStatus='N' where id='$id'");
$update->execute();
if($update)
{
header("Location:customer-list");
}
}
if($result == 'N')
{
$update1=$user->runQuery("UPDATE tbl_admin_customers SET cusStatus='Y' where id='$id'");
$update1->execute();
if($update1)
{
header("Location:customer-list");
}
}
}
?>