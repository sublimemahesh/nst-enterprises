<?php

include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/../auth.php');


if (isset($_POST['create-job-costing-card'])) {
    $JOBCOSTINGCARD = new JobCostingCard(NULL);
    $VALID = new Validator();

    $JOBCOSTINGCARD->job = filter_input(INPUT_POST, 'job');
    $JOBCOSTINGCARD->date = filter_input(INPUT_POST, 'jobdate');
    $JOBCOSTINGCARD->invoiceNumber = $_POST['invoiceNumber'];

    $VALID->check($JOBCOSTINGCARD, [
        'job' => ['required' => TRUE]
    ]);

    if ($VALID->passed()) {
        $result = $JOBCOSTINGCARD->create();

        if (!isset($_SESSION)) {
            session_start();
        }
        $VALID->addError("Your data was saved successfully", 'success');
        $_SESSION['ERRORS'] = $VALID->errors();

        header('Location: ../create-reimbursement-details.php?id='.$result->id);
    } else {

        if (!isset($_SESSION)) {
            session_start();
        }

        $_SESSION['ERRORS'] = $VALID->errors();

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}

if (isset($_POST['edit-job-costing-card'])) {

    $JOBCOSTINGCARD = new JobCostingCard($_POST['id']);

    $JOBCOSTINGCARD->job = filter_input(INPUT_POST, 'job');
    $JOBCOSTINGCARD->date = filter_input(INPUT_POST, 'jobdate');
    $JOBCOSTINGCARD->invoiceNumber = $_POST['invoiceNumber'];
   

    $VALID = new Validator();
    $VALID->check($JOBCOSTINGCARD, [
        'job' => ['required' => TRUE]
    ]);

    if ($VALID->passed()) {
        $JOBCOSTINGCARD->update();

        if (!isset($_SESSION)) {
            session_start();
        }
        $VALID->addError("Your changes saved successfully", 'success');
        $_SESSION['ERRORS'] = $VALID->errors();

        header('Location: ../manage-job-costing-cards.php');
    } else {

        if (!isset($_SESSION)) {
            session_start();
        }

        $_SESSION['ERRORS'] = $VALID->errors();

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}


