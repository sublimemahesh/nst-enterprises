<?php

include_once(dirname(__FILE__) . '/../../class/include.php');
include_once(dirname(__FILE__) . '/../../auth.php');


if ($_POST['option'] == 'delete') {
    $ACCOUNT = new Account($_POST['id']);

    $result = $ACCOUNT->delete();

    if ($result) {
        $data = array("status" => TRUE);
        header('Content-type: application/json');
        echo json_encode($data);
    }
}
if ($_POST['option'] == 'clear') {
    $ACCOUNT = new Account($_POST['id']);

    $ACCOUNT->isCleared = 1;
    $result = $ACCOUNT->clearAccount();

    if ($result) {
        $data = array("status" => TRUE);
        header('Content-type: application/json');
        echo json_encode($data);
    }
}

