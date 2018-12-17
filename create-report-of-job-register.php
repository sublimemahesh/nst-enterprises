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

        <title>Manage Job Register Report || Dashboard || NST Enterprises</title>

        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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
                            <h1 class="page-header font-header">Job Register Report</h1>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    Manage Job Register Report
                                </div>
                                <div class="panel-body">
                                    <div class="form-group col-md-6">
                                        <label class="col-md-2">From</label>
                                        <input type="text" class="form-control col-md-10" placeholder="Enter Date" id="from" autocomplete="off" value="">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="col-md-2">To</label>
                                        <input type="text" class="form-control col-md-10" placeholder="Enter Date" id="to" autocomplete="off" value="">
                                    </div>


                                    <table width="100%" class="table table-striped table-bordered table-hover" id="balance">
                                        <thead>
                                            <tr>
                                                <th>J/NO</th>
                                                <th>CONSIGNEE</th>
                                                <th>DESCRIPTION</th>
                                                <th>VESSEL / FLIGHT</th>
                                                <th>V.DATE</th>
                                                <th>COPY</th>
                                                <th>ORIGINAL</th>
                                                <th>INVOICE</th>
                                                <th>CUSDEC NO</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>

                                    <div class="col-sm-8 col-md-offset-4 form-btn tax-invoice-btn">
                                        <div class="col-sm-3">
                                            <a  target="new"><i class="glyphicon glyphicon-print btn btn-lg btn-success" id="print-btn"></i></a> 
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
        <!-- DataTables JavaScript -->
        <script src="plugins/datatables/js/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="plugins/datatables-plugins/dataTables.bootstrap.min.js" type="text/javascript"></script>
        <script src="plugins/datatables-responsive/dataTables.responsive.js" type="text/javascript"></script>
        <!-- Sweetalerts -->
        <script src="plugins/sweetalert/sweetalert.min.js" type="text/javascript"></script>
        <script src="delete/js/consignee.js" type="text/javascript"></script>
        <!--<script src="js/job-report-by-consignee.js" type="text/javascript"></script>-->
        <script src="js/report-of-job-register.js" type="text/javascript"></script>
        <script src="plugins/loader/js/jquery.loading.block.js" type="text/javascript"></script>

        <script>
            $(document).ready(function () {
                $('#dataTables-example').DataTable({
                    responsive: true
                });
            });
        </script>
        <script>
            $(function () {
                $("#from").datepicker({dateFormat: 'yy-mm-dd'});
                $("#to").datepicker({dateFormat: 'yy-mm-dd'});
            });
        </script>

       
    </body>

</html>
