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

        <title>Create User || Dashboard || NST Enterprises</title>

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
                            <h1 class="page-header font-header">Create User</h1>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-info">
<!--                                <div class="panel-heading">
                                    Create User
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
                                                    <label class="col-md-3">Name</label>
                                                    <input type="text" class="form-control col-md-9" placeholder="Enter Name" name="name" id="name" autocomplete="off">
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3">User Name</label>
                                                    <input type="text" class="form-control col-md-9" placeholder="Enter User Name" name="username" id="username" autocomplete="off">
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3">Password</label>
                                                    <input type="password" class="form-control col-md-9" placeholder="Enter Password" name="password" id="password" autocomplete="off">
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3">Confirm Password</label>
                                                    <input type="password" class="form-control col-md-9" placeholder="Confirm Password" name="cpassword" id="cpassword" autocomplete="off">
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3">Email</label>
                                                    <input type="text" class="form-control col-md-9" placeholder="Enter Email" name="email" id="email" autocomplete="off">
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3">Profile Picture</label>
                                                    <input type="file" name="profilePicture">
                                                </div>

                                                <input type="hidden" name="back" value="<?php echo $previous; ?>">
                                                <div class="col-sm-9 col-md-offset-3 form-btn">
                                                    <button type="submit" name="create-user" id="btn-user" class="btn btn-info submit-btn">Save User</button>
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
        <script src="js/user.js" type="text/javascript"></script>
        <script src="plugins/sweetalert/sweetalert.min.js" type="text/javascript"></script>
        <script src="plugins/loader/js/jquery.loading.block.js" type="text/javascript"></script>

    </body>

</html>
