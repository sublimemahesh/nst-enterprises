<?php
include_once(dirname(__FILE__) . '/class/include.php');
include_once(dirname(__FILE__) . '/auth.php');
include_once(dirname(__FILE__) . '/permission.php');

$consigneeid = '';
if (isset($_GET['id'])) {
    $consigneeid = $_GET['id'];
}

$CONSIGNEE = new Consignee($consigneeid);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Job Report By Consignee || Dashboard || NST Enterprises</title>
        <link href="plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/job-report-by-consignee.css" rel="stylesheet" type="text/css"/>

    </head>

    <body>
        <div id="wrapper">
            <div class="col-lg-12 topic">
                <h1><?php echo strtoupper($CONSIGNEE->name); ?></h1>
            </div>

            <table width="100%" id="balance" border="1">
                <thead>
                    <tr>
                        <th class="text-center">S/N</th>
                        <th class="text-center">Date</th>
                        <th class="text-center">D.Note Number</th>
                        <th class="text-center">Job Number</th>
                        <th class="text-center">Consignment</th>
                        <th class="text-center">Total</th>
                        <th class="text-center">Advance</th>
                        <th class="text-center">Due</th>
                        <th class="text-center">Refund</th>
                        <th class="text-center">Settle</th>
                        <th class="text-center">Balance</th>
                        <th class="text-center">Receipt No</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach (Invoice::getInvoiceByConsignee($consigneeid) as $invoice) {
                        $CONSIGNMENT = new Consignment($invoice['consignment']);
                        $invoiceno = substr($invoice['invoice_number'],15,19);
                            ?>
                            <tr>
                                <td width="40"><?php echo $i; ?></td>
                                <td width="110"><?php echo $invoice['invoice_date']; ?></td>
                                <td width="90"><?php echo $invoiceno; ?></td>
                                <td width="60"><?php echo substr($invoice['job_reference_no'],15,19); ?></td>
                                <td><?php echo $CONSIGNMENT->name; ?></td>
                                <td width="110" class="text-right"><?php echo number_format($invoice['payable_amount'], 2); ?></td>
                                <td width="110" class="text-right"><?php echo number_format($invoice['advance'], 2); ?></td>
                                <td width="110" class="text-right"><?php echo number_format($invoice['due'], 2); ?></td>
                                <td width="110" class="text-right"><?php echo number_format($invoice['refund'], 2); ?></td>
                                <td width="110" class="text-right"><?php echo number_format($invoice['settle'], 2); ?></td>
                                <td width="110" class="text-right"><?php
                                    if ($invoice['status'] === 'refund') {
                                        echo '(' . number_format($invoice['balance'], 2) . ')';
                                    } else {
                                        echo number_format($invoice['balance'], 2);
                                    }
                                    ?></td>
                                <td width="110" class="text-right"><?php echo $invoice['receipt_no']; ?></td>
                            </tr>
                            <?php
                            $i++;
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
