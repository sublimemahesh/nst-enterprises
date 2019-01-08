<?php

/**
 * Description of Consignee
 *
 * @author U s E r ¨
 */
class Consignee {

    public $id;
    public $name;
    public $address;
    public $vatNumber;
    public $contactNumber;
    public $email;
    public $description;
    public $isActive;
    public $parent;
    public $balance;
    public $queue;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT `id`,`name`,`address`,`vatNumber`,`contactNumber`,`email`,`description`,`isActive`,`parent`,`balance`,`queue` FROM `consignee` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->name = $result['name'];
            $this->address = $result['address'];
            $this->vatNumber = $result['vatNumber'];
            $this->contactNumber = $result['contactNumber'];
            $this->email = $result['email'];
            $this->description = $result['description'];
            $this->isActive = $result['isActive'];
            $this->parent = $result['parent'];
            $this->balance = $result['balance'];
            $this->queue = $result['queue'];

            return $this;
        }
    }

    public function create() {

        $query = "INSERT INTO `consignee` ("
                . "`name`,"
                . "`address`,"
                . "`vatNumber`,"
                . "`contactNumber`,"
                . "`email`,"
                . "`description`,"
                . "`isActive`,"
                . "`parent`,"
                . "`balance`,"
                . "`queue`) "
                . "VALUES  ("
                . "'" . $this->name . "',"
                . "'" . $this->address . "',"
                . "'" . $this->vatNumber . "',"
                . "'" . $this->contactNumber . "',"
                . "'" . $this->email . "',"
                . "'" . $this->description . "',"
                . "'" . $this->isActive . "',"
                . "'" . $this->parent . "',"
                . "'" . $this->balance . "',"
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

        $query = "SELECT * FROM `consignee` ORDER BY `queue` ASC ";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function update() {

        $query = "UPDATE  `consignee` SET "
                . "`name` ='" . $this->name . "', "
                . "`address` ='" . $this->address . "', "
                . "`vatNumber` ='" . $this->vatNumber . "', "
                . "`contactNumber` ='" . $this->contactNumber . "', "
                . "`email` ='" . $this->email . "', "
                . "`description` ='" . $this->description . "', "
                . "`isActive` ='" . $this->isActive . "', "
                . "`parent` ='" . $this->parent . "', "
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

        $query = 'DELETE FROM `consignee` WHERE id="' . $this->id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }

    public function arrange($key, $img) {
        $query = "UPDATE `consignee` SET `queue` = '" . $key . "'  WHERE id = '" . $img . "'";
        $db = new Database();
        $result = $db->readQuery($query);
        return $result;
    }

    public function getActiveConsignees() {

        $query = "SELECT * FROM `consignee` WHERE `isActive` = 1 ORDER BY `queue` ASC ";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function consigneeActivation() {

        $query = "UPDATE  `consignee` SET "
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

    public function allNamesByKeyword($keyword) {

        $query = "SELECT * FROM `consignee` WHERE name like '" . $keyword . "%' ORDER BY name LIMIT 0,6";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function getIdByName($name) {

        $query = "SELECT id FROM `consignee` WHERE name like '" . $name . "'";
        $db = new Database();
        $result = mysql_fetch_array($db->readQuery($query));
        return $result;
    }

    public function findNameById($id) {

        $query = "SELECT `id`,`name` FROM `consignee` WHERE `id` = '" . $id . "'";
        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));


        return $result;
    }

    public function updateBalance() {

        $query = "UPDATE  `consignee` SET "
                . "`balance` ='" . $this->balance . "' "
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
