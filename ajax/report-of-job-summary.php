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

if ($_POST['option'] == 'GETCONSIGNMENT') {
    
    $CONSIGNMENT = new Consignment($_POST['consignment']);

    header('Content-Type: application/json');

    echo json_encode($CONSIGNMENT);
    exit();
}

if ($_POST['option'] == 'GETJOBCOSTINGCARD') {
    
    $JOBCOSTINGCARD = JobCostingCard::getJobCostingCardIdByJob($_POST['job']);

    header('Content-Type: application/json');

    echo json_encode($JOBCOSTINGCARD);
    exit();
}
if ($_POST['option'] == 'GETINVOICE') {
    
    $INVOICE = Invoice::getInvoiceByJobCostingCard($_POST['jobcostingcard']);

    header('Content-Type: application/json');

    echo json_encode($INVOICE);
    exit();
}
if ($_POST['option'] == 'GETCOSTINGAMOUNT') {
    $COSTINGAMOUNT = ReimbursementDetails::getGrandTotalByJobCostingCard($_POST['jobcostingcard']);

    header('Content-Type: application/json');

    echo json_encode($COSTINGAMOUNT);
    exit();
}

