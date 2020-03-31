<?php
include 'config.php';
include 'user.php';
$response=array();
$user = new User($pdo);
$is_save = $user->save_user_details($_POST["username"],$_POST["password"],$_POST["mobile"],$_POST["email"],$_POST["address"]);
if($is_save)
{
$response['success']=1;
$response['msg']="User details saved successfully";
}
else
{
$response['success']=0;
$response['msg']="Failed to saved user details";
}
echo json_encode($response);
?>