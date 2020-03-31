<?php
include 'config.php';
include 'user.php';
$response=array();
$user = new User($pdo);
$list = $user->get_logistics_info_details($_POST["user_id"]);


echo json_encode($list);
?>