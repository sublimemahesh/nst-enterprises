<?php
include_once(dirname(__FILE__) . '/class/include.php');
include_once(dirname(__FILE__) . '/auth.php');
include_once(dirname(__FILE__) . '/permission.php');

$USER1 = new User($_SESSION['id']);
$jobcostingcard = '';
if (isset($_GET['id'])) {
    $jobcostingcard = $_GET['id'];
}

//$INVOICE = Invoice::getInvoiceByJobCostingCard($jobcostingcard);

$JOBCOSTINGCARD = new JobCostingCard($jobcostingcard);
$JOB = new Job($JOBCOSTINGCARD->job);
$CONSIGNEE = new Consignee($JOB->consignee);
$CONSIGNMENT = new Consignment($JOB->consignment);
$VESSELANDFLIGHT = new VesselAndFlight($JOB->vesselAndFlight);
$REIMBURSEMENTITEMS = ReimbursementItem::getReimbursementItemsForInvoice();
$INVOICE = Invoice::getInvoiceByJobCostingCard($jobcostingcard);
if ($INVOICE) {
    $DELIVERYDETAILS = InvoiceDeliveryDetails::getDeliveryDetailsByInvoice($INVOICE['id']);
}

$JOBPAYMENT = JobPayment::getSumOfPaymentsByJob($JOBCOSTINGCARD->job);
if (empty($JOBPAYMENT['sum'])) {
    $advance = 0;
} else {
    $advance = $JOBPAYMENT['sum'];
}

$grandtotal = ReimbursementDetails::getGrandTotalByJobCostingCard($jobcostingcard);

$len = strlen($CONSIGNEE->vatNumber);
$vat_last_no = substr($CONSIGNEE->vatNumber, $len - 4, $len);

$address = explode(",", $CONSIGNEE->address);
$count = count($address);
?>

