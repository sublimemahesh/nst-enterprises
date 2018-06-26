<?php

include_once(dirname(__FILE__) . '/../class/include.php');

if ($_POST['option'] == 'GETALLPERMISSIONS') {
    $USERPERMISSION = new UserPermission(NULL);

    $result = $USERPERMISSION->all();

    header('Content-Type: application/json');

    echo json_encode($result);
    exit();
}

if ($_POST['option'] == 'GETUSERPERMISSIONS') {
    $USER = new User($_POST['id']);

    $PERMISSIONS = unserialize($USER->permission);

    header('Content-Type: application/json');

    echo json_encode($PERMISSIONS);
    exit();
}
