<?php

include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/../auth.php');


if (isset($_POST['create-costing-item'])) {
    $REIMBURSEMENTITEM = new ReimbursementItem(NULL);
    $VALID = new Validator();

    $REIMBURSEMENTITEM->name = filter_input(INPUT_POST, 'name');
    $REIMBURSEMENTITEM->label = filter_input(INPUT_POST, 'label');
    $REIMBURSEMENTITEM->type = filter_input(INPUT_POST, 'type');
    $REIMBURSEMENTITEM->queue = 0;

    $VALID->check($REIMBURSEMENTITEM, [
        'name' => ['required' => TRUE],
        'type' => ['required' => TRUE]
    ]);

    if ($VALID->passed()) {
        $result = $REIMBURSEMENTITEM->create();

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

if (isset($_POST['edit-costing-item'])) {
    $REIMBURSEMENTITEM = new ReimbursementItem($_POST['id']);

    $REIMBURSEMENTITEM->name = filter_input(INPUT_POST, 'name');
    $REIMBURSEMENTITEM->label = filter_input(INPUT_POST, 'label');
    $REIMBURSEMENTITEM->type = filter_input(INPUT_POST, 'type');

    $VALID = new Validator();
    $VALID->check($REIMBURSEMENTITEM, [
        'name' => ['required' => TRUE],
        'type' => ['required' => TRUE]
    ]);

    if ($VALID->passed()) {
        $REIMBURSEMENTITEM->update();

        if (!isset($_SESSION)) {
            session_start();
        }
        $VALID->addError("Your changes saved successfully", 'success');
        $_SESSION['ERRORS'] = $VALID->errors();

        header('Location: ../manage-costing-items.php?id='.$REIMBURSEMENTITEM->type);
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

        $REIMBURSEMENTITEM = ReimbursementItem::arrange($key, $img);

        if ($REIMBURSEMENTITEM) {
            $VALID = new Validator();
            $VALID->addError("Your changes saved successfully", 'success');
            $_SESSION['ERRORS'] = $VALID->errors();
        }

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}

