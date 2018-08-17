<?php
include_once(dirname(__FILE__) . '/../class/include.php');

if ($_POST['option'] === 'GETACTIVEACCOUNT') {
    
    $ACCOUNT = Account::getLastUnClearedAccount();
    
    if(empty($ACCOUNT)) {
        $cleared = TRUE;
    } else {
        $cleared = FALSE;
    }

    header('Content-Type: application/json');

    echo json_encode($cleared);
    exit();
}