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

        <title>Manage Consignees || Control Panel || NST ENterprises</title>

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
                            <h1 class="page-header font-header">Consignees</h1>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    Manage Consignees
                                </div>
                                <ul class="header-dropdown">
                                    <li class="">
                                        <a href="create-Consignee.php">
                                            <i class="glyphicon glyphicon-plus"></i> 
                                        </a>
                                    </li>
                                </ul>
                                <div class="panel-body">
                                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Vat Number</th>
                                                <th>Email</th>
                                                <th>Status</th>
                                                <th>Options</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach (Consignee::all() as $consignee) {
                                                ?>
                                                <tr id="row_<?php echo $consignee['id']; ?>">
                                                    <td style="width: 50px;"><?php echo $consignee['id']; ?></td>
                                                    <td><?php echo $consignee['name']; ?></td>
                                                    <td><?php echo $consignee['vatNumber']; ?></td>
                                                    <td style="width: 150px;"><?php echo $consignee['email']; ?></td>
                                                    <td class="text-center" style="width: 78px;">
                                                        <?php
                                                        if ($consignee['isActive'] == 1) {
                                                            ?>
                                                            <a href="#" title="Active" class="op-link btn btn-sm btn-info"><i class="glyphicon glyphicon-check"></i></a>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <a href="#" title="Inactive" class="op-link btn btn-sm btn-info"><i class="glyphicon glyphicon-unchecked"></i></a>
                                                            <?php
                                                        }
                                                        ?>
                                                    </td>
                                                    <td class="text-center" style="width: 230px"> 
                                                        <a href="edit-consignee.php?id=<?php echo $consignee['id']; ?>" class="op-link btn btn-sm btn-success" title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>
                                                        |
                                                        <a href="#" class="delete-consignee btn btn-sm btn-danger" data-id="<?php echo $consignee['id']; ?>"  title="Delete">
                                                            <i class="glyphicon glyphicon-trash" data-type="cancel"></i>
                                                        </a>
                                                        |
                                                        <a href="manage-consignee-jobs.php?id=<?php echo $consignee['id']; ?>" class="op-link btn btn-sm btn-warning" title="View Consignee's Jobs"><i class="glyphicon glyphicon-briefcase"></i></a>
                                                        |
                                                        <a href="create-job-report-by-consignee.php?id=<?php echo $consignee['id']; ?>" class="op-link btn btn-sm btn-info" title="Create Job Report"><i class="glyphicon glyphicon-list-alt"></i></a>
                                                        |
                                                        <a href="arrange-consignees.php" class="btn btn-sm btn-primary"  title="Arrange">
                                                            <i class="glyphicon glyphicon-random"></i>
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

        <script src="delete/js/consignee.js" type="text/javascript"></script>

        <script>
            $(document).ready(function () {
                $('#dataTables-example').DataTable({
                    responsive: true
                });
            });
        </script>
    </body>

</html>
