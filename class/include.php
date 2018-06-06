<?php

include_once(dirname(__FILE__) . '/Database.php');
include_once(dirname(__FILE__) . '/Upload.php');
include_once(dirname(__FILE__) . '/Setting.php');
include_once(dirname(__FILE__) . '/VesselAndFlight.php');
include_once(dirname(__FILE__) . '/User.php');
include_once(dirname(__FILE__) . '/Consignee.php');
include_once(dirname(__FILE__) . '/Consignment.php');
include_once(dirname(__FILE__) . '/Job.php');

function dd($data) {
    var_dump($data);
    exit();
}

function redirect($url) {
    $string = '<script type="text/javascript">';
    $string .= 'window.location = "' . $url . '"';
    $string .= '</script>';

    echo $string;
    exit();
}
