<?php

include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/../auth.php');


if (isset($_POST['create-costing-type'])) {
    $COSTINGTYPE = new CostingType(NULL);
    $VALID = new Validator();

    $COSTINGTYPE->title = filter_input(INPUT_POST, 'title');
    $COSTINGTYPE->queue = 0;

    $VALID->check($COSTINGTYPE, [
        'title' => ['required' => TRUE]
    ]);

    if ($VALID->passed()) {
        $result = $COSTINGTYPE->create();

        if (!isset($_SESSION)) {
            session_start();
        }
        $VALID->addError("Your data was saved successfully", 'success');
        $_SESSION['ERRORS'] = $VALID->errors();

        if ($_POST['back'] == '') {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        } else {
            header('Location: ' . $_POST['back'] . '?name=' . $result->title);
        }
    } else {

        if (!isset($_SESSION)) {
            session_start();
        }

        $_SESSION['ERRORS'] = $VALID->errors();

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}

if (isset($_POST['edit-costing-type'])) {
    $COSTINGTYPE = new CostingType($_POST['id']);

    $COSTINGTYPE->title = filter_input(INPUT_POST, 'title');

    $VALID = new Validator();
    $VALID->check($COSTINGTYPE, [
        'title' => ['required' => TRUE]
    ]);

    if ($VALID->passed()) {
        $COSTINGTYPE->update();

        if (!isset($_SESSION)) {
            session_start();
        }
        $VALID->addError("Your changes saved successfully", 'success');
        $_SESSION['ERRORS'] = $VALID->errors();

        header('Location: ../manage-costing-types.php');
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

        $COSTINGTYPE = CostingType::arrange($key, $img);

        if ($COSTINGTYPE) {
            $VALID = new Validator();
            $VALID->addError("Your changes saved successfully", 'success');
            $_SESSION['ERRORS'] = $VALID->errors();
        }

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}

