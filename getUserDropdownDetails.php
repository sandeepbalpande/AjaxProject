<?php
include 'config.php';
include 'user.php';
$response=array();
$user = new User($pdo);
$list = $user->getUserDropdownDetails();


echo json_encode($list);
?>