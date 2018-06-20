<?php

include_once(dirname(__FILE__) . '/../class/include.php');
$REIMBURSEMENTDETAILS = new ReimbursementDetails(NULL);

foreach ($_POST['data'] as $data) {
    if ($data['id']) {
        if (empty($data['vno']) && empty($data['amount']) && empty($data['description'])) {
            $result = TRUE;
        } else {
            $REIMBURSEMENTDETAILS->id = $data['id'];
            $REIMBURSEMENTDETAILS->voucherNumber = $data['vno'];
            $REIMBURSEMENTDETAILS->amount = $data['amount'];
            $REIMBURSEMENTDETAILS->description = $data['description'];

            $result = $REIMBURSEMENTDETAILS->update();
        }
    } else {
        if (empty($data['vno']) && empty($data['amount']) && empty($data['description'])) {
            $result = TRUE;
        } else {
            $REIMBURSEMENTDETAILS->jobCostingCard = $data['jobcostingcard'];
            $REIMBURSEMENTDETAILS->reimbursementItem = $data['rid'];
            $REIMBURSEMENTDETAILS->voucherNumber = $data['vno'];
            $REIMBURSEMENTDETAILS->amount = $data['amount'];
            $REIMBURSEMENTDETAILS->description = $data['description'];

            $result = $REIMBURSEMENTDETAILS->create();
        }
    }
}


header('Content-Type: application/json');

echo json_encode($result);
exit();
