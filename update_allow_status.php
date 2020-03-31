<?php
include 'config.php';
include 'user.php';
$response=array();
$user = new User($pdo);
$list = $user->update_allow_status($_POST["id"],$_POST["is_allowed"]);
 if($list)
 {
 	$response['success']=1;
 	$response['msg']="updated";
 }
 else
 {
 	$response['success']=0;
 	$response['msg']="Failed to update";
 }
echo json_encode($response);


?>