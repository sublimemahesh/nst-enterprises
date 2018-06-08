<?php

include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/../auth.php');


if (isset($_POST['creat-consignee'])) {
    $CONSIGNEE = new Consignee(NULL);
    $VALID = new Validator();

    $CONSIGNEE->name = filter_input(INPUT_POST, 'name');
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
        $CONSIGNEE->create();

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

if (isset($_POST['edit-consignee'])) {
    $CONSIGNEE = new Consignee($_POST['id']);

    $CONSIGNEE->name = filter_input(INPUT_POST, 'name');
    $CONSIGNEE->address = filter_input(INPUT_POST, 'address');
    $CONSIGNEE->vatNumber = filter_input(INPUT_POST, 'vatNumber');
    $CONSIGNEE->contactNumber = filter_input(INPUT_POST, 'contactNumber');
    $CONSIGNEE->email = filter_input(INPUT_POST, 'email');
    $CONSIGNEE->description = filter_input(INPUT_POST, 'description');
    $CONSIGNEE->isActive = $_POST['isActive'];
    
    $VALID = new Validator();
    $VALID->check($CONSIGNEE, [
        'name' => ['required' => TRUE]
    ]);

    if ($VALID->passed()) {
        $CONSIGNEE->update();

        if (!isset($_SESSION)) {
            session_start();
        }
        $VALID->addError("Your changes saved successfully", 'success');
        $_SESSION['ERRORS'] = $VALID->errors();

        header('Location: ../manage-consignees.php');
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

        $CONSIGNEES = Consignee::arrange($key, $img);

        if ($CONSIGNEES) {
            $VALID = new Validator();
            $VALID->addError("Your changes saved successfully", 'success');
            $_SESSION['ERRORS'] = $VALID->errors();
        }

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}

