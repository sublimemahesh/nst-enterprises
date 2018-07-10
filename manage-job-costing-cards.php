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

        <title>Manage Job Costing Cards || Control Panel || NST ENterprises</title>

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
                            <h1 class="page-header font-header">Job Costing Cards</h1>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    Manage Job Costing Cards
                                </div>
                                <div class="panel-body">
                                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Job</th>
                                                <th>Date</th>
                                                <th>Options</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach (JobCostingCard::all() as $jobcostingcard) {
                                                ?>
                                                <tr id="row_<?php echo $jobcostingcard['id']; ?>">
                                                    <td><?php echo $jobcostingcard['id']; ?></td>
                                                    <td><?php echo $jobcostingcard['job']; ?></td>
                                                    <td><?php echo $jobcostingcard['date']; ?></td>
                                                    <td class="text-center" style="width: 250px"> 
                                                        <a href="edit-job-costing-card.php?id=<?php echo $jobcostingcard['id']; ?>" class="op-link btn btn-sm btn-success" title="Edit Job Costing Card"><i class="glyphicon glyphicon-pencil"></i></a>
                                                        |
                                                        <a href="create-reimbursement-details.php?id=<?php echo $jobcostingcard['id']; ?>" class="op-link btn btn-sm btn-info" title="Reimbursement Details"><i class="glyphicon glyphicon-list"></i></a>
                                                        |
                                                        <a href="job-costing-card-report.php?id=<?php echo $jobcostingcard['id']; ?>" class="op-link btn btn-sm btn-warning" title="Report" target="blank"><i class="glyphicon glyphicon-duplicate"></i></a>
                                                        |
                                                        <a href="create-invoice.php?id=<?php echo $jobcostingcard['id']; ?>" class="op-link btn btn-sm btn-primary" title="Tax Invoice"><i class="glyphicon glyphicon-list-alt"></i></a>
                                                        |
                                                        <a href="#" class="delete-job-costing-card btn btn-sm btn-danger" data-id="<?php echo $jobcostingcard['id']; ?>" title="Delete">
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

        <script src="delete/js/job-costing-card.js" type="text/javascript"></script>

        <script>
            $(document).ready(function () {
                $('#dataTables-example').DataTable({
                    responsive: true
                });
            });
        </script>
    </body>

</html>
