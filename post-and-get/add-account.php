<?php

include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/../auth.php');



$ACCOUNT = new Account(NULL);
$VALID = new Validator();


$ACCOUNT->start_date = filter_input(INPUT_POST, 'startdate');
$ACCOUNT->end_date = filter_input(INPUT_POST, 'enddate');
$ACCOUNT->isCleared = 0;
$ACCOUNT->current_invoice_id = 0;
$ACCOUNT->current_job_id = 0;

$VALID->check($ACCOUNT, [
    'start_date' => ['required' => TRUE],
    'end_date' => ['required' => TRUE]
]);

if ($VALID->passed()) {
    $result = $ACCOUNT->create();

    if (!isset($_SESSION)) {
        session_start();
    }
    $VALID->addError("Your data was saved successfully", 'success');
    $_SESSION['ERRORS'] = $VALID->errors();


    header('Location: ' . $_SERVER['HTTP_REFERER']);
} else {

    if (!isset($_SESSION)) {
        session_start();
    }

    $_SESSION['ERRORS'] = $VALID->errors();

    header('Location: ' . $_SERVER['HTTP_REFERER']);
}
