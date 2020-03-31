<?php

include 'config.php';
include 'user.php';
$user = new User($pdo);
$list = $user->get_users();

foreach($list as $test) {
    echo $test["username"],"\n";
}

?>