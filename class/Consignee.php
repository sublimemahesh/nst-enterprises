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
    public $queue;
    
    public function __construct($id) {
        if ($id) {

            $query = "SELECT `id`,`name`,`address`,`vatNumber`,`contactNumber`,`email`,`description`,`isActive`,`queue` FROM `consignee` WHERE `id`=" . $id;

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
                . "`queue`) "
                . "VALUES  ("
                . "'" . $this->name . "',"
                . "'" . $this->address . "',"
                . "'" . $this->vatNumber . "',"
                . "'" . $this->contactNumber . "',"
                . "'" . $this->email . "',"
                . "'" . $this->description . "',"
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
    
}
