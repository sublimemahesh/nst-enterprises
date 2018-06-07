<?php

include_once(dirname(__FILE__) . '/../class/include.php');

$USER = new User(NULL);

if ($USER->logOut()) {
    header('location: ../login.php');
} else {
    header('location: ../?error=2');
}
 