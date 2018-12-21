<?php

include_once(dirname(__FILE__) . '/../../class/include.php');
include_once(dirname(__FILE__) . '/../../auth.php');

$USER1 = new User($_SESSION['id']);
$PERMISSIONS = unserialize($USER1->permission);

$url = explode("/", $_SERVER['REQUEST_URI']);

//    $result = explode(".", $url[4]);
    $result = explode(".", $url[3]);
    $permission = 'delete/' . $result[0];
    $PERID = UserPermission::getIdByPermission($permission);

    if (!(in_array($PERID['id'], $PERMISSIONS))) {
        $data = array("status" => 'accessdenied');
        header('Content-type: application/json');
        echo json_encode($data);
        exit();
    }


if ($_POST['option'] == 'delete') {
    $JOB = new Job($_POST['id']);

    $result = $JOB->delete();

    if ($result) {
        $data = array("status" => TRUE);
        header('Content-type: application/json');
        echo json_encode($data);
    }
}

