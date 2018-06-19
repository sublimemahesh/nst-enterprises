<?php
include_once(dirname(__FILE__) . '/class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

$jobcostingcard = '';
if (isset($_GET['id'])) {
    $jobcostingcard = $_GET['id'];
}

$REIMBURSEMENTITEMS = ReimbursementItem::all();
$REIMBURSEMENTDETAILS = ReimbursementDetails::getReimbursementDetailsByJobCostingCard($jobcostingcard);
$JOBCOSTINGCARD = new JobCostingCard($jobcostingcard);
$JOB = new Job($JOBCOSTINGCARD->job);
$CONSIGNEE = new Consignee($JOB->consignee);
$CONSIGNMENT = new Consignment($JOB->consignment);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>

        <link href="css/job-costing-card.css" rel="stylesheet" type="text/css"/>
    </head>

    <body>
        <div id="wrapper">        
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="table-header">JOB COSTING CARD</h1>
                </div>
            </div>

            <table class="table">

                <tr>
                    <td>JOB NO:</td>
                    <td><?php echo $JOBCOSTINGCARD->job; ?></td>
                </tr>
                <tr>
                    <td>INVOICE NUMBER:</td>
                    <td></td>
                </tr>
                <tr>
                    <td>CONSIGNEE</td>
                    <td><?php echo $CONSIGNEE->name; ?></td>
                </tr>
                <tr>
                    <td>CONSIGNMENT</td>
                    <td><?php echo $CONSIGNMENT->name; ?></td>    
                </tr>

            </table>

            <!--Table-->

            <table class="table2 table-bordered" border="1">

                <!--Table head-->
                <tr>
                    <th class="col-1"></th>
                    <th class="text-center table-td-width col-2">V/NO</th>
                    <th class="text-center table-td-width col-3">AMOUNT</th>
                    <th class="text-center table-td-width col-4">DESCRIPTION</th>
                    <th class="text-center table-td-width col-5">SUB TOTAL</th>
                </tr>
                <!--Table head-->

                <!--Table body-->
                <?php
                foreach ($REIMBURSEMENTITEMS as $reimbursementitem) {
                    foreach ($REIMBURSEMENTDETAILS as $reimbursementdetail) {
                        ?>
                        <tr>
                            <td><?php echo $reimbursementitem['name']; ?></td>
                            <td><?php
                                if ($reimbursementitem['id'] === $reimbursementdetail['reimbursementItem']) {
                                    echo $reimbursementdetail['voucherNumber'];
                                }
                                ?></td>
                            <td><?php
                                if ($reimbursementitem['id'] === $reimbursementdetail['reimbursementItem']) {
                                    echo $reimbursementdetail['amount'];
                                }
                                ?></td>
                            <td><?php
                                if ($reimbursementitem['id'] === $reimbursementdetail['reimbursementItem']) {
                                    echo $reimbursementdetail['description'];
                                }
                                ?></td>
                            <td></td>
                        </tr>
                        <?php
                    }
                }
                ?>


                <!--Table body-->

            </table>

            <table class="profit-table">
                <tr>
                    <td>GROSS PROFIT</td>
                    <td>11456.00</td>
                    <td>GRAND TOTAL</td>
                    <td>44555.00</td>
                </tr>
            </table>
        </div>






        <!--        <div id="print_button">
                    <a href="#" class="btn btn-success btn-lg" onClick="myFunction()">
                        <span class="glyphicon glyphicon-print"></span> Print
                    </a>
                </div>-->


        <script src="js/jquery.min.js" type="text/javascript"></script>
        <script>

//                $(document).ready(function () {
//                    myFunction();
//                });

            function myFunction() {
                window.print();
            }
        </script>
    </body>
</html>
