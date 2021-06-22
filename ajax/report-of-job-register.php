<?php
include_once(dirname(__FILE__) . '/../class/include.php');

if ($_POST['option'] == 'GETSTARTANDENDDATE') {
    /*$ACCOUNT = new Account(NULL);
    
    $today = date("Y-m-d");
    $currentaccount = $ACCOUNT->getCurrentAccount($today);*/
    
    $start_date = date("Y-m-d", strtotime( date( "Y-m-d", strtotime( date("Y-m-d") ) ) . "-1 month" ) );

    $arr = array();
    $arr['start_date'] = $start_date;
    $arr['end_date'] = date("Y-m-d");

    header('Content-Type: application/json');

    echo json_encode($arr);
    exit();
}
if ($_POST['option'] == 'GETJOBSBYSTARTANDENDDATE') {
    
    $jobs = Job::getJobsByDateRange($_POST['from'], $_POST['to']);
    
    $arr = array();
    $jobarr = array();
     
    foreach ($jobs as $job) {
        
        $consignee = new Consignee($job['consignee']);
        $vesselAndFlight = new VesselAndFlight($job['vesselAndFlight']);
        $jobcostingcard = JobCostingCard::getJobCostingCardIdByJob($job['id']);
        $invoice = Invoice::getInvoiceByJobCostingCard($jobcostingcard['id']);
        
        $arr['jobReferenceNo'] = $job['reference_no'];
        $arr['consignee'] = $consignee->name;
        $arr['jobDescription'] = $job['description'];
        $arr['vesselAndFlight'] = $vesselAndFlight->name;
        $arr['vesselAndFlightDate'] = $job['vesselAndFlightDate'];
        $arr['copyReceivedDate'] = $job['copyReceivedDate'];
        $arr['originalReceivedDate'] = $job['originalReceivedDate'];
        $arr['invoiceNumber'] = $jobcostingcard['invoiceNumber'];
        $arr['cusdecNo'] = $invoice['cusdec_no'];
       
        array_push($jobarr, $arr);
    }

    header('Content-Type: application/json');

    echo json_encode($jobarr);
    exit();
}