<?php
include_once(dirname(__FILE__) . '/class/include.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Member Login || NST Enterprises</title>

        <!-- Bootstrap Core CSS -->
        <link href="plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <!-- MetisMenu CSS -->
        <link href="plugins/metisMenu/metisMenu.min.css" rel="stylesheet" type="text/css"/>
        <!-- Custom CSS -->
        <link href="css/sb-admin-2.css" rel="stylesheet" type="text/css"/>
        <!-- Custom Fonts -->
        <link href="plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/style.css" rel="stylesheet" type="text/css"/>

    </head>

    <body>

        <div class="container">
            <div class="login-page">
                <div class="login-topic">
                    <a href="javascript:void(0);"><b>Member Login</b></a>
                    <small>NST Enterprises</small>
                </div>
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <?php
                        if (isset($_GET['message'])) {

                            $MESSAGE = New Message($_GET['message']);
                            ?>
                            <div class="alert alert-<?php echo $MESSAGE->status; ?>" role = "alert">
                                <?php echo $MESSAGE->description; ?>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-md-offset-4">
                        <div class="login-panel panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Reset Password?</h3>
                            </div>
                            <div class="panel-body">
                                <form id="sign_in" method="POST" action="post-and-get/password-reset.php">
                                    <fieldset>
                                        <p><b>Please check your email</b></p>
                                        <div class="form-group">
                                            <input type="text" name="code" placeholder="Password Reset code" autocomplete="off" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" placeholder="New Password" name="password" type="password">
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" placeholder="Confirm Password" name="confirmpassword" type="password">
                                        </div>
                                        <button class="btn btn-theme btn-block" type="submit" name="PasswordReset">Password Reset</button>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
