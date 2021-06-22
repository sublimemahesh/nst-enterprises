<?php

include_once(dirname(__FILE__) . '/../class/include.php');

if ($_POST['option'] == 'ADDINVOICE') {
    $INVOICE = new Invoice(NULL);

    $INVOICE->job_costing_card = $_POST['job_costing_card'];
    $INVOICE->createdAt = $_POST['createdAt'];
//    $INVOICE->vat_reg_no = $_POST['vat_reg_no'];
    $INVOICE->cleared_date = $_POST['cleared_date'];
    $INVOICE->gross_weight = $_POST['gross_weight'];
    $INVOICE->volume = $_POST['volume'];
    $INVOICE->cusdec_no = $_POST['cusdec_no'];
    $INVOICE->agency_fees = $_POST['agency_fees'];
    $INVOICE->documentation = $_POST['documentation'];
    $INVOICE->vat = $_POST['vat'];
    $INVOICE->tax_total = $_POST['tax_total'];
    $INVOICE->statutory_sub_total = $_POST['statutory_total'];
    $INVOICE->delivery_sub_total = $_POST['delivery_total'];
    $INVOICE->payable_amount = $_POST['payable_amount'];
    $INVOICE->advance = $_POST['advance'];

    if (empty($_POST['due'])) {
        $INVOICE->refund = $_POST['refund'];
        $INVOICE->due = 0;
    } elseif (empty($_POST['refund'])) {
        $INVOICE->due = $_POST['due'];
        $INVOICE->refund = 0;
    }

    $result = $INVOICE->create();

    header('Content-Type: application/json');

    echo json_encode($result);
    exit();
}

if ($_POST['option'] == 'UPDATEINVOICE') {
    $INVOICE = new Invoice(NULL);

    $INVOICE->id = $_POST['id'];
    $INVOICE->createdAt = $_POST['createdAt'];
//    $INVOICE->vat_reg_no = $_POST['vat_reg_no'];
    $INVOICE->cleared_date = $_POST['cleared_date'];
    $INVOICE->gross_weight = $_POST['gross_weight'];
    $INVOICE->volume = $_POST['volume'];
    $INVOICE->cusdec_no = $_POST['cusdec_no'];
    $INVOICE->agency_fees = $_POST['agency_fees'];
    $INVOICE->documentation = $_POST['documentation'];
    $INVOICE->vat = $_POST['vat'];
    $INVOICE->tax_total = $_POST['tax_total'];
    $INVOICE->statutory_sub_total = $_POST['statutory_total'];
    $INVOICE->delivery_sub_total = $_POST['delivery_total'];
    $INVOICE->payable_amount = $_POST['payable_amount'];
    $INVOICE->advance = $_POST['advance'];
    $INVOICE->due = $_POST['due'];
    $INVOICE->refund = $_POST['refund'];

    $result = $INVOICE->update();
    header('Content-Type: application/json');

    echo json_encode($result);
    exit();
}

if ($_POST['option'] == 'UPDATEREIMBURSEMENTDETAILS') {
    $REIMBURSEMENTDETAILS = new ReimbursementDetails(NULL);

    $REIMBURSEMENTDETAILS->id = $_POST['id'];
    $REIMBURSEMENTDETAILS->invoiceamount = $_POST['amount'];

    $result = $REIMBURSEMENTDETAILS->updateInvoiceAmount();
    header('Content-Type: application/json');

    echo json_encode($result);
    exit();
}

if ($_POST['option'] == 'GETVALUE') {
    $INVOICE = new Invoice(NULL);

    $result = $INVOICE->getInvoiceByJobCostingCard($_POST["jobcostingcard"]);

//    if(!$result) {
//        $res = 0;
//    } else {
//        $res = $result;
//    }

    header('Content-Type: application/json');

    echo json_encode($result);
    exit();
}

if ($_POST['option'] == 'SAVEDELIVERYDATA') {

    foreach ($_POST['data'] as $data) {
        $DELIVERYDATA = new InvoiceDeliveryDetails(NULL);

        if (empty($data['name']) && empty($data['amount'])) {
            
            if(isset($data['id'])) {
                $id= $data['id'];
            } else {
                $id= '';
            }

            if ($id) {

                $DELIVERYDATA->id = $data['id'];
                $DELIVERYDATA->delete();
                $result = 'success';
            } else {
                $result = 'success';
            }
        } else {

            $DELIVERYDATA->invoice = $data['invoice'];
            $DELIVERYDATA->name = $data['name'];
            if($data['amount'] == '') {
                $DELIVERYDATA->amount = 0;
            } else {
                $DELIVERYDATA->amount = $data['amount'];
            }
            

            if (empty($data['id'])) {
                $result = $DELIVERYDATA->create();
            } else {

                $DELIVERYDATA->id = $data['id'];
                $result = $DELIVERYDATA->update();
            }
        }
        
        if($result) {
            $INVOICE = new Invoice($data['invoice']);
        }
    }

    header('Content-Type: application/json');

    echo json_encode($INVOICE->job_costing_card);
    exit();
}

if ($_POST['option'] == 'GETCHARTDATA') {

    $INVOICE = new Invoice(NULL);
    $JOBCOSTINGCARD = new JobCostingCard(NULL);
    date_default_timezone_set('Asia/Colombo');
    $month = date('m');
    $year = date('Y');
    $lastmonth = $month - 1;
    if ($month == 1) {
        $lastmonth = 12;
        $year = $year - 1;
    }
    if ($lastmonth == 2) {
        $maxdate = 28;
    } elseif ($lastmonth == 1 || $lastmonth == 3 || $lastmonth == 5 || $lastmonth == 7 || $lastmonth == 8 || $lastmonth == 10 || $lastmonth == 12) {
        $maxdate = 31;
    } else {
        $maxdate = 30;
    }

    $arr = array();
    $amountbydate = array();
    $totcostingamount = 0;
    $grossprofit = 0;
    $costingamount = '';
    for ($i = 1; $i <= $maxdate; $i++) {
        $date = $year . '-' . $lastmonth . '-' . $i;
        $result = $INVOICE->getInvoiceAmountByDate($date);
        $jobcostingcards = $JOBCOSTINGCARD->getJobCostingCardByDate($date);

        if ($jobcostingcards) {
            foreach ($jobcostingcards as $jobcostingcard) {
                $costingamount = ReimbursementDetails::getGrandTotalByJobCostingCard($jobcostingcard['id']);
                $totcostingamount += $costingamount['grandtotal'];
            }
        } else {
            $totcostingamount = 0;
        }

        $grossprofit = $result['sum'] - $totcostingamount;


        $arr['date'] = $date;
        $arr['grossprofit'] = $grossprofit;

        if ($result['sum']) {
            $arr['sum'] = $result['sum'];
        } else {
            $arr['sum'] = 0;
        }


        array_push($amountbydate, $arr);
    }


    header('Content-Type: application/json');

    echo json_encode($amountbydate);
    exit();
}