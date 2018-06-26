<?php

/**
 * Description of User
 *
 * @author U s E r ¨
 */
class User {

    public $id;
    public $name;
    public $username;
    public $password;
    public $cpassword;
    public $email;
    public $profilePicture;
    public $isActive;
    public $authToken;
    public $lastLogin;
    public $resetcode;
    public $permission;
    public $queue;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT `id`,`name`,`username`,`password`,`email`,`profile_picture`,`isActive`,`authToken`,`lastLogin`,`resetcode`,`permissions`,`queue` FROM `user` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->name = $result['name'];
            $this->username = $result['username'];
            $this->password = $result['password'];
            $this->email = $result['email'];
            $this->profilePicture = $result['profile_picture'];
            $this->isActive = $result['isActive'];
            $this->authToken = $result['authToken'];
            $this->lastLogin = $result['lastLogin'];
            $this->resetcode = $result['resetcode'];
            $this->permission = $result['permissions'];
            $this->queue = $result['queue'];

            return $this;
        }
    }

    public function create() {

        $query = "INSERT INTO `user` ("
                . "`name`,"
                . "`username`,"
                . "`password`,"
                . "`email`,"
                . "`profile_picture`,"
                . "`isActive`,"
                . "`queue`) "
                . "VALUES  ("
                . "'" . $this->name . "',"
                . "'" . $this->username . "',"
                . "'" . $this->password . "',"
                . "'" . $this->email . "',"
                . "'" . $this->profilePicture . "',"
                . "'" . $this->isActive . "',"
                . "'" . $this->queue . "'"
                . ")";

        $db = new Database();

        $result = $db->readQuery($query);

        if ($result) {
            $last_id = mysql_insert_id();

            return $this->__construct($last_id);
        } else {
            return FALSE;
        }
    }

    public function all() {

        $query = "SELECT * FROM `user` ORDER BY `queue` ASC ";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function update() {

        $query = "UPDATE  `user` SET "
                . "`name` ='" . $this->name . "', "
                . "`username` ='" . $this->username . "', "
                . "`password` ='" . $this->password . "', "
                . "`email` ='" . $this->email . "', "
                . "`profile_picture` ='" . $this->profilePicture . "', "
                . "`isActive` ='" . $this->isActive . "', "
                . "`queue` ='" . $this->queue . "' "
                . "WHERE `id` = '" . $this->id . "'";

        $db = new Database();

        $result = $db->readQuery($query);

        if ($result) {
            return $this->__construct($this->id);
        } else {
            return FALSE;
        }
    }

    public function delete() {

        $query = 'DELETE FROM `user` WHERE id="' . $this->id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }

    public function arrange($key, $img) {
        $query = "UPDATE `user` SET `queue` = '" . $key . "'  WHERE id = '" . $img . "'";
        $db = new Database();
        $result = $db->readQuery($query);
        return $result;
    }

    public function getActiveUsers() {

        $query = "SELECT * FROM `user` WHERE `isActive` = 1 ORDER BY `queue` ASC ";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function userActivation() {

        $query = "UPDATE  `user` SET "
                . "`isActive` ='" . $this->isActive . "', "
                . "WHERE `id` = '" . $this->id . "'";

        $db = new Database();

        $result = $db->readQuery($query);

        if ($result) {
            return $this->__construct($this->id);
        } else {
            return FALSE;
        }
    }

    public function login($username, $password) {

        $enPass = md5($password);
        $query = "SELECT * FROM `user` WHERE `username`= '" . $username . "' AND `password`= '" . $enPass . "'";

        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));


        if (!$result) {
            return FALSE;
        } else {
            $this->id = $result['id'];
            $this->setAuthToken($result['id']);
            $this->setLastLogin($this->id);

            $user = $this->__construct($this->id);

            $this->setUserSession($user);

            return $user;
        }
    }

    public function logOut() {

        if (!isset($_SESSION)) {
            session_start();
        }

        unset($_SESSION["id"]);
        unset($_SESSION["name"]);
        unset($_SESSION["username"]);
        unset($_SESSION["email"]);
        unset($_SESSION["profile_picture"]);
        unset($_SESSION["isActive"]);
        unset($_SESSION["authToken"]);
        unset($_SESSION["lastLogin"]);
        unset($_SESSION["queue"]);

        return TRUE;
    }

    private function setUserSession($user) {

        if (!isset($_SESSION)) {
            session_start();
        }

        $_SESSION["id"] = $user->id;
        $_SESSION["name"] = $user->name;
        $_SESSION["username"] = $user->username;
        $_SESSION["email"] = $user->email;
        $_SESSION["profile_picture"] = $user->profile_picture;
        $_SESSION["isActive"] = $user->isActive;
        $_SESSION["authToken"] = $user->authToken;
        $_SESSION["lastLogin"] = $user->lastLogin;
        $_SESSION["permission"] = $user->permission;
        $_SESSION["queue"] = $user->queue;
    }

    private function setAuthToken($id) {

        $authToken = md5(uniqid(rand(), true));

        $query = "UPDATE `user` SET `authToken` ='" . $authToken . "' WHERE `id`='" . $id . "'";

        $db = new Database();

        if ($db->readQuery($query)) {

            return $authToken;
        } else {
            return FALSE;
        }
    }

    private function setLastLogin($id) {

        date_default_timezone_set('Asia/Colombo');

        $now = date('Y-m-d H:i:s');

        $query = "UPDATE `user` SET `lastLogin` ='" . $now . "' WHERE `id`='" . $id . "'";

        $db = new Database();

        if ($db->readQuery($query)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function authenticate() {

        if (!isset($_SESSION)) {
            session_start();
        }

        $id = NULL;
        $authToken = NULL;

        if (isset($_SESSION["id"])) {
            $id = $_SESSION["id"];
        }

        if (isset($_SESSION["authToken"])) {
            $authToken = $_SESSION["authToken"];
        }

        $query = "SELECT `id` FROM `user` WHERE `id`= '" . $id . "' AND `authToken`= '" . $authToken . "'";

        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));

        if (!$result) {
            return FALSE;
        } else {

            return TRUE;
        }
    }

    public function allNamesByKeyword($keyword) {

        $query = "SELECT * FROM user WHERE name like '" . $keyword . "%' ORDER BY name LIMIT 0,6";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function getIdByName($name) {

        $query = "SELECT id FROM user WHERE name like '" . $name . "'";
        $db = new Database();
        $result = mysql_fetch_array($db->readQuery($query));
        return $result;
    }

    public function findUserById($id) {

        $query = "SELECT `id`,`name` FROM `user` WHERE `id` = '" . $id . "'";
        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));


        return $result;
    }

    public function checkEmail($email) {

        $query = "SELECT `email` FROM `user` WHERE `email`= '" . $email . "'";

        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));

        if (!$result) {
            return FALSE;
        } else {
            return $result;
        }
    }

    public function GenarateCode($email) {

        $rand = rand(10000, 99999);
        

        $query = "UPDATE  `user` SET "
                . "`resetcode` ='" . $rand . "' "
                . "WHERE `email` = '" . $email . "'";

        $db = new Database();

        $result = $db->readQuery($query);

        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function SelectForgetMember($email) {

        if ($email) {

            $query = "SELECT `username`,`resetcode` FROM `user` WHERE `email`= '" . $email . "'";
            
            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->username = $result['username'];
            $this->resetcode = $result['resetcode'];
            return $result;
        }
    }

    public function SelectResetCode($code) {

        $query = "SELECT `id` FROM `user` WHERE `resetcode`= '" . $code . "'";

        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));

        if (!$result) {
            return FALSE;
        } else {

            return TRUE;
        }
    }

    public function updatePassword($password, $code) {

        $enPass = md5($password);

        $query = "UPDATE  `user` SET "
                . "`password` ='" . $enPass . "' "
                . "WHERE `resetcode` = '" . $code . "'";

        $db = new Database();

        $result = $db->readQuery($query);

        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function updatePermission() {

        $query = "UPDATE  `user` SET "
                . "`permissions` ='" . $this->permission . "' "
                . "WHERE `id` = '" . $this->id . "'";

        $db = new Database();

        $result = $db->readQuery($query);

        if ($result) {
            return $this->__construct($this->id);
        } else {
            return FALSE;
        }
    }

}
