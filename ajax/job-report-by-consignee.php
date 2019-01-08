<?php
include_once(dirname(__FILE__) . '/../class/include.php');

if ($_POST['option'] == 'UPDATEINVOICE') {
    $INVOICE = new Invoice(NULL);
    $INVOICE->id = $_POST['invoice'];
    $INVOICE->settle = $_POST['settle'];
    $INVOICE->balance = $_POST['balance'];
    $INVOICE->status = $_POST['status'];
    $INVOICE->receiptno = $_POST['receiptno'];

    $result = $INVOICE->updateSettleAndBalance();
    header('Content-Type: application/json');

    echo json_encode($result);
    exit();
}

if ($_POST['option'] == 'UPDATECURRENTBALANCE') {
    $CONSIGNEE = new Consignee($_POST['consignee']);

    $CONSIGNEE->balance = $_POST['balance'];

    $result = $CONSIGNEE->updateBalance();
    header('Content-Type: application/json');

    echo json_encode($result);
    exit();
}

