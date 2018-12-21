<?php

include_once(dirname(__FILE__) . '/class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

$USER1 = new User($_SESSION['id']);
$PERMISSIONS = unserialize($USER1->permission);

$url = explode("/", $_SERVER['REQUEST_URI']);

//$result = explode(".", $url[2]); //localhost
$result = explode(".", $url[1]);//online
$permission = $result[0];
$PERID = UserPermission::getIdByPermission($permission);

if (!(in_array($PERID['id'], $PERMISSIONS))) {
    header('location: ./access-denied.php');
}


