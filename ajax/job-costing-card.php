<?php
include_once(dirname(__FILE__) . '/../class/include.php');

if ($_POST['option'] == 'CREATE') {
    
    $JOBCOSTINGCARD = new JobCostingCard(NULL);
    $VALID = new Validator();
    
    $JOBCOSTINGCARD->job = $_POST['job'];
    $JOBCOSTINGCARD->date = $_POST['date'];
    $JOBCOSTINGCARD->invoiceNumber = $_POST['invoiceno'];
    

    $VALID->check($JOBCOSTINGCARD, [
        'job' => ['required' => TRUE],
        'date' => ['required' => TRUE]
    ]);

    if ($VALID->passed()) {
        $result = $JOBCOSTINGCARD->create();
        
        if($result) {
            $id = $result;
            $today = date("Y-m-d");
            $res = Account::updateCurrentInvoiceId($today,$id);
        }

    }
    header('Content-Type: application/json');

    echo json_encode($result);
    exit();
}
