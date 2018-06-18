<?php
include_once(dirname(__FILE__) . '/class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

$USER1 = new User($_SESSION['id']);

$id = '';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
$JOB = new Job($id);
?>

<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Edit Job || Control Panel || NST ENterprises</title>

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
                                    Edit Job
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
                                        <div class="col-lg-12">
                                            <form   method="post" action="post-and-get/job.php">
                                                <div class="form-group">
                                                    <label class="col-md-3">Description</label>
                                                    <textarea class="form-control col-md-9" placeholder="Enter description" name="description"><?php echo $JOB->description; ?></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3">Chassis Number</label>
                                                    <input type="text" class="form-control col-md-9" placeholder="Enter Chassis number" name="chassisNumber" value="<?php echo $JOB->chassisNumber; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3">Vessel or Flight</label>
                                                    <select class="form-control col-md-9" name="vesselAndFlight">
                                                        <option>-- Please Select --</option>
                                                        <?php
                                                        foreach (VesselAndFlight::all() as $vesselandflight) {
                                                            ?>
                                                            <option value="<?php echo $vesselandflight['id']; ?>" <?php
                                                            if ($vesselandflight['id'] == $JOB->vesselAndFlight) {
                                                                echo 'selected';
                                                            }
                                                            ?>>
                                                                        <?php echo $vesselandflight['name']; ?>
                                                            </option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3">Vessel and Flight Date</label>
                                                    <input type="date" class="form-control col-md-9" placeholder="Enter date" name="vesselAndFlightDate" value="<?php echo $JOB->vesselAndFlightDate; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3">Copy Received Date</label>
                                                    <input type="date" class="form-control col-md-9" placeholder="Enter date" name="copyReceivedDate" value="<?php echo $JOB->copyReceivedDate; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3">Original Received Date</label>
                                                    <input type="date" class="form-control col-md-9" placeholder="Enter date" name="originalReceivedDate" value="<?php echo $JOB->originalReceivedDate; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3">Debit Note Number</label>
                                                    <input type="text" class="form-control col-md-9" placeholder="Enter debit note number" name="debitNoteNumber" value="<?php echo $JOB->debitNoteNumber; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3">Cusdec Date</label>
                                                    <input type="date" class="form-control col-md-9" placeholder="Enter cusdec date" name="cusdecDate" value="<?php echo $JOB->cusdecDate; ?>">
                                                </div>

                                                <input type="hidden" name="id" value="<?php echo $JOB->id; ?>">
                                                 <div class="col-md-2 col-md-offset-5">
                                                <button type="submit" name="edit-job" class="btn btn-primary">Save Job</button>
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

    </body>

</html>
