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

        <title>Edit New Consignment || Control Panel || NST ENterprises</title>

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
                            <h1 class="page-header font-header">Consignments</h1>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    Edit Consignment
                                </div>
                                <ul class="header-dropdown">
                                    <li class="">
                                        <a href="manage-consignments.php">
                                            <i class="glyphicon glyphicon-list"></i> 
                                        </a>
                                    </li>
                                </ul>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <form   method="post" action="post-and-get/consignment.php" enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <label class="col-md-3">Name</label>
                                                    <input type="text" class="form-control col-md-9" placeholder="Enter Name" name="name" id="name" value="<?php echo $CONSIGNMENT->name; ?>" autocomplete="off">
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3">Description</label>
                                                    <textarea class="form-control col-md-9" rows="5" placeholder="Enter your description" name="description"><?php echo $CONSIGNMENT->description; ?></textarea>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-md-3">Status</label>
                                                    <label for="isActive" class="container1 col-md-9 label-align">Active / InActive
                                                        <input class="" type="checkbox" <?php
                                                        if ($CONSIGNMENT->isActive == 1) {
                                                            echo 'checked';
                                                        }
                                                        ?> name="isActive" value="1" id="isActive" />
                                                        <span class="checkmark"></span>
                                                    </label>
                                                </div>
                                                <input type="hidden" name="id" value="<?php echo $CONSIGNMENT->id; ?>">
                                                
                                                <div class="col-sm-12 col-md-offset-3 form-btn">
                                                    <button type="submit" name="edit-consignment" id="edit-consignment" class="btn btn-info">Save Changes</button>
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
        <script src="js/consignment.js" type="text/javascript"></script>
        <script src="plugins/sweetalert/sweetalert.min.js" type="text/javascript"></script>

    </body>

</html>
