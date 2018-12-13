<?php
include_once(dirname(__FILE__) . '/class/include.php');
include_once(dirname(__FILE__) . '/auth.php');
include_once(dirname(__FILE__) . '/permission.php');

$USER1 = new User($_SESSION['id']);

$id = '';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
$message = '';
if (isset($_GET['message'])) {
    $message = $_GET['message'];
}
$MESSAGE = new Message($message);
$JOB = new Job($id);
$CONSIGNEE = new Consignee($JOB->consignee);
$CONSIGNMENT = new Consignment($JOB->consignment);
$VESSELANDFLIGHT = new VesselAndFlight($JOB->vesselAndFlight);
$JOBCOSTINGCARD = JobCostingCard::getJobCostingCardIdByJob($id);
?>

<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>View Job || Dashboard || NST Enterprises</title>

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
                        if (isset($_GET['message'])) {
                            ?>
                            <div class="alert alert-<?php echo $MESSAGE->status; ?>">
                                <strong>Error : </strong> 
                                <?php echo ucfirst($MESSAGE->description); ?>!.
                            </div>
                            <?php
                        }
                        ?>
                        <?php
                        $vali = new Validator();
                        $vali->show_message();
                        ?>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header font-header">View Job - #<?php echo $JOB->reference_no; ?></h1>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    Job Details - #<?php echo $JOB->reference_no; ?>
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
                                        <div class="col-lg-8 col-md-offset-1">
                                            <table class="table table-striped">
                                                <tr>
                                                    <td class="view-details-topic">Consignee</td>
                                                    <td><a href="view-consignee.php?id=<?php echo $CONSIGNEE->id; ?>" target="new" title="View Consignee"><?php echo $CONSIGNEE->name; ?></a></td>
                                                </tr>
                                                <tr>
                                                    <td class="view-details-topic">Consignment</td>
                                                    <td><a href="view-consignment.php?id=<?php echo $CONSIGNMENT->id; ?>" target="new" title="View Consignment"><?php echo $CONSIGNMENT->name; ?></a></td>
                                                </tr>
                                                <tr>
                                                    <td class="view-details-topic">Description</td>
                                                    <td><?php
                                                        if ($JOB->description) {
                                                            echo $JOB->description;
                                                        } else {
                                                            echo '-';
                                                        };
                                                        ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="view-details-topic">Chassis Number</td>
                                                    <td><?php
                                                        if ($JOB->chassisNumber) {
                                                            echo $JOB->chassisNumber;
                                                        } else {
                                                            echo '-';
                                                        };
                                                        ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="view-details-topic">Vessel or Flight</td>
                                                    <td><a href="view-vessel-flight.php?id=<?php echo $VESSELANDFLIGHT->id; ?>" target="new" title="View Vessel or Flight" ><?php echo $VESSELANDFLIGHT->name; ?></a></td>
                                                </tr>
                                                <tr>
                                                    <td class="view-details-topic">Vessel and Flight Date</td>
                                                    <td><?php
                                                        if ($JOB->vesselAndFlightDate) {
                                                            echo $JOB->vesselAndFlightDate;
                                                        } else {
                                                            echo '-';
                                                        };
                                                        ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="view-details-topic">Copy Received Date</td>
                                                    <td><?php
                                                        if ($JOB->copyReceivedDate) {
                                                            echo $JOB->copyReceivedDate;
                                                        } else {
                                                            echo '-';
                                                        };
                                                        ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="view-details-topic">Original Received Date</td>
                                                    <td><?php
                                                        if ($JOB->originalReceivedDate) {
                                                            echo $JOB->originalReceivedDate;
                                                        } else {
                                                            echo '-';
                                                        };
                                                        ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="view-details-topic">Debit Note Number</td>
                                                    <td><?php
                                                        if ($JOB->debitNoteNumber) {
                                                            echo $JOB->debitNoteNumber;
                                                        } else {
                                                            echo '-';
                                                        };
                                                        ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="view-details-topic">Cusdec Date</td>
                                                    <td><?php
                                                        if ($JOB->cusdecDate) {
                                                            echo $JOB->cusdecDate;
                                                        } else {
                                                            echo '-';
                                                        };
                                                        ?></td>
                                                </tr>
                                            </table>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    Manage Job - #<?php echo $JOB->reference_no; ?>
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
                                        <div class="col-lg-12 manage-items">
                                            <div class="col-xs-4 text-center">
                                                <div class="manage-box">
                                                    <div class="manage-circle box-blue">
                                                        <i class="glyphicon glyphicon-duplicate"></i>
                                                    </div>
                                                    <?php
                                                    if ($JOBCOSTINGCARD['id']) {
                                                        ?>
                                                        <h3><a href="edit-job-costing-card.php?id=<?php echo $JOBCOSTINGCARD['id']; ?>" target="new">Job Costing Card</a></h3>

                                                        <?php
                                                    } else {
                                                        ?>
                                                        <h3><a href="create-job-costing-card.php?id=<?php echo $id; ?>" target="new">Job Costing Card</a></h3>

                                                        <?php
                                                    }
                                                    ?>

                                                </div>
                                            </div>
                                            <div class="col-xs-4 text-center <?php if($JOBCOSTINGCARD['id']) { echo ''; } else {echo 'hidden'; } ?>">
                                                <div class="manage-box">
                                                    <div class="manage-circle box-purple">
                                                        <i class="glyphicon glyphicon-print"></i>
                                                    </div>
                                                    <h3><a href="job-costing-card-report.php?id=<?php echo $JOBCOSTINGCARD['id']; ?>"  target="new">Print Job Costing Card</a></h3>
                                                </div>
                                            </div>
                                            <div class="col-xs-4 text-center <?php if($JOBCOSTINGCARD['id']) { echo ''; } else {echo 'hidden'; } ?>">
                                                <div class="manage-box">
                                                    <div class="manage-circle box-orange">
                                                        <i class="glyphicon glyphicon-list-alt"></i>
                                                    </div>
                                                    <h3><a href="create-invoice.php?id=<?php echo $JOBCOSTINGCARD['id']; ?>" target="new">Invoice</a></h3>
                                                </div>
                                            </div>
                                            <div class="col-xs-4 text-center <?php if($JOBCOSTINGCARD['id']) { echo ''; } else {echo 'hidden'; } ?>">
                                                <div class="manage-box">
                                                    <div class="manage-circle box-light-blue">
                                                        <i class="glyphicon glyphicon-print"></i>
                                                    </div>
                                                    <h3><a href="invoice.php?id=<?php echo $JOBCOSTINGCARD['id']; ?>&back=<?php echo $id; ?>" target="new">Print Invoice</a></h3>
                                                </div>
                                            </div>
                                            <div class="col-xs-4 text-center">
                                                <div class="manage-box">
                                                    <div class="manage-circle box-yellow">
                                                        <i class="glyphicon glyphicon-usd"></i>
                                                    </div>
                                                    <h3><a href="manage-job-payments.php?id=<?php echo $id; ?>" target="new">Payments</a></h3>
                                                </div>
                                            </div>
                                            <div class="col-xs-4 text-center">
                                                <div class="manage-box">
                                                    <div class="manage-circle box-green">
                                                        <i class="glyphicon glyphicon-edit"></i>
                                                    </div>
                                                    <h3><a href="edit-job.php?id=<?php echo $id; ?>" target="new">Edit Job</a></h3>
                                                </div>
                                            </div>
                                            <div class="col-xs-4 text-center">
                                                <div class="manage-box">
                                                    <div class="manage-circle box-red">
                                                        <i class="glyphicon glyphicon-trash"></i>
                                                    </div>
                                                    <h3><a href="#" class="delete-job" data-id="<?php echo $id; ?>">Delete Job</a></h3>
                                                </div>
                                            </div>
                                            
                                            
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
        <script src="plugins/sweetalert/sweetalert.min.js" type="text/javascript"></script>
        <script src="plugins/loader/js/jquery.loading.block.js" type="text/javascript"></script>
        <script src="delete/js/job.js" type="text/javascript"></script>

    </body>

</html>
