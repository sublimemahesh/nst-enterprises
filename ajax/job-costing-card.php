<?php
include_once(dirname(__FILE__) . '/../class/include.php');

if ($_POST['option'] == 'CREATE') {
    
    $JOBCOSTINGCARD = new JobCostingCard(NULL);
    $VALID = new Validator();
    
    $JOBCOSTINGCARD->job = $_POST['job'];
    $JOBCOSTINGCARD->date = $_POST['date'];
//    $JOBCOSTINGCARD->invoiceNumber = $_POST['invoiceno'];


    $VALID->check($JOBCOSTINGCARD, [
        'job' => ['required' => TRUE],
        'date' => ['required' => TRUE]
    ]);

    if ($VALID->passed()) {
        $result = $JOBCOSTINGCARD->create();
        
//        if($result) {
//            
//            $today = date("Y-m-d");
//            $account = Account::getCurrentAccount($today);
//            $new_invoice_id = $account['current_invoice_id'] + 1;
//            $res = Account::updateCurrentInvoiceId($today, $new_invoice_id);
//        }

    }
    header('Content-Type: application/json');

    echo json_encode($result);
    exit();
}

if ($_POST['option'] == 'CREATEINVOICENUMBER') {
    
    $JOBCOSTINGCARD = new JobCostingCard($_POST['jobcostingcard']);
    $VALID = new Validator();

    $JOBCOSTINGCARD->invoiceNumber = $_POST['invoiceno'];

    $VALID->check($JOBCOSTINGCARD, [
        'invoiceNumber' => ['required' => TRUE]
    ]);

    if ($VALID->passed()) {
        $result = $JOBCOSTINGCARD->updateInvoiceNumber();

    }
    header('Content-Type: application/json');

    echo json_encode($result);
    exit();
}
