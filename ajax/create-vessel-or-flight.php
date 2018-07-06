<?php

include_once(dirname(__FILE__) . '/../class/include.php');

if ($_POST['option'] == 'ADDVESSELORFLIGHT') {
    $VESSELANDFLIGHT = new VesselAndFlight(NULL);
    $VALID = new Validator();

    if ($_POST['type'] == 'vessel') {
        $VESSELANDFLIGHT->isVessel = 'true';
        $VESSELANDFLIGHT->isFlight = 'false';
    } elseif ($_POST['type'] == 'flight') {
        $VESSELANDFLIGHT->isVessel = 'false';
        $VESSELANDFLIGHT->isFlight = 'true';
    }

    $VESSELANDFLIGHT->name = $_POST['vesselorflight'];
    $VESSELANDFLIGHT->description = filter_input(INPUT_POST, 'description');
    $VESSELANDFLIGHT->isActive = 1;

    $VALID->check($VESSELANDFLIGHT, [
        'name' => ['required' => TRUE],
        'isVessel' => ['required' => TRUE],
        'isFlight' => ['required' => TRUE]
    ]);

    if ($VALID->passed()) {
        $result = $VESSELANDFLIGHT->create();
    }
    header('Content-Type: application/json');

    echo json_encode($result);
    exit();
}
