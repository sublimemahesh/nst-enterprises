<?php


/**
 * Description of Account
 *
 * @author U s E r ¨
 */
class Account {
    public $id;
    public $start_date;
    public $end_date;
    public $isCleared;
    public $current_invoice_id;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT `id`,`start_date`,`end_date`,`isCleared`,`current_invoice_id` FROM `account` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->start_date = $result['start_date'];
            $this->end_date = $result['end_date'];
            $this->isCleared = $result['isCleared'];
            $this->current_invoice_id = $result['current_invoice_id'];

            return $this;
        }
    }

    public function create() {

        $query = "INSERT INTO `account` ("
                . "`start_date`,"
                . "`end_date`,"
                . "`isCleared`,"
                . "`current_invoice_id`) "
                . "VALUES  ("
                . "'" . $this->start_date . "',"
                . "'" . $this->end_date . "',"
                . "'" . $this->isCleared . "',"
                . "'" . $this->current_invoice_id . "'"
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

        $query = "SELECT * FROM `account` ORDER BY `current_invoice_id` ASC ";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function update() {

        $query = "UPDATE  `account` SET "
                . "`start_date` ='" . $this->start_date . "', "
                . "`end_date` ='" . $this->end_date . "', "
                . "`isCleared` ='" . $this->isCleared . "', "
                . "`current_invoice_id` ='" . $this->current_invoice_id . "' "
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

        $query = 'DELETE FROM `account` WHERE id="' . $this->id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }

    public function getInvoiceId($today) {

        $query = "SELECT * FROM `account` WHERE `isCleared` = 0 AND '".$today."' between `start_date` AND `end_date` LIMIT 1";
        $db = new Database();
        $result = mysql_fetch_array($db->readQuery($query));

        return $result;
    }
    
    public function updateCurrentInvoiceId($today, $current_invoice_id) {

        $query = "UPDATE  `account` SET "
                . "`current_invoice_id` ='" . $current_invoice_id . "' "
                . "WHERE `isCleared` = 0 AND '".$today."' between `start_date` AND `end_date`";

        $db = new Database();

        $result = $db->readQuery($query);

        
            return $result;
        
    }

}
