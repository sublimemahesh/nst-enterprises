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

        <title>Add New Job || Control Panel || NST ENterprises</title>

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
                            <h1 class="page-header font-header">Jobs</h1>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    Add New Job
                                </div>
                                <ul class="header-dropdown">
                                    <li class="">
                                        <a href="manage-jobs.php">
                                            <i class="glyphicon glyphicon-list"></i> 
                                        </a>
                                    </li>
                                </ul>
                                <div class="panel-body">
                                    <div class="row">
                                        <!--<div class="col-lg-12">-->
                                        <form method="post" action="post-and-get/job.php">
                                            <div class="form-group">
                                                <label class="col-md-3">Consignee</label>
                                                <input type="text" class="form-control col-md-8" id="name" autocomplete="off" placeholder="Enter consignee name" value="">
                                                <div id="suggesstion-box">
                                                    <ul id="name-list-append" class="name-list col-md-offset-3"></ul>
                                                </div>
                                                <input type="hidden" name="consignee" value="" id="name-id"  />
                                                <div class="col-md-1">
                                                    <i class="fa fa-save btn btn-info btn-sm" id="add-consignee"></i>
                                                </div>

                                            </div>


                                            <!--                                                <div class="create-consignee hidden" id="create-consignee">
                                                                                                Add new consignee. <i class="glyphicon glyphicon-plus-sign pull-right"></i>
                                            
                                                                                            </div>-->
                                            <div class="form-group">
                                                <label class="col-md-3">Consignment</label>
                                                <input type="text" class="form-control col-md-8" id="consignment" placeholder="Enter consignment" autocomplete="off">
                                                <div id="suggesstion-box">
                                                    <ul id="consignment-list-append" class="consignment-list col-md-offset-3"></ul>
                                                </div>
                                                <input type="hidden" name="consignment" value="" id="consignment-id"  />
                                                <div class="col-md-1">
                                                    <i class="fa fa-save btn btn-info btn-sm" id="add-consignment"></i>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-3">Description</label>
                                                <textarea class="form-control col-md-9" placeholder="Enter description" name="description" id="description"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3">Chassis Number</label>
                                                <input type="text" class="form-control col-md-9" placeholder="Enter chassis number" name="chassisNumber" id="chassisNumber">
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3">Vessel or Flight</label>
                                                <select class="form-control col-md-9" name="vesselAndFlight" id="vesselAndFlight">
                                                    <option value="">-- Please Select --</option>
                                                    <?php
                                                    foreach (VesselAndFlight::all() as $vesselandflight) {
                                                        ?>
                                                        <option value="<?php echo $vesselandflight['id']; ?>"><?php echo $vesselandflight['name']; ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3">Vessel and Flight Date</label>
                                                <input type="text" id="datepicker1" class="form-control col-md-9" placeholder="Enter date" name="vesselAndFlightDate" autocomplete="off">
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3">Copy Received Date</label>
                                                <input type="text" id="datepicker2" class="form-control col-md-9" placeholder="Enter date" name="copyReceivedDate" autocomplete="off">
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3">Original Received Date</label>
                                                <input type="text" id="datepicker3" class="form-control col-md-9" placeholder="Enter date" name="originalReceivedDate" autocomplete="off">
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3">Debit Note Number</label>
                                                <input type="text" class="form-control col-md-9" placeholder="Enter debit note number" name="debitNoteNumber">
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3">Cusdec Date</label>
                                                <input type="text" id="datepicker4" class="form-control col-md-9" placeholder="Enter cusdec date" name="cusdecDate" autocomplete="off">
                                            </div>
                                            <div class="col-md-2 col-md-offset-5">
                                                <button type="submit" id="btn-job" name="create-job" class="btn btn-primary" disabled="">Save Job</button>
                                            </div>
                                        </form>

                                        <?php include 'modal.php'; ?>
                                        <!--</div>-->
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
        <script src="js/add-consignee.js" type="text/javascript"></script>

        <script src="js/job-consignee.js" type="text/javascript"></script>
        <script src="js/add-consignment.js" type="text/javascript"></script>
        <script src="js/create-job.js" type="text/javascript"></script>
        <script src="plugins/sweetalert/sweetalert.min.js" type="text/javascript"></script>
        
        <script>
            $(function () {
                $("#datepicker1").datepicker({dateFormat: 'yy-mm-dd'});
                $("#datepicker2").datepicker({dateFormat: 'yy-mm-dd'});
                $("#datepicker3").datepicker({dateFormat: 'yy-mm-dd'});
                $("#datepicker4").datepicker({dateFormat: 'yy-mm-dd'});
            });
        </script>
        <script>
            jQuery(document).ready(function () {
                jQuery('#add-consignee').click(function () {
                    var name = $("#name").val();
                    $("#consignee-name").val(name);
                    jQuery("#modal-consignee").modal('show');

                });
                jQuery('#add-consignment').click(function () {
                    var name = $("#consignment").val();
                    $("#consignment-name").val(name);
                    jQuery("#modal-consignment").modal('show');

                });
            });
        </script>

    </body>

</html>
