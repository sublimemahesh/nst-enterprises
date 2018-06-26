<?php

foreach (array('1','2','3') as $a) {
    echo "$a ";
    foreach (array('3','2','1') as $b) {
        echo "$b ";
        if ($a == $b) { 
            break 1;  // this will break both foreach loops
        }
    }
    echo ". ";  // never reached
}
echo "!";