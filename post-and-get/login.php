<?php

include_once(dirname(__FILE__) . '/../class/include.php');

$USER = new User(NULL);

$username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
$password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);


$res = $USER->login($username, $password);

if ($res) {
    if ($res->isActive) {
        $res = 1;
        header('Location: ../?message=5');
        exit();
    } else {
        $USER->logOut();
        header('Location: ../login.php?message=19');
        exit();
    }
} elseif (empty($username) || empty($password)) {
    header('Location: ../login.php?message=6');
    exit();
}  else {
    header('Location: ../login.php?message=7');
    exit();
}

