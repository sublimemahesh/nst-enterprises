<?php
include_once(dirname(__FILE__) . '/class/include.php');
include_once(dirname(__FILE__) . '/auth.php');
include_once(dirname(__FILE__) . '/permission.php');

$USER1 = new User($_SESSION['id']);
?>

<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Manage Accounts || Dashboard || NST Enterprises</title>

        <!-- Bootstrap Core CSS -->
        <link href="plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <!-- MetisMenu CSS -->
        <link href="plugins/metisMenu/metisMenu.min.css" rel="stylesheet" type="text/css"/>
        <!-- Custom CSS -->
        <link href="css/sb-admin-2.css" rel="stylesheet" type="text/css"/>
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
        <!-- Custom Fonts -->
        <link href="plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <!-- Responsive CSS -->
        <link href="css/responsive.css" rel="stylesheet" type="text/css"/>
        <link href="plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css"/>
        <!-- DataTables CSS -->
        <link href="plugins/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet" type="text/css"/>
        <!-- DataTables Responsive CSS -->
        <link href="plugins/datatables-responsive/dataTables.responsive.css" rel="stylesheet" type="text/css"/>
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
                            <h1 class="page-header font-header">Accounts</h1>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-lg-12">
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    Manage Accounts
                                </div>
                                <ul class="header-dropdown">
                                    <li class="">
                                        <a href="create-account.php">
                                            <i class="glyphicon glyphicon-plus"></i> 
                                        </a>
                                    </li>
                                </ul>
                                <div class="panel-body">
                                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <th>Is Cleared</th>
                                                <th>Cleared Date</th>
                                                <th>Last Invoice Id</th>
                                                <th>Last Job Id</th>
                                                <th>Options</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach (Account::all() as $account) {

                                                $month = date("m");
                                                $today = date("Y-m-d");

                                                $getStartYear = explode('-', $account['start_date']);
                                                $startyear = $getStartYear[0];

                                                $getEndYear = explode('-', $account['end_date']);
                                                $year = $getEndYear[0];
                                                $endyear = substr($year, -2);



                                                if ($account['current_invoice_id'] < 10) {
                                                    $invoiceid = '0' . $account['current_invoice_id'];
                                                } else {
                                                    $invoiceid = $account['current_invoice_id'];
                                                }
                                                if ($account['current_job_id'] < 10) {
                                                    $jobid = '0' . $account['current_job_id'];
                                                } else {
                                                    $jobid = $account['current_job_id'];
                                                }
                                                $invoice = 'NST/' . $startyear . '/' . $endyear . '/' . $month . $invoiceid;
                                                $job = 'NST/' . $startyear . '/' . $endyear . '/' . $month . $jobid;
                                                ?>
                                                <tr id="row_<?php echo $account['id']; ?>">
                                                    <td style="width: 50px;"><?php echo $account['id']; ?></td>
                                                    <td><?php echo $account['start_date']; ?></td>
                                                    <td><?php echo $account['end_date']; ?></td>
                                                    <td class="text-center">
                                                        <?php
                                                        if ($account['isCleared'] == 0) {
                                                            ?>
                                                            <a href="#" title="Current Account" class="op-link btn btn-sm btn-info"><i class="glyphicon glyphicon-check"></i></a>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <a href="#" title="Cleared Account" class="op-link btn btn-sm btn-info"><i class="glyphicon glyphicon-unchecked"></i></a>
                                                            <?php
                                                        }
                                                        ?>
                                                    </td>
                                                    <td><?php if($account['cleared_date']) {echo $account['cleared_date'];} else { echo '-'; }; ?></td>
                                                    <td><?php echo $invoice; ?></td>
                                                    <td><?php echo $job; ?></td>
                                                    <td class="text-center"> 
                                                        <a href="edit-account.php?id=<?php echo $account['id']; ?>" class="op-link btn btn-sm btn-success" title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>
                                                        |
                                                        <a href="#" class="clear-account btn btn-sm btn-warning" data-id="<?php echo $account['id']; ?>"  title="Clear Account">
                                                            <i class="glyphicon glyphicon-remove" data-type="cancel"></i>
                                                        </a>
                                                        |
                                                        <a href="#" class="delete-account btn btn-sm btn-danger" data-id="<?php echo $account['id']; ?>"  title="Delete">
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
        <script src="js/costing-items.js" type="text/javascript"></script>
        <script src="plugins/sweetalert/sweetalert.min.js" type="text/javascript"></script>
        <script src="plugins/loader/js/jquery.loading.block.js" type="text/javascript"></script>
        <!-- DataTables JavaScript -->
        <script src="plugins/datatables/js/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="plugins/datatables-plugins/dataTables.bootstrap.min.js" type="text/javascript"></script>
        <script src="plugins/datatables-responsive/dataTables.responsive.js" type="text/javascript"></script>
        <script src="delete/js/account.js" type="text/javascript"></script>

        <script>
            $(document).ready(function () {
                $('#dataTables-example').DataTable({
                    responsive: true
                });
            });
        </script>

    </body>

</html>
