<?php

include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/../auth.php');


if (isset($_POST['creat-vessel-or-flight'])) {
    $VESSELANDFLIGHT = new VesselAndFlight(NULL);
    $VALID = new Validator();

    $VESSELANDFLIGHT->name = filter_input(INPUT_POST, 'name');
    $VESSELANDFLIGHT->queue = 0;

    if ($_POST['type'] == 'vessel') {
        $VESSELANDFLIGHT->isVessel = 'true';
        $VESSELANDFLIGHT->isFlight = 'false';
    } elseif ($_POST['type'] == 'flight') {
        $VESSELANDFLIGHT->isVessel = 'false';
        $VESSELANDFLIGHT->isFlight = 'true';
    }
    $VESSELANDFLIGHT->isActive = 1;

    $VALID->check($VESSELANDFLIGHT, [
        'name' => ['required' => TRUE],
        'isVessel' => ['required' => TRUE],
        'isFlight' => ['required' => TRUE],
    ]);

    if ($VALID->passed()) {
        $VESSELANDFLIGHT->create();

        if (!isset($_SESSION)) {
            session_start();
        }
        $VALID->addError("Your data was saved successfully", 'success');
        $_SESSION['ERRORS'] = $VALID->errors();

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {

        if (!isset($_SESSION)) {
            session_start();
        }

        $_SESSION['ERRORS'] = $VALID->errors();

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}

if (isset($_POST['edit-vessel-or-flight'])) {
    $VESSELANDFLIGHT = new VesselAndFlight($_POST['id']);

    $VESSELANDFLIGHT->name = $_POST['name'];

    if ($_POST['type'] == 'vessel') {
        $VESSELANDFLIGHT->isVessel = 'true';
        $VESSELANDFLIGHT->isFlight = 'false';
    } elseif ($_POST['type'] == 'flight') {
        $VESSELANDFLIGHT->isVessel = 'false';
        $VESSELANDFLIGHT->isFlight = 'true';
    }

    $VESSELANDFLIGHT->isActive = $_POST['isActive'];

    $VALID = new Validator();
    $VALID->check($VESSELANDFLIGHT, [
        'name' => ['required' => TRUE],
        'isVessel' => ['required' => TRUE],
        'isFlight' => ['required' => TRUE]
    ]);

    if ($VALID->passed()) {
        $VESSELANDFLIGHT->update();

        if (!isset($_SESSION)) {
            session_start();
        }
        $VALID->addError("Your changes saved successfully", 'success');
        $_SESSION['ERRORS'] = $VALID->errors();

        header('Location: ../manage-vessels-and-flights.php');
    } else {

        if (!isset($_SESSION)) {
            session_start();
        }

        $_SESSION['ERRORS'] = $VALID->errors();

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}

if (isset($_POST['save-arrange'])) {

    foreach ($_POST['sort'] as $key => $img) {
        $key = $key + 1;

        $VESSELSANDFLIGHTS = VesselAndFlight::arrange($key, $img);

        if ($VESSELSANDFLIGHTS) {
            $VALID = new Validator();
            $VALID->addError("Your changes saved successfully", 'success');
            $_SESSION['ERRORS'] = $VALID->errors();
        }

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}

