<?php
include_once(dirname(__FILE__) . '/class/include.php');
include_once(dirname(__FILE__) . '/auth.php');
include_once(dirname(__FILE__) . '/permission.php');

$USER1 = new User($_SESSION['id']);

$consigneeid = '';
if (isset($_GET['id'])) {
    $consigneeid = $_GET['id'];
}
$CONSIGNEE = new Consignee($consigneeid);
?>

<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Manage <?php echo $CONSIGNEE->name; ?>'s Job Report || Control Panel || NST ENterprises</title>

        <!-- Bootstrap Core CSS -->
        <link href="plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <!-- MetisMenu CSS -->
        <link href="plugins/metisMenu/metisMenu.min.css" rel="stylesheet" type="text/css"/>
        <!-- Custom CSS -->
        <link href="css/sb-admin-2.css" rel="stylesheet" type="text/css"/>
        <!-- Custom Fonts -->
        <link href="plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
        <!-- DataTables CSS -->
        <link href="plugins/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet" type="text/css"/>
        <!-- DataTables Responsive CSS -->
        <link href="plugins/datatables-responsive/dataTables.responsive.css" rel="stylesheet" type="text/css"/>
        <!-- Sweetalerts -->
        <link href="plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css"/>
        <!-- Responsive CSS -->
        <link href="css/responsive.css" rel="stylesheet" type="text/css"/>

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
                            <h1 class="page-header font-header"><?php echo $CONSIGNEE->name; ?></h1>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    Manage <?php echo $CONSIGNEE->name; ?>'s Job Report
                                </div>
                                <ul class="header-dropdown">
                                    <li class="">
                                        <a href="manage-consignees.php">
                                            <i class="glyphicon glyphicon-plus"></i> 
                                        </a>
                                    </li>
                                </ul>
                                <div class="panel-body">
                                    <table width="100%" class="table table-striped table-bordered table-hover" id="balance">
                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th>Date</th>
                                                <th>D.Note Number</th>
                                                <th>Job Number</th>
                                                <th>Consignment</th>
                                                <th>Total</th>
                                                <th>Advance</th>
                                                <th>Due</th>
                                                <th>Refund</th>
                                                <th>Settle</th>
                                                <th>Balance</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            foreach (Job::getJobsByConsignee($consigneeid) as $job) {
                                                $CONSIGNMENT = new Consignment($job['consignment']);
                                                $JOBCOSTINGCARD = JobCostingCard::getJobCostingCardIdByJob($job['id']);
                                                $INVOICE = Invoice::getInvoiceByJobCostingCard($JOBCOSTINGCARD['id']);
                                                ?>
                                                <tr id="row_<?php echo $job['id']; ?>" invoiceid="<?php echo $INVOICE['id']; ?>">
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo $job['createdAt']; ?></td>
                                                    <td><?php echo $job['debitNoteNumber']; ?></td>
                                                    <td><?php echo $job['id']; ?></td>
                                                    <td><?php echo $CONSIGNMENT->name; ?></td>
                                                    <td class="text-right"><?php echo number_format($INVOICE['payable_amount'],2); ?></td>
                                                    <td class="text-right"><?php echo number_format($INVOICE['advance'],2); ?></td>
                                                    <td class="text-right" id="due_<?php echo $i; ?>" due="<?php
                                                    if ($INVOICE['due'] == 0.00) {
                                                        echo '0';
                                                    } else {
                                                        echo $INVOICE['due'];
                                                    }
                                                    ?>"><?php echo $INVOICE['due']; ?></td>
                                                    <td class="text-right" id="refund_<?php echo $i; ?>" refund="<?php
                                                    if ($INVOICE['refund'] == 0.00) {
                                                        echo '0';
                                                    } else {
                                                        echo $INVOICE['refund'];
                                                    }
                                                    ?>"><?php echo $INVOICE['refund']; ?></td>
                                                    <td class="text-right"><input type="text" name="settle" id="settle_<?php echo $i; ?>" settle="<?php echo $INVOICE['settle']; ?>" class="settle text-right settle_<?php echo $INVOICE['id']; ?>" invoice="<?php echo $INVOICE['id']; ?>" rowid="<?php echo $i; ?>" value="<?php echo $INVOICE['settle']; ?>"/></td>
                                                    <td class="text-right balance_<?php echo $INVOICE['id']; ?>" id="balance_<?php echo $i; ?>" status="" invoice="<?php echo $INVOICE['id']; ?>" balance=""></td>
                                                </tr>
                                                <?php
                                                $i++;
                                            }
                                            ?>
                                        </tbody>
                                    </table>

                                    <div class="col-sm-12 col-md-offset-4 form-btn tax-invoice-btn">
                                        <div class="col-sm-2">
                                            <button type="button" class="btn btn-info savebtn" id="savebutton">Save Changes</button>
                                        </div>
                                        <div class="col-sm-3">
                                            <a href="#" target="blank"><i class="glyphicon glyphicon-print btn btn-lg btn-success"></i></a> 
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
        <!-- Bootstrap Core JavaScript -->
        <script src="plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- Metis Menu Plugin JavaScript -->
        <script src="plugins/metisMenu/metisMenu.min.js" type="text/javascript"></script>
        <!-- Custom Theme JavaScript -->
        <script src="js/sb-admin-2.js" type="text/javascript"></script>
        <!-- DataTables JavaScript -->
        <script src="plugins/datatables/js/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="plugins/datatables-plugins/dataTables.bootstrap.min.js" type="text/javascript"></script>
        <script src="plugins/datatables-responsive/dataTables.responsive.js" type="text/javascript"></script>
        <!-- Sweetalerts -->
        <script src="plugins/sweetalert/sweetalert.min.js" type="text/javascript"></script>
        <script src="delete/js/consignee.js" type="text/javascript"></script>
        <script src="js/job-report-by-consignee.js" type="text/javascript"></script>

        <script>
            $(document).ready(function () {
                $('#dataTables-example').DataTable({
                    responsive: true
                });
            });
        </script>
    </body>

</html>
