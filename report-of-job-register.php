<?php
include_once(dirname(__FILE__) . '/class/include.php');
include_once(dirname(__FILE__) . '/auth.php');
include_once(dirname(__FILE__) . '/permission.php');

$from = '';
$to = '';
if (isset($_GET['from'])) {
    $from = $_GET['from'];
}
if (isset($_GET['to'])) {
    $to = $_GET['to'];
}

$JOB = Job::getJobsByDateRange($from, $to);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Report By Job Register ||  Dashboard || NST Enterprises</title>
        <link href="plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/job-report-by-consignee.css" rel="stylesheet" type="text/css"/>

    </head>

    <body>
        <div id="wrapper">
            <div class="col-lg-12 topic">
                <div class="pull-left"><h1>JOB REGISTER</h1></div>
                <div class="pull-right"><h2><?php echo $from; ?> To <?php echo $to; ?></h2></div>

            </div>

            <table width="100%" id="balance" border="1">
                <thead>
                    <tr>
                        <th class="text-center">J/NO</th>
                        <th class="text-center">CONSIGNEE</th>
                        <th class="text-center">DESCRIPTION</th>
                        <th class="text-center">VESSEL / FLIGHT</th>
                        <th class="text-center">V.DATE</th>
                        <th class="text-center">COPY</th>
                        <th class="text-center">ORIGINAL</th>
                        <th class="text-center">INVOICE</th>
                        <th class="text-center">CUSDEC NO</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach (Job::getJobsByDateRange($from, $to) as $job) {
                        $CONSIGNEE = new Consignee($job['consignee']);
                        $VESSELORFLIGHT = new VesselAndFlight($job['vesselAndFlight']);
                        $JOBCOSTINGCARD = JobCostingCard::getJobCostingCardIdByJob($job['id']);
                        $INVOICE = Invoice::getInvoiceByJobCostingCard($JOBCOSTINGCARD['id']);

                        $ref_no = $job['reference_no'];
                        $len = strlen($ref_no);
                        $job_no = substr($ref_no, $len - 4, $len);
                        ?>
                        <tr>
                            <td width="40"><?php echo $job_no; ?></td>
                            <td width="110"><?php echo $CONSIGNEE->name; ?></td>
                            <td width="250"><?php echo $job['description']; ?></td>
                            <td width="100"><?php echo $VESSELORFLIGHT->name; ?></td>
                            <td width="100"><?php echo $job['vesselAndFlightDate']; ?></td>
                            <td width="100" class="text-right"><?php echo $job['copyReceivedDate']; ?></td>
                            <td width="100" class="text-right"><?php echo $job['originalReceivedDate']; ?></td>
                            <td width="160" class="text-right"><?php echo $JOBCOSTINGCARD['invoiceNumber']; ?></td>
                            <td width="100" class="text-right"><?php echo $INVOICE['cusdec_no']; ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>

        </div>


        <!--        <div id="print_button">
                    <a href="#" class="btn btn-success btn-lg" onClick="myFunction()">
                        <span class="glyphicon glyphicon-print"></span> Print
                    </a>
                </div>-->


        <script src="js/jquery.min.js" type="text/javascript"></script>
        <script src="plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

        <script>

            $(document).ready(function () {
                myFunction();
            });

            function myFunction() {
                window.print();
            }
        </script>
    </body>
</html>
