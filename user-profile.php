<?php
include_once(dirname(__FILE__) . '/class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

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

        <title>User Profile || Dashboard || NST Enterprises</title>

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
                            <h1 class="page-header font-header">User Profile</h1>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <i class="fa fa-user">
                                        User Profile
                                    </i>
                                </div>
                                <ul class="header-dropdown">
                                    <li class="">
                                        <a href="manage-users.php">
                                            <i class="glyphicon glyphicon-list"></i> 
                                        </a>
                                    </li>
                                </ul>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="col-lg-9">
                                                <div class="col-sm-3 col-md-4 visitor-prof-margin">
                                                    <img class="img-thumbnail pro-picture" src="upload/user/<?php echo $USER1->profilePicture; ?>" title="<?php echo $USER1->name; ?>" alt=""/>
                                                  </div>
                                                <div class="col-sm-9 col-md-8">
                                                    <ul class="list-group visitor-list-color list-margin">
                                                        <li class="list-group-item">
                                                            <b>Name: <?php echo $USER1->name; ?></b>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <b>Email: <?php echo $USER1->email; ?></b>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <b>Status: </b>
                                                            <?php
                                                            if ($USER1->isActive == 1) {
                                                                ?>
                                                                <a class="btn btn-info status" href="#" title="active">
                                                                    <i class="glyphicon glyphicon-check"></i>
                                                                </a>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <a class="btn btn-info status" href="#" title="active">
                                                                    <i class="glyphicon glyphicon-unchecked"></i>
                                                                </a>
                                                                <?php
                                                            }
                                                            ?>

                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <ul class="list-group visitor-list-color list-style list-hover">
                                                    <li class="list-group-item"><a href="user-profile.php">
                                                            <i class="fa fa-tachometer"></i>
                                                            My Profile
                                                        </a>
                                                    </li>
                                                    <li class="list-group-item"><a href="edit-user.php?id=<?php echo $USER1->id;?>">
                                                            <i class="fa fa-user"></i>
                                                            Edit Profile
                                                        </a>
                                                    </li>
                                                    <li class="list-group-item"><a href="change-password.php">
                                                            <i class="fa fa-lock"></i>
                                                            Change Password
                                                        </a>
                                                    </li>
                                                    <li class="list-group-item"><a href="post-and-get/logout.php">
                                                            <i class="fa fa-sign-out"></i>
                                                            Logout
                                                        </a>
                                                    </li>
                                                </ul>

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
        <!-- Bootstrap Core JavaScript -->
        <script src="plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- Metis Menu Plugin JavaScript -->
        <script src="plugins/metisMenu/metisMenu.min.js" type="text/javascript"></script>
        <!-- Custom Theme JavaScript -->
        <script src="js/sb-admin-2.js" type="text/javascript"></script>

    </body>

</html>








