<?php
include 'config.php';
include 'user.php';
$response=array();
$user = new User($pdo);
$is_save = $user->save_logistics_details($_POST["user_id"],$_POST["unitcost"],$_POST["quantity"],$_POST["total"]);
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