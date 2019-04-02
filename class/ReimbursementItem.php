<?php

/**
 * Description of ReimbursementItem
 *
 * @author U s E r ¨
 */
class ReimbursementItem {

    public $id;
    public $name;
    public $label;
    public $type;
    public $queue;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT `id`,`name`,`label`,`type`,`queue` FROM `reimbursement_item` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->name = $result['name'];
            $this->label = $result['label'];
            $this->type = $result['type'];
            $this->queue = $result['queue'];

            return $this;
        }
    }

    public function create() {

        $query = "INSERT INTO `reimbursement_item` ("
                . "`name`,"
                . "`label`,"
                . "`type`,"
                . "`queue`) "
                . "VALUES  ("
                . "'" . $this->name . "',"
                . "'" . $this->label . "',"
                . "'" . $this->type . "',"
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

        $query = "SELECT * FROM `reimbursement_item` ORDER BY `type` ASC, `queue` ASC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function update() {

        $query = "UPDATE  `reimbursement_item` SET "
                . "`name` ='" . $this->name . "', "
                . "`label` ='" . $this->label . "', "
                . "`type` ='" . $this->type . "', "
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

        $query = 'DELETE FROM `reimbursement_item` WHERE id="' . $this->id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }
    
    public function getDistinctType() {

        $query = "SELECT distinct(type) FROM `reimbursement_item`";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }
    
    public function getReimbursementItemsForInvoice() {

        $query = "SELECT * FROM `reimbursement_item` WHERE `type` in(1,2,3,5) ORDER BY `type` ASC ";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }
    
    public function getCostingItemsByType($type) {

        $query = "SELECT * FROM `reimbursement_item` WHERE `type`='" . $type . "' ORDER BY `queue` ASC ";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }
    
    public function arrange($key, $img) {
        $query = "UPDATE `reimbursement_item` SET `queue` = '" . $key . "'  WHERE id = '" . $img . "'";
        $db = new Database();
        $result = $db->readQuery($query);
        return $result;
    }

}
