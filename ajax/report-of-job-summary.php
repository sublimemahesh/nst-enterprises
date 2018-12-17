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
if ($_POST['option'] == 'GETINVOICESBYSTARTANDENDDATE') {

    $invoices = Invoice::getInvoicesByDateRange($_POST['from'], $_POST['to']);
    
    $arr = array();
    $jobarr = array();
     
    foreach ($invoices as $invoice) {
        
//        $invoice = Invoice::getInvoiceByJobCostingCard($jobcostingcard['id']);
        $jobcostingcard = new JobCostingCard($invoice['job_costing_card']);
        $job = new Job($jobcostingcard->job);
        $consignee = new Consignee($job->consignee);
        $consignment = new Consignment($job->consignment);
        
        $costingamount = ReimbursementDetails::getGrandTotalByJobCostingCard($jobcostingcard->id);
        
        $arr['invoiceCreatedAt'] = $invoice['createdAt'];
        $arr['invoiceNumber'] = $jobcostingcard->invoiceNumber;
        $arr['jobReferenceNo'] = $job->reference_no;
        $arr['consignee'] = $consignee->name;
        $arr['vatno'] = $consignee->vatNumber;
        $arr['consignment'] = $consignment->name;
        $arr['payableAmount'] = $invoice['payable_amount'];
        $arr['grandTotal'] = $costingamount['grandtotal'];
        $arr['agencyFees'] = $invoice['agency_fees'];
        $arr['documentation'] = $invoice['documentation'];
       
        array_push($jobarr, $arr);
    }

    header('Content-Type: application/json');
    echo json_encode($jobarr);
    exit();
}

