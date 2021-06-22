<?php

include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/../auth.php');


if (isset($_POST['create-job'])) {
    $JOB = new Job(NULL);
    $VALID = new Validator();


    if (empty($_POST['consignee'])) {
        $CONSIGNEE = new Consignee(NULL);
        $CONSIGNEE->name = $_POST['name'];
        $CONSIGNEE->isActive = 1;
        $consignee = $CONSIGNEE->create();
        $JOB->consignee = $consignee->id;
    } else {
        $JOB->consignee = filter_input(INPUT_POST, 'consignee');
    }
   
    if (!empty($_POST['consignment']) && !empty($_POST['consignmentname'])) {
    if (empty($_POST['consignment'])) {
        $CONSIGNMENT = new Consignment(NULL);
        $CONSIGNMENT->name = $_POST['consignmentname'];
        $CONSIGNMENT->isActive = 1;
        $consignment = $CONSIGNMENT->create();
        $JOB->consignment = $consignment->id;
    } else {
        $JOB->consignment = filter_input(INPUT_POST, 'consignment');
    }
    } else {
         $JOB->consignment = 0;
    }
    if (!empty($_POST['vesselAndFlight']) && !empty($_POST['vesselandflightname'])) {
    if (empty($_POST['vesselAndFlight'])) {
        $VESSELANDFLIGHT = new VesselAndFlight(NULL);
        $VESSELANDFLIGHT->name = $_POST['vesselandflightname'];
        $VESSELANDFLIGHT->isActive = 1;
        $vesselandflight = $VESSELANDFLIGHT->create();
        $JOB->vesselAndFlight = $vesselandflight->id;
    } else {
        $JOB->vesselAndFlight = filter_input(INPUT_POST, 'vesselAndFlight');
    }
    } else {
         $JOB->vesselAndFlight = 0;
    }

    $JOB->description = filter_input(INPUT_POST, 'description');
    $JOB->chassisNumber = filter_input(INPUT_POST, 'chassisNumber');
    $JOB->vesselAndFlightDate = filter_input(INPUT_POST, 'vesselAndFlightDate');
    
    if($_POST['vesselAndFlightDate'] == '') {
        $JOB->vesselAndFlightDate = '0000-00-00 00:00:00';
    } else {
        $JOB->vesselAndFlightDate = filter_input(INPUT_POST, 'vesselAndFlightDate');
    }
    if($_POST['copyReceivedDate'] == '') {
        $JOB->copyReceivedDate = '0000-00-00 00:00:00';
    } else {
        $JOB->copyReceivedDate = filter_input(INPUT_POST, 'copyReceivedDate');
    }
    if($_POST['originalReceivedDate'] == '') {
        $JOB->originalReceivedDate = '0000-00-00 00:00:00';
    } else {
        $JOB->originalReceivedDate = filter_input(INPUT_POST, 'originalReceivedDate');
    }
    
    $JOB->createdAt = filter_input(INPUT_POST, 'createdAt');
    $JOB->debitNoteNumber = 0;

    $VALID->check($JOB, [
        'consignee' => ['required' => TRUE],
        'chassisNumber' => ['required' => TRUE],
        'createdAt' => ['required' => TRUE]
    ]);

    if ($VALID->passed()) {
        $result = $JOB->create();
        if ($result) {
            
            $id = $result->id;
            $today = date("Y-m-d");
            $account = Account::getCurrentAccount($today);
            $new_job_id = $account['current_job_id'] + 1;
            $res = Account::updateCurrentJobId($today, $new_job_id);
        }

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

if (isset($_POST['edit-job'])) {

    $JOB = new Job($_POST['id']);
    
    if (empty($_POST['consignee'])) {
        $CONSIGNEE = new Consignee(NULL);
        $CONSIGNEE->name = $_POST['name'];
        $CONSIGNEE->isActive = 1;
        $consignee = $CONSIGNEE->create();
        $JOB->consignee = $consignee->id;
    } else {
        $JOB->consignee = filter_input(INPUT_POST, 'consignee');
    }
    if (!empty($_POST['consignment']) && !empty($_POST['consignmentname'])) {
    if (empty($_POST['consignment'])) {
        $CONSIGNMENT = new Consignment(NULL);
        $CONSIGNMENT->name = $_POST['consignmentname'];
        $CONSIGNMENT->isActive = 1;
        $consignment = $CONSIGNMENT->create();
        $JOB->consignment = $consignment->id;
    } else {
        $JOB->consignment = filter_input(INPUT_POST, 'consignment');
    }
    } else {
         $JOB->consignment = 0;
    }
    if (!empty($_POST['vesselAndFlight']) && !empty($_POST['vesselandflightname'])) {
    if (empty($_POST['vesselAndFlight'])) {
        $VESSELANDFLIGHT = new VesselAndFlight(NULL);
        $VESSELANDFLIGHT->name = $_POST['vesselandflightname'];
        $VESSELANDFLIGHT->isActive = 1;
        $vesselandflight = $VESSELANDFLIGHT->create();
        $JOB->vesselAndFlight = $vesselandflight->id;
    } else {
        $JOB->vesselAndFlight = filter_input(INPUT_POST, 'vesselAndFlight');
    }
    } else {
         $JOB->vesselAndFlight = 0;
    }

    
    $JOB->description = filter_input(INPUT_POST, 'description');
    $JOB->chassisNumber = filter_input(INPUT_POST, 'chassisNumber');
    /*$JOB->vesselAndFlightDate = filter_input(INPUT_POST, 'vesselAndFlightDate');
    $JOB->copyReceivedDate = filter_input(INPUT_POST, 'copyReceivedDate');
    $JOB->originalReceivedDate = filter_input(INPUT_POST, 'originalReceivedDate');*/
    
    if($_POST['vesselAndFlightDate'] == '') {
        $JOB->vesselAndFlightDate = '0000-00-00 00:00:00';
    } else {
        $JOB->vesselAndFlightDate = filter_input(INPUT_POST, 'vesselAndFlightDate');
    }
    if($_POST['copyReceivedDate'] == '') {
        $JOB->copyReceivedDate = '0000-00-00 00:00:00';
    } else {
        $JOB->copyReceivedDate = filter_input(INPUT_POST, 'copyReceivedDate');
    }
    if($_POST['originalReceivedDate'] == '') {
        $JOB->originalReceivedDate = '0000-00-00 00:00:00';
    } else {
        $JOB->originalReceivedDate = filter_input(INPUT_POST, 'originalReceivedDate');
    }
    
    
    $JOB->debitNoteNumber = filter_input(INPUT_POST, 'debitNoteNumber');
//    $JOB->cusdecNo = filter_input(INPUT_POST, 'cusdecNo');

    $VALID = new Validator();
    $VALID->check($JOB, [
        'consignee' => ['required' => TRUE],
        'chassisNumber' => ['required' => TRUE]
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


