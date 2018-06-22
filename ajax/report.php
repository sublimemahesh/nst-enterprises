<?php

include_once(dirname(__FILE__) . '/../class/include.php');

if ($_POST['option'] == 'gettypes') {
    
        $REIMBURSEMENTITEMS = new ReimbursementItem(NULL);
        $types = $REIMBURSEMENTITEMS->getDistinctType();
        
        $array_res = array();
        foreach ($types as $type) {
            $type = $type['type'];
            array_push($array_res, $type);
        }
        header('Content-Type: application/json');

        echo json_encode($array_res);
        exit();
    
}
if ($_POST['option'] == 'count') {
    
        $REIMBURSEMENTDETAILS = new ReimbursementDetails(NULL);
        $result = $REIMBURSEMENTDETAILS->getCountByJobCostingCardAndType($_POST["jobcostingcard"],$_POST["ritype"]);
        
        header('Content-Type: application/json');

        echo json_encode($result);
        exit();
    
}
if ($_POST['option'] == 'subtotal') {
    
        $REIMBURSEMENTDETAILS = new ReimbursementDetails(NULL);
        $result = $REIMBURSEMENTDETAILS->getSubTotalByJobCostingCardAndType($_POST["jobcostingcard"],$_POST["ritype"]);

        header('Content-Type: application/json');

        echo json_encode($result);
        exit();
    
}
