<?php

include_once(dirname(__FILE__) . '/../class/include.php');

if ($_POST['option'] == 'GETNAME') {
    if (!empty($_POST["keyword"])) {
        $CONSIGNEE = new Consignee(NULL);

        $result = $CONSIGNEE->allNamesByKeyword($_POST["keyword"]);
        
        header('Content-Type: application/json');

        echo json_encode($result);
        exit();
    }
}
if ($_POST['option'] == 'GETCONSIGNMENT') {
    if (!empty($_POST["keyword"])) {
        $CONSIGNMENT= new Consignment(NULL);

        $result = $CONSIGNMENT->allNamesByKeyword($_POST["keyword"]);
        
        header('Content-Type: application/json');

        echo json_encode($result);
        exit();
    }
}

//if ($_POST['option'] == 'FINDNAME') {
//    
//    $CONSIGNEE = new Consignee(NULL);
//
//    $result = $CONSIGNEE->findNameById($_POST["id"]);
//    header('Content-Type: application/json');
//
//    echo json_encode($result);
//    exit();
//}