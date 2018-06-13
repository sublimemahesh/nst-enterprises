<?php
include_once(dirname(__FILE__) . '/../class/include.php');

if (isset($_POST['PasswordReset'])) {
    $USER = new User(NULL);
    $code = $_POST["code"];
    $password = $_POST["password"];
    $confpassword = $_POST["confirmpassword"];

    if ($password === $confpassword && $password != NULL && $confpassword != NULL) {
        if ($USER->SelectResetCode($code)) {
            $USER->updatePassword($password, $code);
            header('Location: ../login.php?message=15');
        } else {
            header('Location: ../reset-password.php?message=16');
        }
    } else {
        header('Location: ../reset-password.php?message=17');
    }


//    $OldPassOk = Member::ChecknewReset($_POST["code"], $_POST["password"]);
//
//    header('Location: ../reset-password.php?message=3');
}