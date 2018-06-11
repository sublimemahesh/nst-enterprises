<?php

include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/../auth.php');


if (isset($_POST['create-user'])) {
    $USER = new User(NULL);
    $VALID = new Validator();

    $password = md5(filter_var($_POST['password'], FILTER_SANITIZE_STRING));
    $cpassword = md5(filter_var($_POST['cpassword'], FILTER_SANITIZE_STRING));

    if (empty($_POST['password']) && empty($_POST['cpassword'])) {
        if (!isset($_SESSION)) {
            session_start();
        }

        $message = "Password or Confirm Password is empty";
        $status = "danger";
        $VALID->addError($message, $status);
        $_SESSION['ERRORS'] = $VALID->errors();
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    } elseif ($password != $cpassword) {

        if (!isset($_SESSION)) {
            session_start();
        }

        $message = "Password and Confirm Password is not match";
        $status = "danger";
        $VALID->addError($message, $status);
        $_SESSION['ERRORS'] = $VALID->errors();
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {

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
            'password' => ['required' => TRUE],
            'email' => ['required' => TRUE]
        ]);

        if ($VALID->passed()) {
            $USER->create();

            if (!isset($_SESSION)) {
                session_start();
            }
            $VALID->addError("Your data was saved successfully", 'success');
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
    $USER->profilePicture = $imgName;

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

        header('Location: ../manage-users.php');
    } else {

        if (!isset($_SESSION)) {
            session_start();
        }

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

