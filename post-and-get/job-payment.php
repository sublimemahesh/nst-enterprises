<?php

include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/../auth.php');


if (isset($_POST['create-payment'])) {
    $PAYMENT = new JobPayment(NULL);
    $VALID = new Validator();

    $PAYMENT->job = filter_input(INPUT_POST, 'job');
    $PAYMENT->createdAt = filter_input(INPUT_POST, 'createdAt');
    $PAYMENT->customer_name = filter_input(INPUT_POST, 'name');
    $PAYMENT->payment = filter_input(INPUT_POST, 'payment');

    $VALID->check($PAYMENT, [
        'job' => ['required' => TRUE],
        'createdAt' => ['required' => TRUE],
        'customer_name' => ['required' => TRUE],
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

    $PAYMENT->customer_name = filter_input(INPUT_POST, 'name');
    $PAYMENT->payment = filter_input(INPUT_POST, 'payment');

    $VALID = new Validator();
    $VALID->check($PAYMENT, [
        'customer_name' => ['required' => TRUE],
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

