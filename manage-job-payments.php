<?php
include_once(dirname(__FILE__) . '/class/include.php');
include_once(dirname(__FILE__) . '/auth.php');
include_once(dirname(__FILE__) . '/permission.php');

$USER1 = new User($_SESSION['id']);
$id = '';
if(isset($_GET['id'])) {
    $id = $_GET['id'];
}
$JOB = new Job($id);
date_default_timezone_set('Asia/Colombo');
$createdAt = date('Y-m-d H:i:s');
?>

<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Manage Job Payments || Dashboard || NST Enterprises</title>

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
                            <h1 class="page-header font-header">Job Payments - #<?php echo $JOB->reference_no; ?></h1>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    Create Job Payment
                                </div>
                                <ul class="header-dropdown">
                                    <li class="">
<!--                                        <a href="manage-consignees.php">
                                            <i class="glyphicon glyphicon-list"></i> 
                                        </a>-->
                                    </li>
                                </ul>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <form id="form-consignee"  method="post" action="post-and-get/job-payment.php">
                                                <div class="form-group">
                                                    <label class="col-md-3">Customer Name</label>
                                                    <input type="text" class="form-control col-md-9" placeholder="Enter name" name="name" id="name" autocomplete="off">
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3">Payment</label>
                                                    <input type="text" class="form-control col-md-9" placeholder="Enter Payment" name="payment" id="payment" autocomplete="off">
                                                </div>
                                                
                                                <div class="col-sm-12 col-md-offset-3 form-btn">
                                                    <input type="hidden" id="createdAt" name="createdAt" value="<?php echo $createdAt; ?>" />
                                                    <input type="hidden" id="job" name="job" value="<?php echo $id; ?>" />
                                                    <button type="submit" name="create-payment" id="create-payment" class="btn btn-info">Save Payment</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    Manage Job Payments
                                </div>
                                <ul class="header-dropdown">
                                    
                                </ul>
                                <div class="panel-body">
                                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Created At</th>
                                                <th>Customer Name</th>
                                                <th>Payment</th>
                                                <th>Options</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach (JobPayment::getPaymentsByJob($id) as $payment) {
                                                ?>
                                                <tr id="row_<?php echo $payment['id']; ?>">
                                                    <td><?php echo $payment['id']; ?></td>
                                                    <td><?php echo $payment['createdAt']; ?></td>
                                                    <td><?php echo $payment['customer_name']; ?></td>
                                                    <td class="text-right"><?php echo number_format($payment['payment'],2); ?></td>
                                                    <td class="text-center" style="width: 200px"> 
                                                        <a href="edit-job-payment.php?id=<?php echo $payment['id']; ?>" class="op-link btn btn-sm btn-success" title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>
                                                        |
                                                        <a href="#" class="delete-job-payment btn btn-sm btn-danger" data-id="<?php echo $payment['id']; ?>" title="Delete">
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
        <script src="js/job-payment.js" type="text/javascript"></script> 
        <script src="delete/js/job-payment.js" type="text/javascript"></script>

        <script>
            $(document).ready(function () {
                $('#dataTables-example').DataTable({
                    responsive: true,
                    "lengthMenu": [[100, 250, 500, 1000, -1], [100, 250, 500, 1000, "All"]]
                });
            });
        </script>
    </body>

</html>
