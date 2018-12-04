<?php
include_once(dirname(__FILE__) . '/class/include.php');
include_once(dirname(__FILE__) . '/auth.php');
include_once(dirname(__FILE__) . '/permission.php');

$USER1 = new User($_SESSION['id']);
$message = '';
if (isset($_GET['message'])) {
    $message = $_GET['message'];
}
$MESSAGE = new Message($message);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Manage Invoices || Dashboard || NST Enterprises</title>

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

                        <?php
                        if (isset($_GET['message'])) {
                            ?>
                            <div class="alert alert-<?php echo $MESSAGE->status; ?>">
                                <strong><?php echo ucfirst($MESSAGE->status); ?> : </strong> 
                                <?php echo ucfirst($MESSAGE->description); ?>!.
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header font-header">Manage Invoices</h1>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-info">
<!--                                <div class="panel-heading">
                                    Manage Invoices
                                </div>-->
                                <div class="panel-body">
                                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Invoice No.</th>
                                                <th>Job No.</th>
                                                <th>Created Date</th>
                                                <th>Consignee</th>
                                                <th>Consignment</th>
                                                <th>Invoice Amount</th>
                                                <th>Options</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach (Invoice::all() as $invoice) {
                                                $JOBCOSTINGCARD = new JobCostingCard($invoice['job_costing_card']);
                                                $JOB = new Job($JOBCOSTINGCARD->job);
                                                $CONSIGNEE = new Consignee($JOB->consignee);
                                                $CONSIGNMENT = new Consignment($JOB->consignment);
                                                
                                                ?>
                                                <tr id="row_<?php echo $invoice['id']; ?>">
                                                    <td><?php echo $invoice['id']; ?></td>
                                                    <td><?php echo $JOBCOSTINGCARD->invoiceNumber; ?></td>
                                                    <td><?php echo $JOB->reference_no; ?></td>
                                                    <td><?php echo $invoice['createdAt']; ?></td>
                                                    <td><?php echo $CONSIGNEE->name; ?></td>
                                                    <td><?php echo $CONSIGNMENT->name; ?></td>
                                                    <td class="text-right"><?php echo $invoice['payable_amount']; ?></td>
                                                    <td class="text-center" style="width: 250px"> 
                                                        <a href="view-invoice.php?id=<?php echo $JOBCOSTINGCARD->id; ?>" class="op-link btn btn-sm btn-info" title="View Invoice"><i class="glyphicon glyphicon-eye-open"></i></a>
                                                        |
                                                        <a href="create-invoice.php?id=<?php echo $JOBCOSTINGCARD->id; ?>" class="op-link btn btn-sm btn-success" title="Edit Invoice"><i class="glyphicon glyphicon-pencil"></i></a>
                                                        |
                                                        <a href="invoice.php?id=<?php echo $JOBCOSTINGCARD->id; ?>" class="op-link btn btn-sm btn-warning" title="Print Invoice" target="blank"><i class="glyphicon glyphicon-print"></i></a>
                                                        |
                                                        <a href="#" class="delete-invoice btn btn-sm btn-danger" data-id="<?php echo $invoice['id']; ?>" title="Delete">
                                                            <i class="glyphicon glyphicon-trash" data-type="cancel"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
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
        <script src="delete/js/invoice.js" type="text/javascript"></script>
        <script>
            $(document).ready(function () {
                $('#dataTables-example').DataTable({
                    responsive: true,
                    "lengthMenu": [[100, 250, 500, 1000, -1], [100, 250, 500, 1000, "All"]],
                    "order": [[ 3, "desc" ]]
                });
            });
        </script>
    </body>
</html>