<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Invoice || Dashboard || NST Enterprises</title>

        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <!-- Bootstrap Core CSS -->
        <link href="plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <!-- MetisMenu CSS -->
        <link href="plugins/metisMenu/metisMenu.min.css" rel="stylesheet" type="text/css"/>
        <!-- Custom CSS -->
        <link href="css/sb-admin-2.css" rel="stylesheet" type="text/css"/>
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
        <link href="css/invoice.css" rel="stylesheet" type="text/css"/>
        <!-- Custom Fonts -->
        <link href="plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <!-- Responsive CSS -->
        <link href="css/responsive.css" rel="stylesheet" type="text/css"/>
        <link href="plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css"/>
        <style>
            h1{
                text-align: left;
            }
            #wrapper {
                width: 100%;
            }
            .form-control {
                margin-bottom: 4px;
                margin-top: 2px;
                margin-right: 68px;
                margin-left: 5px;
                width: 97%;
                height: 30px;
            }
        </style>
    </head>

    <body>

        <div id="wrapper">

            <!-- Navigation -->
            <?php
            include 'navigation-and-header.php';
            ?>
            <!-- /Navigation -->

            <!-- Page Content -->
            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="my-alert">
                        <?php
                        $vali = new Validator();
                        $vali->show_message();
                        ?>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header font-header"><span class="inv-title"></span>Invoice</h1>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-info">
                                <!--                                <div class="panel-heading">
                                                                    Create Tax Invoice
                                                                </div>
                                                                <ul class="header-dropdown">
                                                                    <li class="">
                                                                        <a href="manage-job-costing-cards.php">
                                                                            <i class="glyphicon glyphicon-list"></i> 
                                                                        </a>
                                                                    </li>
                                                                </ul>-->
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-12">  

                                            <!--<form method="post" action="post-and-get/invoice.php">-->
                                            <table class="table1">
                                                <tr class="tr-border">
                                                    <th colspan="4" class="text-center">TAX INVOICE</th>

                                                </tr>
                                                <tr>
                                                    <td class="col-2 text-to row-padding-left" >To. </td>
                                                    <td class="col-3 td-border text-to v-align-middle "><?php echo $CONSIGNEE->name; ?></td>
                                                    <td class="col-4 row-padding-left v-align-middle">Vat Reg No</td>
                                                    <td class="col-5 v-align-middle p-l-17">409206123-7000</td>

                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td class="td-border v-align-middle"><?php if($count >= 1) {echo $address[0]; }; ?></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td class="td-border v-align-middle"><?php if($count >= 2) {echo $address[1]; } ?></td>
                                                    <td class="row-padding-left v-align-middle">Invoice No</td>
                                                    <td class="v-align-middle p-l-17"><?php echo $JOBCOSTINGCARD->invoiceNumber; ?></td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td class="td-border v-align-top">
                                                        <?php 
                                                        $ad = '';
                                                        if($count >= 3) {
                                                            for($i=2; $i<$count; $i++) {
                                                                $ad .= $address[$i];
                                                            }
                                                            echo $ad;
                                                        }
                                                             ?></td>
                                                    <td class="row-padding-left v-align-middle">Date</td>
                                                    <td><input type="text" class="form-control form-control-border" id="created_at" name="created_at" value="" autocomplete="off" /></td>
                                                </tr>

                                                <tr>
                                                    <td class="row-padding-left v-align-middle">Vat No.</td>
                                                    <td class="td-border v-align-middle"><?php echo $CONSIGNEE->vatNumber; ?></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td class="td-border"></td>
                                                    <td class="row-padding-left v-align-middle">Job No</td>
                                                    <td class="v-align-middle p-l-17"><?php echo $JOB->reference_no; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-to row-padding-left"> Consignment</td>
                                                    <td class="td-border text-to"><?php echo $CONSIGNMENT->name . '<br />' . strtoupper($CONSIGNMENT->description); ?></td>
                                                    <td class="row-padding-left v-align-middle">Cleared Date</td>
                                                    <td><input type="text" class="form-control form-control-border" id="datepicker1" name="cleared_date" value="" autocomplete="off" /></td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td class="v-align-middle td-border"><?php echo $JOB->chassisNumber; ?></td>
                                                    <td class="row-padding-left v-align-top">Gross Weight</td>
                                                    <td class="v-align-top">
                                                        <table class='table-gross-weight'>
                                                            <tr>
                                                                <td><input type="text" class="form-control form-control-border" name="gross_weight" id="gross_weight" value="" autocomplete="off" /></td>
                                                                <td>Kgs</td>
                                                            </tr>
                                                        </table>

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td class="v-align-middle td-border"></td>
                                                    <td class="row-padding-left v-align-middle">Volume</td>
                                                    <td class=""><input type="text" class="form-control form-control-border" name="volume" id="volume" value="" autocomplete="off" /></td>

                                                </tr>
                                                <tr class="tr-border">
                                                    <td class="row-padding-left v-align-middle">Vessel/Flight</td>
                                                    <td class="td-border td-padding v-align-middle"><?php echo $VESSELANDFLIGHT->name . ' OF ' . date("d M Y", strtotime($JOB->vesselAndFlightDate)); ?></td>
                                                    <td class="row-padding-bottom row-padding-left v-align-middle">Cusdec No & Date</td>
                                                    <td class="row-padding-bottom"><input type="text" class="form-control form-control-border" name="cusdec_no" id="cusdec_no" value="" autocomplete="off" /></td>
                                                </tr>

                                                <tr>
                                                    <td></td>
                                                    <td colspan="2" class="td-border"></td>
                                                    <td class="td-border1 td-text"><b>Value</b></td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td colspan="2" class="td-border v-align-middle">AGENCY FEES</td>
                                                    <td class="row-padding-right"><input type="text" class="form-control form-control-border text-right" name="agency_fees" id="agency_fees" value="" autocomplete="off" /></td>        
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td colspan="2" class="td-border v-align-middle">DOCUMENTATION</td>
                                                    <td class="row-padding-right"><input type="text" class="form-control form-control-border text-right" name="documentation" id="documentation" value="" autocomplete="off" /></td>        
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td colspan="2" class="td-border v-align-middle">VAT 15%</td>
                                                    <td class="row-padding-right"><input type="text" class="form-control form-control-border text-right" name="vat" id="vat" vat="" value="" disabled="" autocomplete="off" /></td>       
                                                </tr>
                                                <tr>
                                                    <td colspan="3" class="td-tax-invoice-total row-padding-right">Tax Invoice Total</td>
                                                    <td class="td-border-top1 text-right row-padding-right p-r-26" id="tax-invoice-total" total=""></td>

                                                </tr>
                                            </table>

                                            <table class="table1">
                                                <tr>
                                                    <th colspan="2" class="col-9 text-center">Reimbursement</th>
                                                    <th class="col-5 th-border text-center">Value</th>
                                                </tr>

                                                <tr>
                                                    <td class="col-2 text-to row-padding-left" >Statutory</td>
                                                    <td class="col-6 td-border"></td>
                                                    <td class="col-5"></td>
                                                </tr>

                                                <?php
                                                foreach ($REIMBURSEMENTITEMS as $reimbursementitem) {
                                                    $reimbursementdetails = ReimbursementDetails::getReimbursementDetailsByReimbursementItemAndJobCostingCard($reimbursementitem['id'], $jobcostingcard);

                                                    if ($reimbursementdetails) {
                                                        if ($reimbursementdetails['invoice_amount'] || $reimbursementdetails['invoice_amount'] == '') {
                                                            if ($reimbursementdetails['invoice_amount']) {
                                                                $amount = $reimbursementdetails['invoice_amount'];
                                                            } else {
                                                                $amount = $reimbursementdetails['amount'];
                                                            }
//                                                            dd($amount);
                                                            ?>
                                                            <tr class="reimbursement-details">
                                                                <td></td>        
                                                                <td class="td-border v-align-middle pl-2"><?php echo $reimbursementitem['name']; ?></td>        
                                                                <td class="row-padding-right"><input type="" class="form-control form-control-border reimbursement text-right" id="id-<?php echo $reimbursementdetails['id']; ?>" rid="<?php echo $reimbursementdetails['id']; ?>" amount="<?php echo $amount; ?>" value="<?php echo number_format($amount, 2); ?>" autocomplete="off" /></td>        
                                                            </tr>
                                                            <?php
                                                        }
                                                    }
                                                }
                                                ?>
                                                <tr>
                                                    <td></td>        
                                                    <td class="td-border"></td>        
                                                    <td class="text-right"></td>        
                                                </tr>


                                                <tr>
                                                    <td colspan="2" class="td-tax-invoice-total row-padding-right">Sub Total</td>
                                                    <td class="td-border-top1 text-right row-padding-right p-r-26" id="statutory-sub-total" total="<?php echo $grandtotal['grandtotal']; ?>"><?php echo number_format($grandtotal['grandtotal']); ?></td>

                                                </tr>

                                            </table>

                                            <table class="table1">
                                                <tr>
                                                    <td class="col-2 text-to row-padding-left" >Delivery</td>
                                                    <td class="col-6 td-border"></td>
                                                    <th class="col-5 th-border text-center">Value</th>
                                                </tr>

                                                <?php
                                                if ($INVOICE) {
                                                    if ($DELIVERYDETAILS) {
                                                        foreach ($DELIVERYDETAILS as $data) {
                                                            $did = $data['id'];
                                                            ?>
                                                            <tr class="delivery-details">
                                                                <td><input type="hidden" did="<?php echo $data['id']; ?>" value="<?php echo $did; ?>" id="id"/></td>        
                                                                <td class="td-border v-align-middle"><input type="text" class="form-control form-control-border delivery text-left delivery-name" id="" rid="" amount="" value="<?php echo $data['name']; ?>" autocomplete="off" /></td>        
                                                                <td class="row-padding-right"><input type="text" class="form-control form-control-border delivery text-right delivery-amount" id="did-<?php echo $data['id']; ?>" did="<?php echo $data['id']; ?>" amount="<?php echo $data['amount']; ?>" value="<?php echo number_format($data['amount'], 2); ?>" autocomplete="off" /></td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    } else {
                                                        ?>
                                                        <tr class="delivery-details">
                                                            <td><input type="hidden" class="" id="id" value="" /></td>        
                                                            <td class="td-border v-align-middle"><input type="text" class="form-control form-control-border delivery text-left delivery-name" id="" did="" amount="" value="HANDLING" autocomplete="off" readonly="readonly" /></td>        
                                                            <td class="row-padding-right"><input type="text" class="form-control form-control-border delivery text-right delivery-amount" id="" did="" amount="" value="" autocomplete="off" /></td>
                                                        </tr>
                                                        <tr class="delivery-details">
                                                            <td><input type="hidden" class="" id="id" value="" /></td>        
                                                            <td class="td-border v-align-middle"><input type="text" class="form-control form-control-border delivery text-left delivery-name" id="" did="" amount="" value="EXAMINATION" autocomplete="off" readonly="readonly" /></td>        
                                                            <td class="row-padding-right"><input type="text" class="form-control form-control-border delivery text-right delivery-amount" id="" did="" amount="" value="" autocomplete="off" /></td>
                                                        </tr>
                                                        <tr class="delivery-details">
                                                            <td><input type="hidden" class="" id="id" value="" /></td>        
                                                            <td class="td-border v-align-middle"><input type="text" class="form-control form-control-border delivery text-left delivery-name" id="" did="" amount="" value="OTHER EXPENCESS" autocomplete="off" readonly="readonly" /></td>        
                                                            <td class="row-padding-right"><input type="text" class="form-control form-control-border delivery text-right delivery-amount" id="" did="" amount="" value="" autocomplete="off" /></td>
                                                        </tr>
                                                        <tr class="delivery-details">
                                                            <td><input type="hidden" class="" id="id" value="" /></td>        
                                                            <td class="td-border v-align-middle"><input type="text" class="form-control form-control-border delivery text-left delivery-name" id="" did="" amount="" value="OTHER EXPENCESS & VAL" autocomplete="off" readonly="readonly" /></td>        
                                                            <td class="row-padding-right"><input type="text" class="form-control form-control-border delivery text-right delivery-amount" id="" did="" amount="" value="" autocomplete="off" /></td>
                                                        </tr>
                                                        <tr class="delivery-details">
                                                            <td><input type="hidden" class="" id="id" value="" /></td>        
                                                            <td class="td-border v-align-middle"><input type="text" class="form-control form-control-border delivery text-left delivery-name" id="" did="" amount="" value="DRIVER" autocomplete="off" readonly="readonly" /></td>        
                                                            <td class="row-padding-right"><input type="text" class="form-control form-control-border delivery text-right delivery-amount" id="" did="" amount="" value="" autocomplete="off" /></td>
                                                        </tr>
                                                        <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <tr class="delivery-details">
                                                        <td><input type="hidden" class="" id="id" value="" /></td>        
                                                        <td class="td-border v-align-middle"><input type="text" class="form-control form-control-border delivery text-left delivery-name" id="" did="" amount="" value="HANDLING" autocomplete="off" readonly="readonly" /></td>        
                                                        <td class="row-padding-right"><input type="text" class="form-control form-control-border delivery text-right delivery-amount" id="" did="" amount="" value="" autocomplete="off" /></td>
                                                    </tr>
                                                    <tr class="delivery-details">
                                                        <td><input type="hidden" class="" id="id" value="" /></td>        
                                                        <td class="td-border v-align-middle"><input type="text" class="form-control form-control-border delivery text-left delivery-name" id="" rid="" amount="" value="EXAMINATION" autocomplete="off" readonly="readonly" /></td>        
                                                        <td class="row-padding-right"><input type="text" class="form-control form-control-border delivery text-right delivery-amount" id="" did="" amount="" value="" autocomplete="off" /></td>
                                                    </tr>
                                                    <tr class="delivery-details">
                                                        <td><input type="hidden" class="" id="id" value="" /></td>        
                                                        <td class="td-border v-align-middle"><input type="text" class="form-control form-control-border delivery text-left delivery-name" id="" rid="" amount="" value="OTHER EXPENCESS" autocomplete="off" readonly="readonly" /></td>        
                                                        <td class="row-padding-right"><input type="text" class="form-control form-control-border delivery text-right delivery-amount" id="" did="" amount="" value="" autocomplete="off" /></td>
                                                    </tr>
                                                    <tr class="delivery-details">
                                                        <td><input type="hidden" class="" id="id" value="" /></td>        
                                                        <td class="td-border v-align-middle"><input type="text" class="form-control form-control-border delivery text-left delivery-name" id="" rid="" amount="" value="OTHER EXPENCESS & VAL" autocomplete="off" readonly="readonly" /></td>        
                                                        <td class="row-padding-right"><input type="text" class="form-control form-control-border delivery text-right delivery-amount" id="" did="" amount="" value="" autocomplete="off" /></td>
                                                    </tr>
                                                    <tr class="delivery-details">
                                                        <td><input type="hidden" class="" id="id" value="" /></td>        
                                                        <td class="td-border v-align-middle"><input type="text" class="form-control form-control-border delivery text-left delivery-name" id="" rid="" amount="" value="DRIVER" autocomplete="off" readonly="readonly" /></td>        
                                                        <td class="row-padding-right"><input type="text" class="form-control form-control-border delivery text-right delivery-amount" id="" did="" amount="" value="" autocomplete="off" /></td>
                                                    </tr>
                                                    <?php
                                                }
                                                ?>

                                                <?php
                                                for ($i = 0; $i < 6; $i++) {
                                                    ?>
                                                    <tr class="delivery-details">
                                                        <td><input type="hidden" class="" id="id" value="" /></td>        
                                                        <td class="td-border v-align-middle"><input type="text" class="form-control form-control-border delivery text-left delivery-name" id="" rid="" amount="" value="" autocomplete="off" /></td>        
                                                        <td class="row-padding-right"><input type="text" class="form-control form-control-border delivery text-right delivery-amount" id="" rid="" amount="" value="" autocomplete="off" /></td>
                                                    </tr>
                                                    <?php
                                                }
                                                ?>


                                                <tr>
                                                    <td></td>        
                                                    <td class="td-border"></td>        
                                                    <td class="text-right"></td>        
                                                </tr>


                                                <tr>
                                                    <td colspan="2" class="td-tax-invoice-total row-padding-right">Sub Total</td>
                                                    <td class="td-border-top1 text-right row-padding-right p-r-26" id="delivery-sub-total" total="<?php echo $grandtotal['grandtotal']; ?>"><?php echo number_format($grandtotal['grandtotal']); ?></td>

                                                </tr>

                                            </table>

                                            <table class="table-pay">

                                                <tr>
                                                    <td rowspan="3" colspan="2" class="col-2"></td>
                                                    <td class="col-7 td-border td-border-top td-border-left v-align-middle">Payable Amount</td>
                                                    <td class="col-8 td-border td-border-top text-right row-padding-right p-r-26 th-border" id="payable-amount" name="payable_amount" amount=""></td>
                                                </tr>

                                                <tr>
                                                    <td class="td-border td-border-left v-align-middle">Advance</td>
                                                    <td class="td-border row-padding-right th-border"><input type="text" class="form-control form-control-border text-right" id="advance"  advance="<?php echo $advance; ?>" name="advance" value="<?php echo number_format($advance); ?>" autocomplete="off" style="height: 10px;" readonly /></td>
                                                </tr>
                                                <tr id="tr-due" class="hidden">
                                                    <td class="td-border td-border1 td-border-left v-align-middle">Due</td>
                                                    <td class="td-border td-border1 text-right row-padding-right p-r-26 th-border" id="due" name="due" due=""></td>
                                                </tr>
                                                <tr  id="tr-refund" class="hidden">
                                                    <td class="td-border td-border1 td-border-left v-align-middle">Refund</td>
                                                    <td class="td-border td-border1 text-right row-padding-right p-r-26 th-border" id="refund" name="refund" refund=""></td>
                                                </tr>
                                            </table>

    <!--                                            <table class="table-amount-word">
                                                    <tr>
                                                        <td class="col-2">Amount In Word Rs.</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center" id="amount-in-word"></td>
                                                    </tr>
                                                </table>
                                                <div>
                                                    <p><strong>
                                                            ALL CHEQUES SHOULD BE DRAWN IN FAVOUR OF 'N.S.T. ENTERPRISES' AND CROSSED A/C PAYEE N.S.T. ENTERPRISES
                                                        </strong></p>
                                                </div>-->
                                            <input type="hidden" name="job_costing_card" id="job_costing_card"  value="<?php echo $jobcostingcard; ?>"/>
                                            <div class="col-sm-8 col-md-offset-4 form-btn tax-invoice-btn">
                                                <input type="hidden" name="id" id="id" value="" />
                                                <div class="col-sm-3">
                                                    <button type="button" class="btn btn-info savebtn hidden" id="savebutton">Save Tax Invoice</button>
                                                    <button type="button" class="btn btn-info savebtn hidden" id="editbutton">Save Changes</button>
                                                </div>
                                                <div class="col-sm-3">
                                                    <button type="button" class="btn btn-success saveprintbtn hidden" id="savebutton-print">Save & Print</button>
                                                    <button type="button" class="btn btn-success saveprintbtn hidden" id="editbutton-print">Save & Print</button>
                                                    <!--<a href="invoice.php?id=<?php echo $jobcostingcard; ?>" target="blank"><i class="glyphicon glyphicon-print btn btn-lg btn-success"></i></a>--> 
                                                    <input type="hidden" id="vat_no" value="<?php echo $vat_last_no; ?>"
                                                </div>
                                            </div>
                                            <!--</form>-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Page Content -->
        </div>

        <!-- jQuery -->
        <script src="js/jquery.min.js" type="text/javascript"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src="plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- Metis Menu Plugin JavaScript -->
        <script src="plugins/metisMenu/metisMenu.min.js" type="text/javascript"></script>
        <!-- Custom Theme JavaScript -->
        <script src="js/sb-admin-2.js" type="text/javascript"></script>
        <script src="js/consignee.js" type="text/javascript"></script>
        <script src="plugins/sweetalert/sweetalert.min.js" type="text/javascript"></script>
        <script src="js/invoice-details.js" type="text/javascript"></script>
        <script src="js/create-invoice.js" type="text/javascript"></script>
        <script src="js/invoice.js" type="text/javascript"></script>
        <script src="plugins/loader/js/jquery.loading.block.js" type="text/javascript"></script>
        <script src="js/print-and-save-invoice.js" type="text/javascript"></script>
        <script>
            $(function () {
                $("#datepicker1").datepicker({dateFormat: 'yy-mm-dd'});
                $("#created_at").datepicker({dateFormat: 'yy-mm-dd'});
            });
            $(function () {
                $("#advance").focusout();
            });

        </script>

    </body>

</html>
