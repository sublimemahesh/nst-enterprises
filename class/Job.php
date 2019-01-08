<?php

/**
 * Description of Job
 *
 * @author U s E r ¨
 */
class Job {

    public $id;
    public $consignee;
    public $consignment;
    public $description;
    public $chassisNumber;
    public $vesselAndFlight;
    public $vesselAndFlightDate;
    public $copyReceivedDate;
    public $originalReceivedDate;
    public $debitNoteNumber;
    public $cusdecNo;
    public $createdAt;
    public $reference_no;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT `id`,`consignee`,`consignment`,`description`,`chassisNumber`,`vesselAndFlight`,`vesselAndFlightDate`,`copyReceivedDate`,`originalReceivedDate`,`debitNoteNumber`,`cusdecNo`,`createdAt`,`reference_no` FROM `job` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->consignee = $result['consignee'];
            $this->consignment = $result['consignment'];
            $this->description = $result['description'];
            $this->chassisNumber = $result['chassisNumber'];
            $this->vesselAndFlight = $result['vesselAndFlight'];
            $this->vesselAndFlightDate = $result['vesselAndFlightDate'];
            $this->copyReceivedDate = $result['copyReceivedDate'];
            $this->originalReceivedDate = $result['originalReceivedDate'];
            $this->debitNoteNumber = $result['debitNoteNumber'];
            $this->cusdecNo = $result['cusdecNo'];
            $this->createdAt = $result['createdAt'];
            $this->reference_no = $result['reference_no'];

            return $this;
        }
    }

    public function create() {
        $jobnumber = Helper::jobNo();

        $query = "INSERT INTO `job` ("
                . "`consignee`,"
                . "`consignment`,"
                . "`description`,"
                . "`chassisNumber`,"
                . "`vesselAndFlight`,"
                . "`vesselAndFlightDate`,"
                . "`copyReceivedDate`,"
                . "`originalReceivedDate`,"
                . "`createdAt`,"
                . "`reference_no`) "
                . "VALUES  ("
                . "'" . $this->consignee . "',"
                . "'" . $this->consignment . "',"
                . "'" . $this->description . "',"
                . "'" . $this->chassisNumber . "',"
                . "'" . $this->vesselAndFlight . "',"
                . "'" . $this->vesselAndFlightDate . "',"
                . "'" . $this->copyReceivedDate . "',"
                . "'" . $this->originalReceivedDate . "',"
                . "'" . $this->createdAt . "',"
                . "'" . $jobnumber . "'"
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

        $query = "SELECT * FROM `job` ORDER BY `createdAt` DESC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function update() {

        $query = "UPDATE  `job` SET "
                . "`consignee` ='" . $this->consignee . "', "
                . "`consignment` ='" . $this->consignment . "', "
                . "`description` ='" . $this->description . "', "
                . "`chassisNumber` ='" . $this->chassisNumber . "', "
                . "`vesselAndFlight` ='" . $this->vesselAndFlight . "', "
                . "`vesselAndFlightDate` ='" . $this->vesselAndFlightDate . "', "
                . "`copyReceivedDate` ='" . $this->copyReceivedDate . "', "
                . "`originalReceivedDate` ='" . $this->originalReceivedDate . "', "
                . "`debitNoteNumber` ='" . $this->debitNoteNumber . "', "
                . "`cusdecNo` ='" . $this->cusdecNo . "' "
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

        $query = 'DELETE FROM `job` WHERE id="' . $this->id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }

    public function getJobsByConsignee($consignee) {

//        $query = "SELECT * FROM `job` WHERE `consignee`=" . $consignee;
        $query = "SELECT * FROM `job` WHERE `consignee` in (SELECT `id` FROM `consignee` WHERE id = $consignee or `parent` = $consignee)" ;

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function countOfTodayRegisteredJobs($today) {

        $query = "SELECT count(`id`) AS `count` FROM `job` WHERE `createdAt`=" . $today;

        $db = new Database();
        $result = mysql_fetch_array($db->readQuery($query));
        return $result;
    }

    public function getJobsByDateRange($from, $to) {

        $query = "SELECT * FROM `job` WHERE `createdAt` BETWEEN '" . $from . "' AND '" . $to . "' ORDER BY `id` ASC";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

}
