<?php
include_once(dirname(__FILE__) . '/class/include.php');
include_once(dirname(__FILE__) . '/auth.php');
include_once(dirname(__FILE__) . '/permission.php');

$USER1 = new User($_SESSION['id']);

$id = '';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
$VESSELANDFLIGHT = new VesselAndFlight($id);

$vessel = $VESSELANDFLIGHT->isVessel;
$flight = $VESSELANDFLIGHT->isFlight;
?>

<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Edit Vessel or Flight || Control Panel || NST ENterprises</title>

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
                            <h1 class="page-header font-header">Vessels And Flights</h1>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    Edit Vessel or Flight
                                </div>
                                <ul class="header-dropdown">
                                    <li class="">
                                        <a href="manage-vessels-and-flights.php">
                                            <i class="glyphicon glyphicon-list"></i> 
                                        </a>
                                    </li>
                                </ul>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <form   method="post" action="post-and-get/vessel-and-flight.php" enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <label class="col-md-3">Name</label>
                                                    <input type="text" class="form-control col-md-9" placeholder="Enter Name" name="name" value="<?php echo $VESSELANDFLIGHT->name; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3">Type</label>
                                                    <select class="form-control col-md-9" name="type">
                                                        <option>-- Please Select --</option>
                                                        <option value="vessel" <?php
                                                        if ($vessel == 1) {
                                                            echo 'selected';
                                                        }
                                                        ?>>Vessel</option>
                                                        <option value="flight" <?php
                                                        if ($flight == 1) {
                                                            echo 'selected';
                                                        }
                                                        ?>>Flight</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                <label class="col-md-3">Status</label>
                                                <label for="isActive" class="container1 col-md-9 label-align">Active / InActive
                                                    <input class="" type="checkbox" <?php
                                                    if ($VESSELANDFLIGHT->isActive == 1) {
                                                        echo 'checked';
                                                    }
                                                    ?> name="isActive" value="1" id="isActive" />
                                                    <span class="checkmark"></span>
                                                </label>
                                                </div>
                                                
                                                <input type="hidden" name="id" value="<?php echo $VESSELANDFLIGHT->id; ?>">
                                                <div class="col-md-2 col-md-offset-5">
                                                <button type="submit" name="edit-vessel-or-flight" class="btn btn-primary">Save</button>
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
