<?php

include_once(dirname(__FILE__) . '/../class/include.php');

if ($_POST['option'] == 'ADDINVOICE') {
    $INVOICE = new Invoice(NULL);

    $INVOICE->job_costing_card = $_POST['job_costing_card'];
    $INVOICE->createdAt = $_POST['createdAt'];
    $INVOICE->vat_reg_no = $_POST['vat_reg_no'];
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

    $result = $INVOICE->create();
    header('Content-Type: application/json');

    echo json_encode($result);
    exit();
}

if ($_POST['option'] == 'UPDATEINVOICE') {
    $INVOICE = new Invoice(NULL);

    $INVOICE->id = $_POST['id'];
    $INVOICE->createdAt = $_POST['createdAt'];
    $INVOICE->vat_reg_no = $_POST['vat_reg_no'];
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
    
    if(!$result) {
        $res = 0;
    } else {
        $res = $result;
    }
    header('Content-Type: application/json');

    echo json_encode($res);
    exit();
}

