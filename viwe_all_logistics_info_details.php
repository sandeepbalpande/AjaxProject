<?php
include 'config.php';
include 'user.php';
$response=array();
$user = new User($pdo);
$list = $user->get_all_logistics_info_details();


echo json_encode($list);
?>