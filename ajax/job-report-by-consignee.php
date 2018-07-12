<?php
include_once(dirname(__FILE__) . '/../class/include.php');

if ($_POST['option'] == 'UPDATEINVOICE') {
    $INVOICE = new Invoice(NULL);
    $INVOICE->id = $_POST['invoice'];
    $INVOICE->settle = $_POST['settle'];
    $INVOICE->balance = $_POST['balance'];

    $result = $INVOICE->updateSettleAndBalance();
    header('Content-Type: application/json');

    echo json_encode($result);
    exit();
}

