<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/../auth.php');


if (isset($_POST['create-consignment'])) {
    
    $CONSIGNMENT = new Consignment(NULL);
    $VALID = new Validator();

    $CONSIGNMENT->name = filter_input(INPUT_POST, 'name');
    $CONSIGNMENT->description = $_POST['description'];
    $CONSIGNMENT->isActive = 1;

    $VALID->check($CONSIGNMENT, [
        'name' => ['required' => TRUE]
    ]);

    if ($VALID->passed()) {
        $CONSIGNMENT->create();

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

if (isset($_POST['edit-consignment'])) {
    $CONSIGNMENT = new Consignment($_POST['id']);

    $CONSIGNMENT->name = filter_input(INPUT_POST, 'name');
    $CONSIGNMENT->description = filter_input(INPUT_POST, 'description');
    $CONSIGNMENT->isActive = $_POST['isActive'];
    
    $VALID = new Validator();
    $VALID->check($CONSIGNMENT, [
        'name' => ['required' => TRUE]
    ]);

    if ($VALID->passed()) {
        $CONSIGNMENT->update();

        if (!isset($_SESSION)) {
            session_start();
        }
        $VALID->addError("Your changes saved successfully", 'success');
        $_SESSION['ERRORS'] = $VALID->errors();

        header('Location: ../manage-consignments.php');
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

        $CONSIGNMENTS = Consignment::arrange($key, $img);

        if ($CONSIGNMENTS) {
            $VALID = new Validator();
            $VALID->addError("Your changes saved successfully", 'success');
            $_SESSION['ERRORS'] = $VALID->errors();
        }

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}

