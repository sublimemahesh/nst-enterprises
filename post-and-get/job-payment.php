<?php

include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/../auth.php');


if (isset($_POST['create-payment'])) {
    $PAYMENT = new JobPayment(NULL);
    $VALID = new Validator();

    $PAYMENT->job = filter_input(INPUT_POST, 'job');
    $PAYMENT->createdAt = filter_input(INPUT_POST, 'createdAt');
    $PAYMENT->payment = filter_input(INPUT_POST, 'payment');
    $PAYMENT->comment = filter_input(INPUT_POST, 'comment');
    $PAYMENT->receipt_no = filter_input(INPUT_POST, 'receipt_no');
    $PAYMENT->receipt_date = filter_input(INPUT_POST, 'receipt_date');

    $VALID->check($PAYMENT, [
        'job' => ['required' => TRUE],
        'createdAt' => ['required' => TRUE],
        'payment' => ['required' => TRUE]
    ]);

    if ($VALID->passed()) {
        $result = $PAYMENT->create();

        if (!isset($_SESSION)) {
            session_start();
        }
        $VALID->addError("Your data was saved successfully", 'success');
        $_SESSION['ERRORS'] = $VALID->errors();

        if ($_POST['back'] == '') {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        } else {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    } else {

        if (!isset($_SESSION)) {
            session_start();
        }

        $_SESSION['ERRORS'] = $VALID->errors();

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}

if (isset($_POST['edit-payment'])) {
    $PAYMENT = new JobPayment($_POST['id']);

    $PAYMENT->payment = filter_input(INPUT_POST, 'payment');
    $PAYMENT->comment = filter_input(INPUT_POST, 'comment');
    $PAYMENT->receipt_no = filter_input(INPUT_POST, 'receipt_no');
    $PAYMENT->receipt_date = filter_input(INPUT_POST, 'receipt_date');

    $VALID = new Validator();
    $VALID->check($PAYMENT, [
        'payment' => ['required' => TRUE]
    ]);

    if ($VALID->passed()) {
        $result = $PAYMENT->update();

        if (!isset($_SESSION)) {
            session_start();
        }
        $VALID->addError("Your changes saved successfully", 'success');
        $_SESSION['ERRORS'] = $VALID->errors();

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {

        if (!isset($_SESSION)) {
            session_start();
        }

        $_SESSION['ERRORS'] = $VALID->errors();

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}

if (isset($_POST['save-arrange'])) {

    foreach ($_POST['sort'] as $key => $img) {
        $key = $key + 1;

        $PAYMENTS = JobPayment::arrange($key, $img);

        if ($PAYMENTS) {
            $VALID = new Validator();
            $VALID->addError("Your changes saved successfully", 'success');
            $_SESSION['ERRORS'] = $VALID->errors();
        }

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}

