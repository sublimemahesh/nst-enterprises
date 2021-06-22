<?php

include_once(dirname(__FILE__) . '/../class/include.php');

if ($_POST['option'] == 'ADDCONSIGNMENT') {
    $CONSIGNMENT = new Consignment(NULL);
    $VALID = new Validator();

    $CONSIGNMENT->name = $_POST['consignment'];
    $CONSIGNMENT->description = filter_input(INPUT_POST, 'description');
    $CONSIGNMENT->isActive = 1;
    $CONSIGNMENT->queue = 0;
    
    $VALID->check($CONSIGNMENT, [
        'name' => ['required' => TRUE]
    ]);

    if ($VALID->passed()) {
        $result = $CONSIGNMENT->create();
    }
    header('Content-Type: application/json');

    echo json_encode($result);
    exit();
}
