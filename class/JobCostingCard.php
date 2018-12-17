<?php

/**
 * Description of JobCostingCard
 *
 * @author U s E r ¨
 */
class JobCostingCard {

    public $id;
    public $job;
    public $date;
    public $invoiceNumber;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT `id`,`job`,`date`,`invoiceNumber` FROM `job_costing_card` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->job = $result['job'];
            $this->date = $result['date'];
            $this->invoiceNumber = $result['invoiceNumber'];

            return $this;
        }
    }

    public function create() {

        $query = "INSERT INTO `job_costing_card` ("
                . "`job`,"
                . "`date`,"
                . "`invoiceNumber`) "
                . "VALUES  ("
                . "'" . $this->job . "',"
                . "'" . $this->date . "',"
                . "'" . $this->invoiceNumber . "'"
                . ")";

        $db = new Database();

        $result = $db->readQuery($query);

        if ($result) {
            $last_id = mysql_insert_id();

            return $last_id;
        } else {
            return FALSE;
        }
    }

    public function all() {

        $query = "SELECT * FROM `job_costing_card`";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function update() {

        $query = "UPDATE  `job_costing_card` SET "
                . "`job` ='" . $this->job . "', "
                . "`date` ='" . $this->date . "', "
                . "`invoiceNumber` ='" . $this->invoiceNumber . "' "
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

        $query = 'DELETE FROM `job_costing_card` WHERE id="' . $this->id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }

    public function getJobCostingCardsByJob($job) {

        $query = "SELECT * FROM `job_costing_card` WHERE `job`=" . $job;
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }
    
    public function getJobCostingCardByDate($date) {

        $query = "SELECT * FROM `job_costing_card` WHERE `date`='" . $date ."'";
        
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }
    
    public function getJobCostingCardIdByJob($job) {

        $query = "SELECT * FROM `job_costing_card` WHERE `job`='". $job ."'";
        $db = new Database();
        $result = mysql_fetch_array($db->readQuery($query));

        return $result;
    }

    public function getMaxID() {

        $query = "SELECT MAX(id) AS `maxid` FROM `job_costing_card`";

        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));
        return $result;
    }
    
    public function countOfTodayCreatedJobCostingCard($today) {

        $query = "SELECT count(`id`) AS `count` FROM `job_costing_card` WHERE `date`='" . $today ."'";

        $db = new Database();
        $result = mysql_fetch_array($db->readQuery($query));
        return $result;
    }
    
    public function updateInvoiceNumber() {

        $query = "UPDATE  `job_costing_card` SET "
                . "`invoiceNumber` ='" . $this->invoiceNumber . "' "
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
