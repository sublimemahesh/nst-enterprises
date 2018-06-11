<?php
include_once(dirname(__FILE__) . '/class/include.php');
include_once(dirname(__FILE__) . '/auth.php');
?>

<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Edit User || Control Panel || NST ENterprises</title>

        <!-- Bootstrap Core CSS -->
        <link href="plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <!-- MetisMenu CSS -->
        <link href="plugins/metisMenu/metisMenu.min.css" rel="stylesheet" type="text/css"/>
        <!-- Custom CSS -->
        <link href="css/sb-admin-2.css" rel="stylesheet" type="text/css"/>
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
        <!-- Custom Fonts -->
        <link href="plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>

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
                            <h1 class="page-header">Users</h1>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    Edit User
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
                                            <form   method="post" action="post-and-get/user.php" enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <label>Name</label>
                                                    <input type="text" class="form-control" placeholder="Enter Name" name="name">
                                                </div>
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input type="text" class="form-control" placeholder="Enter Email" name="email">
                                                </div>
                                                <div class="form-group">
                                                    <label>Profile Picture</label>
                                                    <input type="file" name="profile_picture">
                                                </div>
                                                <div class="thumb-img"> 
                                                    <img src="" class="img-thumbnail" alt="">
                                                </div>
                                                <div class="form-group">
                                                    <label>Status</label>
                                                    <input class="filled-in chk-col-light-blue" type="checkbox" <?php
                                                    if ($VESSELANDFLIGHT->isActive == 1) {
                                                        echo 'checked';
                                                    }
                                                    ?> name="isActive" value="1" id="isActive" style="margin-top: 6px;"/>
                                                    <label for="isActive">Active / InActive</label>
                                                </div>
                                                <input type="hidden" name="id" value="<?php echo $VESSELANDFLIGHT->id; ?>">
                                                <button type="submit" name="edit-user" class="btn btn-primary">Save</button>
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