<?php

include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/../auth.php');


if (isset($_POST['create-consignee'])) {
    $CONSIGNEE = new Consignee(NULL);
    $VALID = new Validator();

    $CONSIGNEE->name = filter_input(INPUT_POST, 'name');
    $CONSIGNEE->address = filter_input(INPUT_POST, 'address');
    $CONSIGNEE->vatNumber = filter_input(INPUT_POST, 'vatNumber');
    $CONSIGNEE->contactNumber = filter_input(INPUT_POST, 'contactNumber');
    $CONSIGNEE->email = filter_input(INPUT_POST, 'email');
    $CONSIGNEE->description = filter_input(INPUT_POST, 'description');
    $CONSIGNEE->description = filter_input(INPUT_POST, 'description');
    $CONSIGNEE->parent = filter_input(INPUT_POST, 'pnameid');
    $CONSIGNEE->isActive = 1;
    $CONSIGNEE->balance = 0;
    $CONSIGNEE->queue = 0;

    $VALID->check($CONSIGNEE, [
        'name' => ['required' => TRUE]
    ]);

    if ($VALID->passed()) {
        $result = $CONSIGNEE->create();

        if (!isset($_SESSION)) {
            session_start();
        }
        $VALID->addError("Your data was saved successfully", 'success');
        $_SESSION['ERRORS'] = $VALID->errors();

        if ($_POST['back'] == '') {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        } else {
            header('Location: ' . $_POST['back'] . '?name=' . $result->name);
        }
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
    $CONSIGNEE->parent = filter_input(INPUT_POST, 'pnameid');
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

