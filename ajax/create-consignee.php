<?php

include_once(dirname(__FILE__) . '/../class/include.php');

if ($_POST['option'] == 'ADDCONSIGNEE') {
    $CONSIGNEE = new Consignee(NULL);
    $VALID = new Validator();

    $CONSIGNEE->name = $_POST['consignee'];
    $CONSIGNEE->address = filter_input(INPUT_POST, 'address');
    $CONSIGNEE->vatNumber = filter_input(INPUT_POST, 'vatNumber');
    $CONSIGNEE->contactNumber = filter_input(INPUT_POST, 'contactNumber');
    $CONSIGNEE->email = filter_input(INPUT_POST, 'email');
    $CONSIGNEE->description = filter_input(INPUT_POST, 'description');
    $CONSIGNEE->isActive = 1;
    
    $VALID->check($CONSIGNEE, [
        'name' => ['required' => TRUE]
    ]);

    if ($VALID->passed()) {
        $result = $CONSIGNEE->create();
    }
    header('Content-Type: application/json');

    echo json_encode($result);
    exit();
}
