<?php
include_once(dirname(__FILE__) . '/class/include.php');
include_once(dirname(__FILE__) . '/auth.php');
include_once(dirname(__FILE__) . '/permission.php');


$jobcostingcard = '';
if (isset($_GET['id'])) {
    $jobcostingcard = $_GET['id'];
}
$INVOICE = Invoice::getInvoiceByJobCostingCard($jobcostingcard);

if(empty($INVOICE)) {
    if(isset($_GET['back'])) {
        header('location: view-job.php?id='.$_GET['back'].'&message=20');
    }
    
}

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
$grandtotal = ReimbursementDetails::getGrandTotalByJobCostingCard($jobcostingcard);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>

        <link href="css/invoice.css" rel="stylesheet" type="text/css"/>
    </head>

    <body>
        <div id="wrapper">        
            <div class="row">
                <div class="col-lg-12">
                    <h1>N.S.T. ENTERPRISES</h1>
                    <h4>CLEARING & FORWARDING AGENTS </h4>
                    <h4>NO. 116B, ST'ANTONY'S MAWATHA, COLOMBO 13. TEL:0112-336796/0117-207250 FAX:0112-388055 </h4>
                </div>
            </div>

            <table class="table1">
                <tr class="tr-border">
                    <th colspan="4">TAX INVOICE</th>

                </tr>
                <tr>
                    <td rowspan="4" class="col-2 text-to row-padding-left" >To. </td>
                    <td rowspan="4" class="col-3 td-border text-to"><?php echo $CONSIGNEE->name . '<br />' . $CONSIGNEE->address; ?></td>
                    <td class="col-4 row-padding-left">Vat Reg No</td>
                    <td class="col-5"><?php echo $INVOICE['vat_reg_no']; ?></td>

                </tr>
                <tr>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td class="row-padding-left">Invoice No</td>
                    <td><?php echo $JOBCOSTINGCARD->invoiceNumber; ?></td>
                </tr>
                <tr>
                    <td class="row-padding-left">Date</td>
                    <td><?php echo $INVOICE['createdAt']; ?></td>
                </tr>

                <tr>
                    <td class="row-padding-left">Vat No.</td>
                    <td class="td-border"><?php echo $CONSIGNEE->vatNumber; ?></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td class="td-border"></td>
                    <td class="row-padding-left">Job No</td>
                    <td><?php echo $JOB->reference_no; ?></td>
                </tr>
                <tr>
                    <td rowspan="3" class="text-to row-padding-left"> Consignment</td>
                    <td rowspan="3" class="td-border text-to"><?php echo $CONSIGNMENT->name; ?></td>
                    <td class="row-padding-left">Cleared Date</td>
                    <td><?php echo $INVOICE['cleared_date']; ?></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>

                </tr>
                <tr>
                    <td class="row-padding-left">Gross Weight</td>
                    <td><?php echo $INVOICE['gross_weight']; ?></td>

                </tr>
                <tr class="">
                    <td class="row-padding-left">Vessel/Flight</td>
                    <td class="td-border td-padding"><?php echo $VESSELANDFLIGHT->name; ?></td>
                    <td class="row-padding-left">Volume</td>
                    <td class=""><?php echo $INVOICE['volume']; ?></td>
                </tr>
                <tr class="tr-border">
                    <td class="row-padding-bottom row-padding-left v-align-middle"></td>
                    <td class="td-border td-padding row-padding-bottom v-align-middle"></td>
                    <td class="row-padding-bottom row-padding-left v-align-middle">Cusdec No</td>
                    <td class="row-padding-bottom"><?php echo $INVOICE['cusdec_no']; ?></td>
                </tr>

                <tr>
                    <td></td>
                    <td colspan="2" class="td-border"></td>
                    <td class="td-border1 td-text"><b>Value</b></td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="2" class="td-border row-padding-left">AGENCY FEES</td>
                    <td class="text-right row-padding-right"><?php echo number_format($INVOICE['agency_fees'], 2); ?></td>        
                </tr>
                <tr>
                    <td></td>
                    <td colspan="2" class="td-border row-padding-left">DOCUMENTATION</td>
                    <td class="text-right row-padding-right"><?php echo number_format($INVOICE['documentation'], 2); ?></td>        
                </tr>
                <tr>
                    <td></td>
                    <td colspan="2" class="td-border row-padding-left">VAT 15%</td>
                    <td class="text-right row-padding-right"><?php echo number_format($INVOICE['vat'], 2); ?></td>       
                </tr>
                <tr>
                    <td></td>
                    <td colspan="2" class="td-border"></td>
                    <td></td>        
                </tr>
                <tr>
                    <td colspan="3" class="td-tax-invoice-total row-padding-right">Tax Invoice Total</td>
                    <td class="td-border-top1 text-right row-padding-right" id="tax-invoice-total" total=""><?php echo number_format($INVOICE['tax_total'], 2); ?></td>

                </tr>
            </table>

            <table class="table1">
                <tr>
                    <th colspan="2" class="col-9">Reimbursement</th>
                    <th class="col-5 th-border">Value</th>
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
                            ?>
                            <tr>
                                <td></td>        
                                <td class="td-border"><?php echo $reimbursementitem['label']; ?></td>        
                                <td class="text-right row-padding-right"><?php echo number_format($amount, 2); ?></td>        
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
                    <td class="td-border-top1 text-right row-padding-right" id="statutory-sub-total" total=""><?php echo number_format($INVOICE['statutory_sub_total'], 2); ?></td>

                </tr>

            </table>

            <table class="table1">
                <tr>
                    <td class="col-2 text-to row-padding-left" >Delivery</td>
                    <td class="col-6 td-border"></td>
                    <th class="col-5 th-border">Value</th>
                </tr>

                <?php
                if ($INVOICE) {
                    foreach ($DELIVERYDETAILS as $data) {
                        $did = $data['id'];
                        ?>
                        <tr class="delivery-details">
                            <td><input type="hidden" did="<?php echo $data['id']; ?>" value="<?php echo $did; ?>" id="id"/></td>        
                            <td class="td-border"><?php echo strtoupper($data['name']); ?></td>        
                            <td class="text-right row-padding-right"><?php echo number_format($data['amount'], 2); ?></td>
                        </tr>
                        <?php
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
                    <td class="td-border-top1 text-right row-padding-right" id="delivery-sub-total" total=""><?php echo number_format($INVOICE['delivery_sub_total'], 2); ?></td>

                </tr>

            </table>

            <table class="table-pay">

                <tr>
                    <td rowspan="3" colspan="2" class="col-2"></td>
                    <td class="col-7 td-border td-border-top  td-border-left">Payable Amount</td>
                    <td class="col-8 td-border td-border-top text-right row-padding-right" id="payable-amount" amount=""><?php echo number_format($INVOICE['payable_amount'], 2); ?></td>
                </tr>

                <tr>
                    <td class="td-border td-border-left">Advance</td>
                    <td class="td-border text-right row-padding-right" id="advance" advance="1000"><?php echo number_format($INVOICE['advance'], 2); ?></td>
                </tr>
                <?php
                if ($INVOICE['due'] === '0.00') {
                    ?>
                    <tr>
                        <td class="td-border td-border1 td-border-left">Refund</td>
                        <td class="td-border td-border1 text-right row-padding-right" id="final" final="<?php echo $INVOICE['refund']; ?>"><?php echo '(' . number_format($INVOICE['refund'], 2) . ')'; ?></td>
                    </tr>
                    <?php
                } else {
                    ?>
                    <tr>
                        <td class="td-border td-border1 td-border-left">Due</td>
                        <td class="td-border td-border1 text-right row-padding-right" id="final" final="<?php echo $INVOICE['due']; ?>"><?php echo number_format($INVOICE['due'], 2); ?></td>
                    </tr>
                    <?php
                }
                ?>

            </table>

            <table class="table-amount-word">
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
            </div>

        </div>

        <script src="js/jquery.min.js" type="text/javascript"></script>
        <script src="js/amount-to-word.js" type="text/javascript"></script>
        
    </body>
</html>
