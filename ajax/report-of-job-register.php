<?php
include_once(dirname(__FILE__) . '/../class/include.php');

if ($_POST['option'] == 'GETSTARTANDENDDATE') {
    $ACCOUNT = new Account(NULL);
    
    $today = date("Y-m-d");
    $currentaccount = $ACCOUNT->getCurrentAccount($today);

    header('Content-Type: application/json');

    echo json_encode($currentaccount);
    exit();
}
if ($_POST['option'] == 'GETJOBSBYSTARTANDENDDATE') {
    
    $result = Job::getJobsByDateRange($_POST['from'], $_POST['to']);

    header('Content-Type: application/json');

    echo json_encode($result);
    exit();
}

if ($_POST['option'] == 'GETCONSIGNEE') {
    
    $CONSIGNEE = new Consignee($_POST['consignee']);

    header('Content-Type: application/json');

    echo json_encode($CONSIGNEE);
    exit();
}

if ($_POST['option'] == 'GETVESSELORFLIGHT') {
    
    $VESSELORFLIGHT = new VesselAndFlight($_POST['vesselorflight']);

    header('Content-Type: application/json');

    echo json_encode($VESSELORFLIGHT);
    exit();
}

if ($_POST['option'] == 'GETINVOICE') {
    
    $JOBCOSTINGCARD = JobCostingCard::getJobCostingCardIdByJob($_POST['job']);

    header('Content-Type: application/json');

    echo json_encode($JOBCOSTINGCARD);
    exit();
}

