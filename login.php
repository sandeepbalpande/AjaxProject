<?php
include 'config.php';
include 'user.php';
$response=array();
$user = new User($pdo);
$list = $user->check_login_details($_POST["email"],$_POST["password"]);
 if($list)
 {
 	$response['success']=$list;
 	$response['msg']="Valid user";
 }
 else
 {
 	$response['success']=0;
 	$response['msg']="invalid user";
 }
echo json_encode($response);
?>