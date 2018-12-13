<?php
include_once(dirname(__FILE__) . '/class/include.php');
include_once(dirname(__FILE__) . '/auth.php');
include_once(dirname(__FILE__) . '/permission.php');

$USER1 = new User($_SESSION['id']);
$id = '';
if(isset($_GET['id'])) {
    $id = $_GET['id'];
}
$PAYMENT = new JobPayment($id);

?>

<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Edit Job Payment || Dashboard || NST Enterprises</title>

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
                            <h1 class="page-header font-header">Edit Job Payment - #<?php echo $PAYMENT->id; ?></h1>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-info">
<!--                                <div class="panel-heading">
                                    Edit Job Payment
                                </div>
                                <ul class="header-dropdown">
                                    <li class="">
                                        <a href="manage-consignees.php">
                                            <i class="glyphicon glyphicon-list"></i> 
                                        </a>
                                    </li>
                                </ul>-->
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <form id="form-consignee"  method="post" action="post-and-get/job-payment.php">
                                                <div class="form-group">
                                                    <label class="col-md-3">Customer Name</label>
                                                    <input type="text" class="form-control col-md-9" placeholder="Enter name" name="name" id="name" autocomplete="off" value="<?php echo $PAYMENT->customer_name; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3">Payment</label>
                                                    <input type="text" class="form-control col-md-9" placeholder="Enter Payment" name="payment" id="payment" autocomplete="off" value="<?php echo $PAYMENT->payment; ?>">
                                                </div>
                                                
                                                <div class="col-sm-9 col-md-offset-3 form-btn">
                                                    <input type="hidden" id="id" name="id" value="<?php echo $id; ?>" />
                                                    <button type="submit" name="edit-payment" id="edit-payment" class="btn btn-info">Save Changes</button>
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
        <!-- DataTables JavaScript -->
        
        <!-- Sweetalerts -->
        <script src="plugins/sweetalert/sweetalert.min.js" type="text/javascript"></script>
        <script src="js/job-payment.js" type="text/javascript"></script> 
        
    </body>

</html>
