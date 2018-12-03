<?php
include_once(dirname(__FILE__) . '/class/include.php');
include_once(dirname(__FILE__) . '/auth.php');
include_once(dirname(__FILE__) . '/permission.php');

$USER1 = new User($_SESSION['id']);

$id = '';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
$USER = new User($id);
?>

<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Edit User || Dashboard || NST Enterprises</title>

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
                            <h1 class="page-header font-header">Users</h1>
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
                                                    <label class="col-md-3">Name</label>
                                                    <input type="text" class="form-control col-md-9" placeholder="Enter Name" name="name" id="name" value="<?php echo $USER->name; ?>" autocomplete="off">
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3">Username</label>
                                                    <input type="text" class="form-control col-md-9" placeholder="Enter Username" name="username" id="username" value="<?php echo $USER->username; ?>" autocomplete="off">
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3">Email</label>
                                                    <input type="text" class="form-control col-md-9" placeholder="Enter Email" name="email" id="email" value="<?php echo $USER->email; ?>" autocomplete="off">
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3">Profile Picture</label>
                                                    <input type="file" name="profilePicture">
                                                </div>
                                                <div class="col-md-offset-3">
                                                    <img src="upload/user/<?php echo $USER->profilePicture; ?>" class="img-thumbnail image-align" alt=""/>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3">Status</label>
                                                    <label for="isActive" class="container1 col-md-3 label-align">Active / InActive
                                                        <input class="" type="checkbox" <?php
                                                        if ($USER->isActive == 1) {
                                                            echo 'checked';
                                                        }
                                                        ?> name="isActive" value="1" id="isActive" />
                                                        <span class="checkmark"></span>
                                                        <span class="col-md-9"></span>
                                                    </label>
                                                </div>
                                                <input type="hidden" name="id" value="<?php echo $USER->id; ?>">
                                                <input type="hidden" name="oldImageName" value="<?php echo $USER->profilePicture; ?>">
                                                <div class="col-sm-12 col-md-offset-3 form-btn">
                                                    <button type="submit" name="edit-user" id="edit-user" class="btn btn-info edit-btn">Save Changes</button>
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
