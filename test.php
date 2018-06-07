<?php
include_once(dirname(__FILE__) . '/class/include.php');

$VESSELANDFLIGHT = new VesselAndFlight(NULL);
$USER = new User(NULL);
$CONSIGNEE = new Consignee(NULL);
$CONSIGNMENT = new Consignment(NULL);
$JOB = new Job(NULL);
$JOBC = new JobCostingCard(NULL);
$REIM = new ReimbursementItem(NULL);

$RESULT = $REIM->all();
dd($RESULT);
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
