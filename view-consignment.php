<?php
include_once(dirname(__FILE__) . '/class/include.php');
include_once(dirname(__FILE__) . '/auth.php');
include_once(dirname(__FILE__) . '/permission.php');

$USER1 = new User($_SESSION['id']);

$id = '';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
$CONSIGNMENT = new Consignment($id);
?>

<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>View Consignment || Dashboard || NST Enterprises</title>

        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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
        <style>
            @media (max-width: 768px) {
                .btn-group-sm > .btn, .btn-sm {
                    padding: 5px 10px;
                }
            }
            tr {
                height: 35px;
            }
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
                            <h1 class="page-header font-header">View Consignment - #<?php echo $CONSIGNMENT->id; ?></h1>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-info">
<!--                                <div class="panel-heading">
                                    View Consignment - #<?php echo $CONSIGNMENT->id; ?>
                                </div>
                                <ul class="header-dropdown">
                                    <li class="">
                                        <a href="manage-jobs.php">
                                            <i class="glyphicon glyphicon-list"></i> 
                                        </a>
                                    </li>
                                </ul>-->
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-8 col-md-offset-1">
                                            <table class="table table-striped">
                                                <tr>
                                                    <td class="view-details-topic">Name</td>
                                                    <td><?php echo $CONSIGNMENT->name; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="view-details-topic">Description</td>
                                                    <td><?php
                                                        if ($CONSIGNMENT->description) {
                                                            echo $CONSIGNMENT->description;
                                                        } else {
                                                            echo '-';
                                                        };
                                                        ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="view-details-topic">Status</td>
                                                    <td><?php
                                                        if ($CONSIGNMENT->isActive == 1) {
                                                            ?>
                                                               <i class="glyphicon glyphicon-check op-link btn btn-sm btn-info"</i>
                                                               <?php
                                                        } else {
                                                            ?>
                                                               <i class="glyphicon glyphicon-unchecked op-link btn btn-sm btn-info"></i>
                                                               <?php
                                                        }
                                                        ?>
                                                </tr>
                                            </table>

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
            <script src="plugins/sweetalert/sweetalert.min.js" type="text/javascript"></script>
            <script src="plugins/loader/js/jquery.loading.block.js" type="text/javascript"></script>

    </body>

</html>
