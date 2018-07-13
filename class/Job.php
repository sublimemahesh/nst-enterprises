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
    public $cusdecDate;
    public $createdAt;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT `id`,`consignee`,`consignment`,`description`,`chassisNumber`,`vesselAndFlight`,`vesselAndFlightDate`,`copyReceivedDate`,`originalReceivedDate`,`debitNoteNumber`,`cusdecDate`,`createdAt` FROM `job` WHERE `id`=" . $id;

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
            $this->cusdecDate = $result['cusdecDate'];
            $this->createdAt = $result['createdAt'];

            return $this;
        }
    }

    public function create() {

        $query = "INSERT INTO `job` ("
                . "`consignee`,"
                . "`consignment`,"
                . "`description`,"
                . "`chassisNumber`,"
                . "`vesselAndFlight`,"
                . "`vesselAndFlightDate`,"
                . "`copyReceivedDate`,"
                . "`originalReceivedDate`,"
                . "`createdAt`) "
                . "VALUES  ("
                . "'" . $this->consignee . "',"
                . "'" . $this->consignment . "',"
                . "'" . $this->description . "',"
                . "'" . $this->chassisNumber . "',"
                . "'" . $this->vesselAndFlight . "',"
                . "'" . $this->vesselAndFlightDate . "',"
                . "'" . $this->copyReceivedDate . "',"
                . "'" . $this->originalReceivedDate . "',"
                . "'" . $this->createdAt . "'"
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

        $query = "SELECT * FROM `job`";
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
                . "`cusdecDate` ='" . $this->cusdecDate . "' "
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

        $query = "SELECT * FROM `job` WHERE `consignee`=" . $consignee;

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }
    
    public function getJobsByDateRange($from, $to) {

        $query = "SELECT * FROM `job` WHERE `createdAt` BETWEEN '". $from ."' AND '". $to ."' ORDER BY `id` ASC";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

}
