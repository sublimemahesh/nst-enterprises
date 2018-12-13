<?php
include_once(dirname(__FILE__) . '/class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

$USER1 = new User($_SESSION['id']);

$id = '';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Change User Password || Dashboard || NST Enterprises</title>

        <!-- Bootstrap Core CSS -->
        <link href="plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <!-- MetisMenu CSS -->
        <link href="plugins/metisMenu/metisMenu.min.css" rel="stylesheet" type="text/css"/>
        <!-- Custom CSS -->
        <link href="css/sb-admin-2.css" rel="stylesheet" type="text/css"/>
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
        <!-- Custom Fonts -->
        <link href="plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <!-- Arrange -->
        <link href="plugins/nestable/jquery-nestable.css" rel="stylesheet" type="text/css"/>
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
                            <h1 class="page-header font-header">Change User Password</h1>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-info">
<!--                                <div class="panel-heading">
                                    Change User Password
                                </div>
                                <ul class="header-dropdown">
                                    <li class="">
                                        <a href="manage-users.php">
                                            <i class="glyphicon glyphicon-list"></i> 
                                        </a>
                                    </li>
                                </ul>-->
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <form   method="post" action="post-and-get/user.php" enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <label class="col-md-3">New Password</label>
                                                    <input type="text" class="form-control col-md-9" placeholder="Enter new password" name="password" id="password">
                                                </div>
                                                <input type="hidden" name="userid" id="userid" value="<?php echo $id; ?>">
                                                <div class="col-sm-9 col-md-offset-3 form-btn">
                                                    <button type="submit" name="create-new-password" id="create-new-password" class="btn btn-info">Change Password</button>
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
        <script src="js/sortable-nestable.js" type="text/javascript"></script>
        <!-- Arrange -->
        <script src="plugins/nestable/jquery.nestable.js" type="text/javascript"></script>

    </body>

</html>
