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

        <title>Add New Consignee || Control Panel || NST ENterprises</title>

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
                                    Add New Consignee
                                </div>
                                <ul class="header-dropdown">
                                    <li class="">
                                        <a href="manage-consignees.php">
                                            <i class="glyphicon glyphicon-list"></i> 
                                        </a>
                                    </li>
                                </ul>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <form id="form-consignee"  method="post" action="post-and-get/consignee.php">
                                                <div class="form-group">
                                                    <label class="col-md-3">Name</label>
                                                    <input type="text" class="form-control col-md-9" placeholder="Enter name" name="name" id="name" autocomplete="off">
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3">Address</label>
                                                    <textarea class="form-control col-md-9" placeholder="Enter address" name="address" id="address"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3">VAT Number</label>
                                                    <input type="text" class="form-control col-md-9" placeholder="Enter VAT number" name="vatNumber">
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3">Contact Number</label>
                                                    <input type="text" class="form-control col-md-9" placeholder="Enter contact number" name="contactNumber">
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3">Email</label>
                                                    <input type="email" class="form-control col-md-9" placeholder="Enter email" name="email">
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3">Description</label>
                                                    <textarea class="form-control col-md-9" placeholder="Enter description" name="description"></textarea>
                                                </div>
                                                <div class="col-sm-12 text-center">
                                                    <button type="submit" name="create-consignee" id="create-consignee" id="btn-consignee" class="btn btn-info">Save Consignee</button>
                                                </div>
                                            </form>
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
        <script src="js/consignee.js" type="text/javascript"></script>
        <script src="plugins/sweetalert/sweetalert.min.js" type="text/javascript"></script>

    </body>

</html>
