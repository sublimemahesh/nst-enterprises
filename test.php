<?php
include_once(dirname(__FILE__) . '/class/include.php');

$VESSELANDFLIGHT = new VesselAndFlight(NULL);

$RESULT = $VESSELANDFLIGHT->getActiveAll();
dd($VESSELANDFLIGHT);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // put your code here
        ?>
    </body>
</html>
