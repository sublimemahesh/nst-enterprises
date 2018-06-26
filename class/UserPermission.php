<?php
/**
 * Description of UserPermission
 *
 * @author U s E r ¨
 */
class UserPermission {
    public $id;
    public $permission;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT `id`,`permission` FROM `user_permission` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->permission = $result['permission'];

            return $this;
        }
    }

    public function create() {

        $query = "INSERT INTO `user_permission` ("
                . "`permission`) "
                . "VALUES  ("
                . "'" . $this->permission . "'"
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

        $query = "SELECT * FROM `user_permission` ORDER BY `id` ASC ";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }
    
    public function allID() {

        $query = "SELECT `id` FROM `user_permission` ORDER BY `id` ASC ";
        $db = new Database();
        $result = $db->readQuery($query);
        
        $array_res = array();

        while ($row = mysql_fetch_assoc($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function update() {

        $query = "UPDATE  `user_permission` SET "
                . "`permission` ='" . $this->permission . "' "
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

        $query = 'DELETE FROM `user_permission` WHERE id="' . $this->id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }
    public function getIdByPermission($permission) {
            $query = "SELECT `id` FROM `user_permission` WHERE `permission`='" . $permission . "'";

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            return $result;
    }
    
}
