<?php
include 'config.php';
include 'user.php';
$response=array();
$user = new User($pdo);
$list = $user->get_logistics_info_based_on_id($_POST["id"]);


echo json_encode($list);
?>