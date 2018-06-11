<?php
include_once(dirname(__FILE__) . '/class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

$USERS = User::all();
?>

<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Arrange Users || Control Panel || NST ENterprises</title>

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
                                    Arrange Users 
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
                                        <div class="col-lg-6">
                                            <form method="post" action="post-and-get/user.php" class="form-horizontal" >
                                                <div class="clearfix m-b-20">
                                                    <div class="dd nestable-with-handle">
                                                        <ol class="dd-list">
                                                            <?php
                                                            if (count($USERS) > 0) {
                                                                foreach ($USERS as $key => $img) {
                                                                    ?>
                                                                    <li class="dd-item dd3-item" data-id="13">
                                                                        <div class="dd-handle dd3-handle"></div>
                                                                        <div class="dd3-content">(<?php echo $key + 1; ?>) <?php echo $img['name']; ?></div>
                                                                        <input type="hidden" name="sort[]"  value="<?php echo $img["id"]; ?>" class="sort-input"/>

                                                                    </li>
                                                                    <?php
                                                                }
                                                            } else {
                                                                ?> 
                                                                <b>No users in the database.</b> 
                                                            <?php } ?> 
                                                        </ol>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-12 text-center" style="margin-top: 19px;">
                                                            <input type="submit" class="btn btn-info" id="btn-submit" value="Save Changes" name="save-arrange">
                                                        </div>
                                                    </div>
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
