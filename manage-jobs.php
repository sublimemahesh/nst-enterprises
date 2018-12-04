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

        <title>Manage Jobs || Dashboard || NST Enterprises</title>

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
        <style>
            td a:hover {
                text-decoration: none;
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
                            <h1 class="page-header font-header">Manage All Jobs</h1>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    Manage Jobs
                                </div>
                                <ul class="header-dropdown">
                                    <li class="">
                                        <a href="create-job.php">
                                            <i class="glyphicon glyphicon-plus"></i> 
                                        </a>
                                    </li>
                                </ul>
                                <div class="panel-body">
                                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>Job No</th>
                                                <th>Date</th>
                                                <th>Consignee</th>
                                                <th>Consignment</th>
                                                <th>Vessel or Flight</th>
                                                <th>Options</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach (Job::all() as $job) {
                                                $vesselorflight = $job['vesselAndFlight'];
                                                $VESSELANDFLIGHT = new VesselAndFlight($vesselorflight);
                                                $CONSIGNEE = new Consignee($job['consignee']);
                                                $CONSIGNMENT = new Consignment($job['consignment']);
                                                ?>
                                                <tr id="row_<?php echo $job['id']; ?>">
                                                    <td><a href="view-job.php?id=<?php echo $job['id']; ?>" target="blank"><?php echo $job['reference_no']; ?></a></td>
                                                    <td><?php echo $job['createdAt']; ?></td>
                                                    <td><a href="view-consignee.php?id=<?php echo $CONSIGNEE->id; ?>" target="new" title="View Consignee"><?php echo $CONSIGNEE->name; ?></a></td>
                                                    <td><a href="view-consignment.php?id=<?php echo $CONSIGNMENT->id; ?>" target="new" title="View Consignment"><?php echo $CONSIGNMENT->name; ?></a></td>
                                                    <td><a href="view-vessel-flight.php?id=<?php echo $VESSELANDFLIGHT->id; ?>" target="new" title="View Vessel or Flight" ><?php echo $VESSELANDFLIGHT->name; ?></a></td>
                                                    <td class="text-center" style="width: 200px"> 
                                                        <a href="view-job.php?id=<?php echo $job['id']; ?>" class="op-link btn btn-sm btn-warning" title="View"><i class="glyphicon glyphicon-eye-open"></i></a>
                                                        |
                                                        <a href="edit-job.php?id=<?php echo $job['id']; ?>" class="op-link btn btn-sm btn-success" title="Edit Invoice"><i class="glyphicon glyphicon-pencil"></i></a>
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

        <script src="delete/js/job.js" type="text/javascript"></script>

        <script>
            $(document).ready(function () {
                $('#dataTables-example').DataTable({
                    responsive: true,
                    "lengthMenu": [[100, 250, 500, 1000, -1], [100, 250, 500, 1000, "All"]],
                    "order": [[ 1, "desc" ]]
                });
            });
            
        </script>
    </body>

</html>
