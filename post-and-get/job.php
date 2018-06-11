<?php

include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/../auth.php');


if (isset($_POST['create-job'])) {
    $JOB = new Job(NULL);
    $VALID = new Validator();

    $JOB->description = filter_input(INPUT_POST, 'description');
    $JOB->chassisNumber = filter_input(INPUT_POST, 'chassisNumber');
    $JOB->vesselAndFlight = filter_input(INPUT_POST, 'vesselAndFlight');
    $JOB->vesselAndFlightDate = filter_input(INPUT_POST, 'vesselAndFlightDate');
    $JOB->copyReceivedDate = filter_input(INPUT_POST, 'copyReceivedDate');
    $JOB->originalReceivedDate = filter_input(INPUT_POST, 'originalReceivedDate');
    $JOB->debitNoteNumber = filter_input(INPUT_POST, 'debitNoteNumber');
    $JOB->cusdecDate = filter_input(INPUT_POST, 'cusdecDate');

    $VALID->check($JOB, [
        'description' => ['required' => TRUE],
        'chassisNumber' => ['required' => TRUE],
        'vesselAndFlight' => ['required' => TRUE]
    ]);

    if ($VALID->passed()) {
        $JOB->create();

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
}

if (isset($_POST['edit-job'])) {
    
    $JOB = new Job($_POST['id']);

    $JOB->description = filter_input(INPUT_POST, 'description');
    $JOB->chassisNumber = filter_input(INPUT_POST, 'chassisNumber');
    $JOB->vesselAndFlight = filter_input(INPUT_POST, 'vesselAndFlight');
    $JOB->vesselAndFlightDate = filter_input(INPUT_POST, 'vesselAndFlightDate');
    $JOB->copyReceivedDate = filter_input(INPUT_POST, 'copyReceivedDate');
    $JOB->originalReceivedDate = filter_input(INPUT_POST, 'originalReceivedDate');
    $JOB->debitNoteNumber = filter_input(INPUT_POST, 'debitNoteNumber');
    $JOB->cusdecDate = filter_input(INPUT_POST, 'cusdecDate');
    
    $VALID = new Validator();
    $VALID->check($JOB, [
        'description' => ['required' => TRUE],
        'chassisNumber' => ['required' => TRUE],
        'vesselAndFlight' => ['required' => TRUE]
    ]);

    if ($VALID->passed()) {
        $JOB->update();

        if (!isset($_SESSION)) {
            session_start();
        }
        $VALID->addError("Your changes saved successfully", 'success');
        $_SESSION['ERRORS'] = $VALID->errors();

        header('Location: ../manage-jobs.php');
    } else {

        if (!isset($_SESSION)) {
            session_start();
        }

        $_SESSION['ERRORS'] = $VALID->errors();

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}


