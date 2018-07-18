<?php

include_once(dirname(__FILE__) . '/../class/include.php');
$REIMBURSEMENTDETAILS = new ReimbursementDetails(NULL);

foreach ($_POST['data'] as $data) {
    $REIMBURSEMENTITEMS = new ReimbursementItem($data['rid']);

    if(empty($data['vno']) && empty($data['amount']) && empty($data['description'])) {
        $result = TRUE;
    } else {
        $REIMBURSEMENTDETAILS->jobCostingCard = $data['jobcostingcard'];
        $REIMBURSEMENTDETAILS->reimbursementItem = $data['rid'];
        $REIMBURSEMENTDETAILS->voucherNumber = $data['vno'];
        $REIMBURSEMENTDETAILS->amount = $data['amount'];
        $REIMBURSEMENTDETAILS->description = $data['description'];
        $REIMBURSEMENTDETAILS->type = $data['type'];

        $result = $REIMBURSEMENTDETAILS->create();
        
        if($result) {
            $jcc = $result->jobCostingCard;
        }
    }
}


header('Content-Type: application/json');

echo json_encode($jcc);
exit();
