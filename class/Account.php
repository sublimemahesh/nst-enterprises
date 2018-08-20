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
    public $cleared_date;
    public $current_invoice_id;
    public $current_job_id;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT `id`,`start_date`,`end_date`,`isCleared`,`cleared_date`,`current_invoice_id`,`current_job_id` FROM `account` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->start_date = $result['start_date'];
            $this->end_date = $result['end_date'];
            $this->isCleared = $result['isCleared'];
            $this->cleared_date = $result['cleared_date'];
            $this->current_invoice_id = $result['current_invoice_id'];
            $this->current_job_id = $result['current_job_id'];

            return $this;
        }
    }

    public function create() {

        $query = "INSERT INTO `account` ("
                . "`start_date`,"
                . "`end_date`,"
                . "`isCleared`,"
                . "`cleared_date`,"
                . "`current_invoice_id`,"
                . "`current_job_id`) "
                . "VALUES  ("
                . "'" . $this->start_date . "',"
                . "'" . $this->end_date . "',"
                . "'" . $this->isCleared . "',"
                . "'" . $this->cleared_date . "',"
                . "'" . $this->current_invoice_id . "',"
                . "'" . $this->current_job_id . "'"
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
                . "`end_date` ='" . $this->end_date . "' "
                . "WHERE `id` = '" . $this->id . "'";

        $db = new Database();

        $result = $db->readQuery($query);

        if ($result) {
            return $this->__construct($this->id);
        } else {
            return FALSE;
        }
    }

    public function clearAccount() {

        date_default_timezone_set('Asia/Colombo');
        $clearedAt = date('Y-m-d H:i:s');

        $query = "UPDATE  `account` SET "
                . "`isCleared` ='" . $this->isCleared . "', "
                . "`cleared_date` ='" . $clearedAt . "' "
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

        $query = "SELECT * FROM `account` WHERE `isCleared` = 0 AND '" . $today . "' between `start_date` AND `end_date` LIMIT 1";
        $db = new Database();
        $result = mysql_fetch_array($db->readQuery($query));

        return $result;
    }

    public function getCurrentAccount($today) {

        $query = "SELECT * FROM `account` WHERE `isCleared` = 0 AND '" . $today . "' between `start_date` AND `end_date` LIMIT 1";
        $db = new Database();
        $result = mysql_fetch_array($db->readQuery($query));

        return $result;
    }

    public function updateCurrentInvoiceId($today, $current_invoice_id) {

        $query = "UPDATE  `account` SET "
                . "`current_invoice_id` ='" . $current_invoice_id . "' "
                . "WHERE `isCleared` = 0 AND '" . $today . "' between `start_date` AND `end_date`";

        $db = new Database();

        $result = $db->readQuery($query);


        return $result;
    }

    public function updateCurrentJobId($today, $current_job_id) {

        $query = "UPDATE  `account` SET "
                . "`current_job_id` ='" . $current_job_id . "' "
                . "WHERE `isCleared` = 0 AND '" . $today . "' between `start_date` AND `end_date`";

        $db = new Database();

        $result = $db->readQuery($query);


        return $result;
    }

    public function getLastUnClearedAccount() {

        $query = "SELECT * FROM `account` WHERE `isCleared` = 0 ORDER BY `id` DESC LIMIT 1";
        $db = new Database();
        $result = mysql_fetch_array($db->readQuery($query));

        return $result;
    }

}
