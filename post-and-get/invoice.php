<?php

include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/../auth.php');


if (isset($_POST['create-invoice'])) {
    $INVOICE = new Invoice(NULL);
    $VALID = new Validator();

    $INVOICE->job_costing_card = filter_input(INPUT_POST, 'job_costing_card');
    $INVOICE->createdAt = filter_input(INPUT_POST, 'createdAt');
    $INVOICE->vat_reg_no = filter_input(INPUT_POST, 'vat_reg_no');
    $INVOICE->cleared_date = filter_input(INPUT_POST, 'cleared_date');
    $INVOICE->gross_weight = filter_input(INPUT_POST, 'gross_weight');
    $INVOICE->volume = filter_input(INPUT_POST, 'volume');
    $INVOICE->cusdec_no = filter_input(INPUT_POST, 'cusdec_no');
    $INVOICE->agency_fees = filter_input(INPUT_POST, 'agency_fees');
    $INVOICE->documentation = filter_input(INPUT_POST, 'documentation');
    $INVOICE->vat = filter_input(INPUT_POST, 'vat');
    $INVOICE->payable_amount = filter_input(INPUT_POST, 'payable_amount');
    $INVOICE->advance = filter_input(INPUT_POST, 'advance');
    $INVOICE->due = filter_input(INPUT_POST, 'due');

    $VALID->check($INVOICE, [
        'job_costing_card' => ['required' => TRUE],
        'createdAt' => ['required' => TRUE],
        'vat_reg_no' => ['required' => TRUE],
        'payble_amount' => ['required' => TRUE],
        'due' => ['required' => TRUE]
    ]);

    if ($VALID->passed()) {
        $INVOICE->create();

        if (!isset($_SESSION)) {
            session_start();
        }
        $VALID->addError("Your data was saved successfully", 'success');
        $_SESSION['ERRORS'] = $VALID->errors();

        $url = explode("?", $_SERVER['HTTP_REFERER']);
        header('Location: ' . $url[0]);
    } else {

        if (!isset($_SESSION)) {
            session_start();
        }

        $_SESSION['ERRORS'] = $VALID->errors();

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}

if (isset($_POST['edit-invoice'])) {

    $INVOICE = new Invoice($_POST['id']);

    $INVOICE->job_costing_card = filter_input(INPUT_POST, 'job_costing_card');
    $INVOICE->vat_reg_no = filter_input(INPUT_POST, 'vat_reg_no');
    $INVOICE->cleared_date = filter_input(INPUT_POST, 'cleared_date');
    $INVOICE->gross_weight = filter_input(INPUT_POST, 'gross_weight');
    $INVOICE->volume = filter_input(INPUT_POST, 'volume');
    $INVOICE->cusdec_no = filter_input(INPUT_POST, 'cusdec_no');
    $INVOICE->agency_fees = filter_input(INPUT_POST, 'agency_fees');
    $INVOICE->documentation = filter_input(INPUT_POST, 'documentation');
    $INVOICE->vat = filter_input(INPUT_POST, 'vat');
    $INVOICE->payble_amount = filter_input(INPUT_POST, 'payble_amount');
    $INVOICE->advance = filter_input(INPUT_POST, 'advance');
    $INVOICE->due = filter_input(INPUT_POST, 'due');

    $VALID = new Validator();
    $VALID->check($INVOICE, [
        'job_costing_card' => ['required' => TRUE],
        'vat_reg_no' => ['required' => TRUE],
        'payble_amount' => ['required' => TRUE],
        'due' => ['required' => TRUE]
    ]);

    if ($VALID->passed()) {
        $INVOICE->update();

        if (!isset($_SESSION)) {
            session_start();
        }
        $VALID->addError("Your changes saved successfully", 'success');
        $_SESSION['ERRORS'] = $VALID->errors();

        header('Location: ../manage-invoices.php');
    } else {

        if (!isset($_SESSION)) {
            session_start();
        }

        $_SESSION['ERRORS'] = $VALID->errors();

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}


