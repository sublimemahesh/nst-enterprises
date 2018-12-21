<?php
include_once(dirname(__FILE__) . '/class/include.php');
include_once(dirname(__FILE__) . '/auth.php');
include_once(dirname(__FILE__) . '/permission.php');

$USER1 = new User($_SESSION['id']);

$id = '';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
$JOBCOSTINGCARD = new JobCostingCard($id);
$COSTINGTYPES = CostingType::all();
$REIMBURSEMENTDETAILS = ReimbursementDetails::getReimbursementDetailsByJobCostingCard($id);
$JOB = new Job($JOBCOSTINGCARD->job);
$message = '';
if (isset($_GET['message'])) {
    $message = $_GET['message'];
}
$MESSAGE = new Message($message);
?>

<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Create Job Costing Card || Dashboard || NST Enterprises</title>

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
        <link href="css/responsive-table.css" rel="stylesheet" type="text/css"/>
        <link href="plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css"/>

        <style>
            .table tbody tr td .form-control {
                margin-bottom: 0px;
                height: 26px;
                padding: 5px 12px;
            }
            .btn {
                padding: 9px 12px;
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

                        if (isset($_GET['message'])) {
                            ?>
                            <div class="alert alert-<?php echo $MESSAGE->status; ?>">
                                <strong><?php echo ucfirst($MESSAGE->status); ?> : </strong> 
                                <?php echo ucfirst($MESSAGE->description); ?>!.
                            </div>
                            <?php
                        }
                        ?>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header font-header">Manage Job Costing Card</h1>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-info">

                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label class="col-md-3">Job Number</label>
                                                <input type="text" id="job" class="form-control col-md-9" name="job" autocomplete="off" value="<?php echo $JOB->reference_no; ?>" disabled="">
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3">Invoice Number</label>
                                                <input type="text" class="form-control col-md-9" placeholder="Invoice Number" name="invoicenumber" id="invoiceNumber" value="<?php if($JOBCOSTINGCARD->invoiceNumber) {echo $JOBCOSTINGCARD->invoiceNumber; } else { echo 'NST/2018/19/'; } ?>" style="margin-bottom: 0px;">
                                            </div>
                                            <div class="col-md-3 col-md-offset-9 invoice-btn">
                                                <input type="submit" class="btn btn-info" name="save-invoice-number" id="saveInvoiceNumber" value="Save Invoice Number" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    Reimbursement Details
                                </div>
                                <ul class="header-dropdown">
                                    <li class="">
                                        <a href="manage-job-costing-cards.php">
                                            <i class="glyphicon glyphicon-list"></i> 
                                        </a>
                                    </li>
                                </ul>

                                <div class="panel-body">
                                    <!--Table-->
                                    <table class="table table-bordered">

                                        <!--Table head-->
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th class="text-center table-td-width">V/NO</th>
                                                <th class="text-center table-td-width">AMOUNT</th>
                                                <th class="text-center table-td-width">DESCRIPTION</th>
                                            </tr>
                                        </thead>
                                        <!--Table head-->

                                        <!--Table body-->
                                        <tbody>

                                            <?php
                                            foreach ($COSTINGTYPES as $type) {
                                                foreach (ReimbursementItem::getCostingItemsByType($type['id']) as $reimbursementitem) {
                                                    ?>
                                                    <tr>
                                                        <td scope="row" rid="<?php echo $reimbursementitem['id']; ?>" type="<?php echo $reimbursementitem['type']; ?>" class="rid"><?php echo $reimbursementitem['name']; ?></td>
                                                        <td data-column="V/NO"><input type="text" class="form-control form-control-border vno vno-<?php echo $reimbursementitem['id']; ?>" value="" autocomplete="off" /></td>
                                                        <td data-column="AMOUNT"><input type="text" class="form-control form-control-border text-right amount amount-<?php echo $reimbursementitem['id']; ?>" value="" autocomplete="off" /></td>
                                                        <td data-column="DESCRIPTION"><input type="text" class="form-control form-control-border description description-<?php echo $reimbursementitem['id']; ?>" value="" autocomplete="off" /></td>
                                                <input type="hidden" class="id id-<?php echo $reimbursementitem['id']; ?>"  value="">
                                                </tr>
                                                <?php
                                            }
                                        }
                                        ?>


                                        </tbody>
                                        <!--Table body-->

                                    </table>
                                    <!--Table-->
                                    <input type="hidden" id="job" value="<?php echo $job; ?>">
                                    <input type="hidden" class="jobcostingcard" value="<?php echo $id; ?>"/>
                                    <input type="hidden" id="date" class="form-control col-md-9" placeholder="Enter date" name="date" autocomplete="off" value="<?php echo $JOBCOSTINGCARD->date; ?>">
                                    <div class="col-sm-10 col-md-offset-2 form-btn">
                                        <button type="button" class="btn btn-info  savebtn" id="editbutton">Save Changes</button>
                                        <a href="job-costing-card-report.php?id=<?php echo $id; ?>" class="op-link btn btn-lg btn-warning" title="Report" target="blank"><i class="glyphicon glyphicon-print"></i></a>

                                        <a href="create-invoice.php?id=<?php echo $id; ?>" class="op-link btn btn-lg  btn-primary" title="Tax Invoice"><i class="glyphicon glyphicon-list-alt"></i></a>

                                        <a href="#" class="delete-job-costing-card btn btn-lg btn-danger" data-id="<?php echo $id; ?>" title="Delete">
                                            <i class="glyphicon glyphicon-trash" data-type="cancel"></i>
                                        </a>
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
        <script src="js/job-costing-card.js" type="text/javascript"></script>
        <script src="plugins/sweetalert/sweetalert.min.js" type="text/javascript"></script>

        <script src="js/reimbursement-details.js" type="text/javascript"></script>
        <!--<script src="js/create-reimbursement-details.js" type="text/javascript"></script>-->
        <script src="js/edit-reimbursement-details.js" type="text/javascript"></script>
        <script src="delete/js/job-costing-card.js" type="text/javascript"></script>
        <script src="plugins/loader/js/jquery.loading.block.js" type="text/javascript"></script>
        <script src="js/invoice-number.js" type="text/javascript"></script>
    </body>

</html>
