<?php
include_once(dirname(__FILE__) . '/class/include.php');
include_once(dirname(__FILE__) . '/auth.php');
include_once(dirname(__FILE__) . '/permission.php');

$USER1 = new User($_SESSION['id']);

$id = '';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
$JOB = new Job($id);
$CONSIGNEE = new Consignee($JOB->consignee);
$CONSIGNMENT = new Consignment($JOB->consignment);
$VESSELANDFLIGHT = new VesselAndFlight($JOB->vesselAndFlight);
?>

<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Edit Job || Dashboard || NST Enterprises</title>

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
                            <h1 class="page-header font-header">Edit Job</h1>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-info">
<!--                                <div class="panel-heading">
                                    Edit Job
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
                                        <div class="col-lg-12">
                                            <form   method="post" action="post-and-get/job.php">
                                                <div class="form-group">
                                                    <label class="col-md-3">Consignee</label>
                                                    <input type="text" class="form-control col-sm-8 col-md-8" id="name" name="name" autocomplete="off" placeholder="Enter consignee name" value="<?php echo $CONSIGNEE->name; ?>">
                                                    <div id="suggesstion-box">
                                                        <ul id="name-list-append" class="name-list col-sm-offset-3"></ul>
                                                    </div>
                                                    <input type="hidden" name="consignee" value="<?php echo $JOB->consignee; ?>" id="name-id"  />
                                                    <div class="col-sm-1 col-md-1">
                                                        <i class="fa fa-save btn btn-info btn-sm" id="add-consignee"></i>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3">Consignment</label>
                                                    <input type="text" class="form-control col-sm-8 col-md-8" id="consignment" name="consignmentname" placeholder="Enter consignment" autocomplete="off" value="<?php echo $CONSIGNMENT->name; ?>">
                                                    <div id="suggesstion-box">
                                                        <ul id="consignment-list-append" class="consignment-list col-md-offset-3"></ul>
                                                    </div>
                                                    <input type="hidden" name="consignment" value="<?php echo $JOB->consignment; ?>" id="consignment-id"  />
                                                    <div class="col-sm-1 col-md-1">
                                                        <i class="fa fa-save btn btn-info btn-sm" id="add-consignment"></i>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3">Description</label>
                                                    <textarea class="form-control col-md-9" placeholder="Enter description" name="description" id="description"><?php echo $JOB->description; ?></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3">Chassis Number</label>
                                                    <input type="text" class="form-control col-md-9" placeholder="Enter Chassis number" name="chassisNumber" id="chassisNumber" value="<?php echo $JOB->chassisNumber; ?>" autocomplete="off">
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3">Vessel or Flight</label>
                                                    <input type="text" class="form-control col-sm-8 col-md-8" id="vesselAndFlight" name="vesselandflightname" autocomplete="off" placeholder="Enter vessel or flight" value="<?php echo $VESSELANDFLIGHT->name; ?>">
                                                    <div id="suggesstion-box">
                                                        <ul id="vesselAndFlight-list-append" class="vesselAndFlight-list col-sm-offset-3"></ul>
                                                    </div>
                                                    <input type="hidden" name="vesselAndFlight" value="<?php echo $JOB->vesselAndFlight; ?>" id="vesselAndFlight-id"  />
                                                    <div class="col-sm-1 col-md-1">
                                                        <i class="fa fa-save btn btn-info btn-sm" id="add-vesselAndFlight"></i>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3">Vessel and Flight Date</label>
                                                    <input type="text" id="datepicker1" class="form-control col-md-9" placeholder="Enter date" name="vesselAndFlightDate" autocomplete="off" value="<?php echo $JOB->vesselAndFlightDate; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3">Copy Received Date</label>
                                                    <input type="text" id="datepicker2" class="form-control col-md-9" placeholder="Enter date" name="copyReceivedDate" autocomplete="off" value="<?php echo $JOB->copyReceivedDate; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3">Original Received Date</label>
                                                    <input type="text" id="datepicker3" class="form-control col-md-9" placeholder="Enter date" name="originalReceivedDate" autocomplete="off" value="<?php echo $JOB->originalReceivedDate; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3">Debit Note Number</label>
                                                    <input type="text" class="form-control col-md-9" placeholder="Enter debit note number" name="debitNoteNumber" value="<?php echo $JOB->debitNoteNumber; ?>" autocomplete="off">
                                                </div>
<!--                                                <div class="form-group">
                                                    <label class="col-md-3">Cusdec Date</label>
                                                    <input type="text" id="datepicker4" class="form-control col-md-9" placeholder="Enter cusdec date" name="cusdecDate" autocomplete="off" value="<?php echo $JOB->cusdecDate; ?>">
                                                </div>-->

                                                <input type="hidden" name="id" value="<?php echo $JOB->id; ?>">
                                                 <div class="col-sm-9 col-md-offset-3 form-btn">
                                                <button type="submit" name="edit-job" id="edit-job" class="btn btn-info">Save Changes</button>
                                                 </div>
                                            </form>
                                            <?php include 'modal.php'; ?>
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
        <script src="js/add-consignee.js" type="text/javascript"></script>

        <script src="js/job-consignee.js" type="text/javascript"></script>
        <script src="js/add-consignment.js" type="text/javascript"></script>
        <script src="js/job.js" type="text/javascript"></script>
        <script src="js/edit-job.js" type="text/javascript"></script>
        <script src="plugins/sweetalert/sweetalert.min.js" type="text/javascript"></script>
        <script src="plugins/loader/js/jquery.loading.block.js" type="text/javascript"></script>
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
