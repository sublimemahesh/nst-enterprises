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
        <title>Report By Job Summary || Dashboard || NST Enterprises</title>
        <link href="plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/job-summary-report.css" rel="stylesheet" type="text/css"/>

    </head>

    <body>
        <div id="wrapper">
            <div class="col-lg-12 topic">
                <div class="pull-left"><h1>DETAILS OF JOB COSTING TOTAL AND GROSS PROFIT <?php echo $from; ?> To <?php echo $to; ?></h1></div>
                <div class="pull-right"><h2></h2></div>

            </div>

            <table width="100%" id="balance" border="1">
                <thead>
                    <tr>
                        <th class="text-center">S/N</th>
                        <th class="text-center">DATE</th>
                        <th class="text-center">INVOICE</th>
                        <th class="text-center">JOB NO.</th>
                        <th class="text-center">CONSIGNEE</th>
                        <th class="text-center">VAT NO.</th>
                        <th class="text-center">DESCRIPTION</th>
                        <th class="text-center">INVOICE AMOUNT</th>
                        <th class="text-center">COSTING AMOUNT</th>
                        <th class="text-center">GROSS PROFIT</th>
                        <th class="text-center">SERVICE INCOME WITH NBT</th>
                        <th class="text-center">VAT</th>
                        <th class="text-center">NBT</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $tot_invoice_amount = $tot_costing_amount = $tot_gross_profit = $tot_service_income = $tot_vat = $tot_nbt = 0;

                    foreach (Invoice::getInvoicesByDateRange($from, $to) as $key => $invoice) {
                        $jobcostingcard = new JobCostingCard($invoice['job_costing_card']);
                        $job = new Job($jobcostingcard->job);
                        $CONSIGNEE = new Consignee($job->consignee);
                        $CONSIGNMENT = new Consignment($job->consignment);
                        $costingamount = ReimbursementDetails::getGrandTotalByJobCostingCard($jobcostingcard->id);

                        if ((float) $invoice['payable_amount'] >= (float) $costingamount['grandtotal']) {
                            $gross = (float) $invoice['payable_amount'] - (float) $costingamount['grandtotal'];
                            $grossprofit = number_format($gross, 2);
                        } else {
                            $gross = (float) $costingamount['grandtotal'] - (float) $invoice['payable_amount'];
                            $grossprofit = '(' . number_format($gross, 2) . ')';
                        }
                        $serviceincome = (float) $invoice['agency_fees'] + (float) $invoice['documentation'];
                        $vat = $serviceincome * 15 / 100;
                        $nbt = $serviceincome * 2 / 100;


                        $tot_invoice_amount += (float) $invoice['payable_amount'];
                        $tot_costing_amount += (float) $costingamount['grandtotal'];
                        $tot_service_income += $serviceincome;
                        $tot_vat += $vat;
                        $tot_nbt += $nbt;
                        ?>
                        <tr>
                            <td width="40"><?php echo $key + 1; ?></td>
                            <td width="110"><?php echo $invoice['createdAt']; ?></td>
                            <td width="250"><?php echo $jobcostingcard->invoiceNumber; ?></td>
                            <td width="100"><?php echo $job->reference_no; ?></td>
                            <td width="100"><?php echo $CONSIGNEE->name; ?></td>
                            <td width="100"><?php echo $CONSIGNEE->vatNumber; ?></td>
                            <td width="100"><?php echo $CONSIGNMENT->name; ?></td>
                            <td width="160" class="text-right"><?php echo number_format($invoice['payable_amount'], 2); ?></td>
                            <td width="100" class="text-right"><?php echo number_format($costingamount['grandtotal'], 2); ?></td>
                            <td width="100" class="text-right"><?php echo $grossprofit; ?></td>
                            <td width="100" class="text-right"><?php echo number_format($serviceincome); ?></td>
                            <td width="100" class="text-right"><?php echo number_format($vat); ?></td>
                            <td width="100" class="text-right"><?php echo number_format($nbt); ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
                <?php
                if ($tot_invoice_amount >= $tot_costing_amount) {
                    $totgross = $tot_invoice_amount - $tot_costing_amount;
                    $tot_gross_profit = number_format($totgross, 2);
                } else {
                    $totgross = $tot_costing_amount - $tot_invoice_amount;
                    $tot_gross_profit = '(' . number_format($totgross, 2) . ')';
                }
                ?>
                <tfoot>
                    <tr>
                        <th colspan="7" class="text-center">TOTAL</th>
                        <th id="total_invoice_amount" class="text-right"><?php echo number_format($tot_invoice_amount, 2); ?></th>
                        <th id="total_costing_amount" class="text-right"><?php echo number_format($tot_costing_amount, 2); ?></th>
                        <th id="total_gross_profit" class="text-right"><?php echo $tot_gross_profit; ?></th>
                        <th id="total_service_income" class="text-right"><?php echo number_format($tot_service_income, 2); ?></th>
                        <th id="total_vat" class="text-right"><?php echo number_format($tot_vat, 2); ?></th>
                        <th id="total_nbt" class="text-right"><?php echo number_format($tot_nbt, 2); ?></th>
                    </tr>
                </tfoot>
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
