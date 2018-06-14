<?php
$user = new USER();
$id = $_GET['id'];
$stmt = $user->runQuery("SELECT * FROM user where id='$id'");
$stmt->execute();
for($i=0; $stmt1 = $stmt->fetchObject(); $i++)
{
$result=$stmt1->status;
// echo $result;
if($result == '1')
{
$update=$user->runQuery("UPDATE user SET status='0' where id='$id'");
$update->execute();
if($update)
{
header("Location:user-details-list");
}
}
if($result == '0')
{
$update1=$user->runQuery("UPDATE user SET status='1' where id='$id'");
$update1->execute();
if($update1)
{
header("Location:user-details-list");
}
}
}
?>