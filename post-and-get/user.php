<?php

include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/../auth.php');


if (isset($_POST['create-user'])) {
    $USER = new User(NULL);
    $VALID = new Validator();

    $password = md5(filter_var($_POST['password'], FILTER_SANITIZE_STRING));
    $cpassword = md5(filter_var($_POST['cpassword'], FILTER_SANITIZE_STRING));

    $USER->name = filter_input(INPUT_POST, 'name');
    $USER->username = filter_input(INPUT_POST, 'username');
    $USER->password = $password;
    $USER->email = filter_input(INPUT_POST, 'email');
    $USER->isActive = 1;

    $dir_dest = '../upload/user/';

    $handle = new Upload($_FILES['profilePicture']);

    $imgName = null;

    if ($handle->uploaded) {
        $handle->image_resize = true;
        $handle->file_new_name_ext = 'jpg';
        $handle->image_ratio_crop = 'C';
        $handle->file_new_name_body = Helper::randamId();
        $handle->image_x = 250;
        $handle->image_y = 250;

        $handle->Process($dir_dest);

        if ($handle->processed) {
            $info = getimagesize($handle->file_dst_pathname);
            $imgName = $handle->file_dst_name;
        }
    }

    $USER->profilePicture = $imgName;

    $VALID->check($USER, [
        'name' => ['required' => TRUE],
        'username' => ['required' => TRUE],
        'password' => ['required' => TRUE]
    ]);

    if ($VALID->passed()) {
        $result = $USER->create();

        if (!isset($_SESSION)) {
            session_start();
        }
        $VALID->addError("Your data was saved successfully", 'success');
        $_SESSION['ERRORS'] = $VALID->errors();
        header('Location: ../manage-user-permission.php?id=' . $result->id);
    } else {

        if (!isset($_SESSION)) {
            session_start();
        }

        $_SESSION['ERRORS'] = $VALID->errors();

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}

if (isset($_POST['edit-user'])) {

    $dir_dest = '../upload/user/';

    $handle = new Upload($_FILES['profilePicture']);
    $imageName = $_POST ["oldImageName"];

    if (empty($imageName)) {
        $imageName = Helper::randamId();
    }

    if ($handle->uploaded) {
        $handle->image_resize = true;
        $handle->file_new_name_body = TRUE;
        $handle->file_overwrite = TRUE;
        $handle->file_new_name_ext = FALSE;
        $handle->image_ratio_crop = 'C';
        $handle->file_new_name_body = $imageName;
        $handle->image_x = 250;
        $handle->image_y = 250;

        $handle->Process($dir_dest);

        if ($handle->processed) {
            $info = getimagesize($handle->file_dst_pathname);
            $imgName = $handle->file_dst_name;
        }
    }

    $USER = new User($_POST['id']);

    $USER->name = filter_input(INPUT_POST, 'name');
    $USER->email = filter_input(INPUT_POST, 'email');
    $USER->isActive = $_POST['isActive'];
    $USER->profilePicture = $imageName;

    $VALID = new Validator();
    $VALID->check($USER, [
        'name' => ['required' => TRUE],
        'email' => ['required' => TRUE]
    ]);

    if ($VALID->passed()) {
        $USER->update();

        if (!isset($_SESSION)) {
            session_start();
        }
        $VALID->addError("Your changes saved successfully", 'success');
        $_SESSION['ERRORS'] = $VALID->errors();

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {

        if (!isset($_SESSION)) {
            session_start();
        }

        $_SESSION['ERRORS'] = $VALID->errors();

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}

if (isset($_POST['change-password'])) {
    $USER = new User(NULL);

    $pass = $USER->getIdByPassword($_POST["password"]);

    $VALID = new Validator();

    if ($_SESSION['id'] == $pass['id']) {
        $npassword = $_POST["newpassword"];
        $cpassword = $_POST["confirmpassword"];

        if ($npassword === $cpassword && $npassword != NULL && $cpassword != NULL) {

            $USER->password = $npassword;
            $USER->id = $pass['id'];

            $result = $USER->changePassword();

            if ($result) {
                $VALID->addError("Your changes saved successfully", 'success');
                $_SESSION['ERRORS'] = $VALID->errors();

                header('Location: ' . $_SERVER['HTTP_REFERER'] . '?id=' . $pass['id']);
            } else {
                $VALID->addError("Your changes not saved successfully", 'danger');
                $_SESSION['ERRORS'] = $VALID->errors();

                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }
        } else {
            $VALID->addError("Your new password and confirm password was not matched", 'danger');
            $_SESSION['ERRORS'] = $VALID->errors();

            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    } else {
        $VALID->addError("Your current password was not matched", 'danger');
        $_SESSION['ERRORS'] = $VALID->errors();

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}

if (isset($_POST['create-new-password'])) {
    $USER = new User(NULL);
    $VALID = new Validator();
    
    $USER->password = $_POST["password"];
    $USER->id = $_POST["userid"];

    $result = $USER->changePassword();

    if ($result) {
        $VALID->addError("Your changes saved successfully", 'success');
        $_SESSION['ERRORS'] = $VALID->errors();

        header('Location: ' . $_SERVER['HTTP_REFERER'] . '?id=' . $_POST["userid"]);
    } else {
        $VALID->addError("Your changes not saved successfully", 'danger');
        $_SESSION['ERRORS'] = $VALID->errors();

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}

if (isset($_POST['save-arrange'])) {

    foreach ($_POST['sort'] as $key => $img) {
        $key = $key + 1;

        $USERS = User::arrange($key, $img);

        if ($USERS) {
            $VALID = new Validator();
            $VALID->addError("Your changes saved successfully", 'success');
            $_SESSION['ERRORS'] = $VALID->errors();
        }

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}

