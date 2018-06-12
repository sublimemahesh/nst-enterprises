<?php

include_once(dirname(__FILE__) . '/../class/include.php');

if ($_POST['option'] == 'GETNAME') {
    if (!empty($_POST["keyword"])) {
        $USER = new User(NULL);

        $result = $USER->allNamesByKeyword($_POST["keyword"]);
        header('Content-Type: application/json');

        echo json_encode($result);
        exit();
    }
}

if ($_POST['option'] == 'FINDNAME') {
    
    $USER = new User(NULL);

    $result = $USER->findUserById($_POST["id"]);
    header('Content-Type: application/json');

    echo json_encode($result);
    exit();
}