<?php
include_once(dirname(__FILE__) . '/../class/include.php');

if ($_POST['option'] == 'GETVALUE') {
        $REIMBURSEMENTDETAILS = new ReimbursementDetails(NULL);

        $result = $REIMBURSEMENTDETAILS->getReimbursementDetailsByJobCostingCard($_POST["jobcostingcard"]);
        
        header('Content-Type: application/json');

        echo json_encode($result);
        exit();
    
}

