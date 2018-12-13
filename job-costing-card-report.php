<?php
include_once(dirname(__FILE__) . '/class/include.php');
include_once(dirname(__FILE__) . '/auth.php');
include_once(dirname(__FILE__) . '/permission.php');


$jobcostingcard = '';
if (isset($_GET['id'])) {
    $jobcostingcard = $_GET['id'];
}
$COSTINGTYPES = CostingType::all();
$REIMBURSEMENTITEMS = ReimbursementItem::all();

$JOBCOSTINGCARD = new JobCostingCard($jobcostingcard);
$JOB = new Job($JOBCOSTINGCARD->job);
$CONSIGNEE = new Consignee($JOB->consignee);
$CONSIGNMENT = new Consignment($JOB->consignment);

$grandtotal = ReimbursementDetails::getGrandTotalByJobCostingCard($jobcostingcard);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Job Costing Card Report || Dashboard || NST Enterprises</title>

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
                    <td class="td-style"><?php echo $JOB->reference_no; ?></td>
                </tr>
                <tr>
                    <td>INVOICE NUMBER:</td>
                    <td class="td-style"><?php echo $JOBCOSTINGCARD->invoiceNumber; ?></td>
                </tr>
                <tr>
                    <td>CONSIGNEE</td>
                    <td class="td-style"><?php echo $CONSIGNEE->name; ?></td>
                </tr>
                <tr>
                    <td>CONSIGNMENT</td>
                    <td class="td-style"><?php echo $CONSIGNMENT->name; ?></td>    
                </tr>

            </table>

            <!--Table-->
            <?php
            foreach ($COSTINGTYPES as $key=>$type) {
                $counttype = ReimbursementDetails::getCountByJobCostingCardAndType($jobcostingcard, $type['id']);
                if ($counttype['count'] > 0) {
                    ?>
                    <table class="table2 table-bordered to-hide" id="table-<?php echo $type['id']; ?>" border="1">

                        <?php
                        if($key === 0) {
                            ?>
                        <!--Table head-->
                        <thead class="">
                            <tr>
                                <th class="col-1"></th>
                                <th class="text-center table-td-width col-2">V/NO</th>
                                <th class="text-center table-td-width col-3">AMOUNT</th>
                                <th class="text-center table-td-width col-4">DESCRIPTION</th>
                                <th class="text-center table-td-width col-5">SUB TOTAL</th>
                            </tr>
                        </thead>
                        <!--Table head-->
                        <?php
                        }
                        
                        ?>
                        

                        <!--Table body-->
                        <tbody>
                            <?php
                            $i = 0;
                            
                                foreach (ReimbursementItem::getCostingItemsByType($type['id']) as $reimbursementitem) {
                                    $reimbursementdetails = ReimbursementDetails::getReimbursementDetailsByReimbursementItemAndType($reimbursementitem['id'], $jobcostingcard, $type['id']);

                                    if ($reimbursementdetails) {
                                        ?>
                                        <tr id="row-<?php echo $reimbursementitem['id']; ?>" type="<?php echo $reimbursementdetails['type']; ?>" rdid="<?php echo $reimbursementdetails['id']; ?>" class="">
                                            <td scope="row" rid="<?php echo $reimbursementitem['id']; ?>" class="rid"><?php echo $reimbursementitem['name']; ?></td>
                                            <td class="vno"><?php echo $reimbursementdetails['voucherNumber']; ?></td>
                                            <td class="amount text-right amount-<?php echo $reimbursementdetails['type']; ?>"><?php echo number_format($reimbursementdetails['amount']); ?></td>
                                            <td class="description text-right"><?php echo $reimbursementdetails['description']; ?></td>

                                        </tr>
                                        <?php
                                    }
                                }
                            
                            ?>
                            <!--Table body-->
                        </tbody>
                    </table>

                    <?php
                }
            }
            ?>

            <table class="profit-table">
                <tr>
                    <td>GROSS PROFIT:</td>
                    <td><input type="text" class="input-style text-right"></td>
                    <td>GRAND TOTAL:</td>
                    <td><input type="text" class="input-style grandtotal text-right" value="<?php echo number_format($grandtotal['grandtotal']); ?>" id="grandtotal"></td>
                </tr>
            </table>

            <input type="hidden" jobcostingcard="<?php echo $jobcostingcard; ?>" id="job-costing-card" />
        </div>






        <!--        <div id="print_button">
                    <a href="#" class="btn btn-success btn-lg" onClick="myFunction()">
                        <span class="glyphicon glyphicon-print"></span> Print
                    </a>
                </div>-->


        <script src="js/jquery.min.js" type="text/javascript"></script>
        <script src="js/job-costing-card-report.js" type="text/javascript"></script>
        <script>

//            $(document).ready(function () {
//                setTimeout(function () {
//                    myFunction();
//                }, 1000);
//                
//            });
//
//            function myFunction() {
//                window.print();
//            }
        </script>
    </body>
</html>
