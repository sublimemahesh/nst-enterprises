<?php

include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/../auth.php');

if (isset($_POST['edit-account'])) {
    $ACCOUNT = new Account($_POST['id']);

    $ACCOUNT->start_date = filter_input(INPUT_POST, 'startdate');
    $ACCOUNT->end_date = filter_input(INPUT_POST, 'enddate');

    $VALID = new Validator();
    $VALID->check($ACCOUNT, [
        'start_date' => ['required' => TRUE],
        'end_date' => ['required' => TRUE]
    ]);

    if ($VALID->passed()) {
        $ACCOUNT->update();

        if (!isset($_SESSION)) {
            session_start();
        }
        $VALID->addError("Your changes saved successfully", 'success');
        $_SESSION['ERRORS'] = $VALID->errors();

        header('Location: ../manage-accounts.php');
    } else {

        if (!isset($_SESSION)) {
            session_start();
        }

        $_SESSION['ERRORS'] = $VALID->errors();

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}

if (isset($_POST['clear-account'])) {
    $ACCOUNT = new Account($_POST['id']);
    $VALID = new Validator();

    $ACCOUNT->isCleared = 1;
    $ACCOUNT->clearAccount();

    if (!isset($_SESSION)) {
        session_start();
    }
    $VALID->addError("Account has been cleared successfully", 'success');
    $_SESSION['ERRORS'] = $VALID->errors();

    header('Location: ../manage-accounts.php');
}

