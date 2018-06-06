<?php

/**
 * Description of Job
 *
 * @author U s E r ¨
 */
class Job {
    
    public $id;
    public $description;
    public $chassisNumber;
    public $vesselAndFlight;
    public $vesselAndFlightDate;
    public $copyReceivedDate;
    public $originalReceivedDate;
    public $debitNoteNumber;
    public $cusdecDate;
    
    public function __construct($id) {
        if ($id) {

            $query = "SELECT `id`,`description`,`chassisNumber`,`vesselAndFlight`,`vesselAndFlightDate`,`copyReceivedDate`,`originalReceivedDate`,`debitNoteNumber`,`cusdecDate` FROM `job` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->description = $result['description'];
            $this->chassisNumber = $result['chassisNumber'];
            $this->vesselAndFlight = $result['vesselAndFlight'];
            $this->vesselAndFlightDate = $result['vesselAndFlightDate'];
            $this->copyReceivedDate = $result['copyReceivedDate'];
            $this->originalReceivedDate = $result['originalReceivedDate'];
            $this->debitNoteNumber = $result['debitNoteNumber'];
            $this->cusdecDate = $result['cusdecDate'];

            return $this;
        }
    }
    
    public function create() {

        $query = "INSERT INTO `job` ("
                . "`description`,"
                . "`chassisNumber`,"
                . "`vesselAndFlight`,"
                . "`vesselAndFlightDate`,"
                . "`copyReceivedDate`,"
                . "`originalReceivedDate`,"
                . "`debitNoteNumber`,"
                . "`cusdecDate`) "
                . "VALUES  ("
                . "'" . $this->description . "',"
                . "'" . $this->chassisNumber . "',"
                . "'" . $this->vesselAndFlight . "',"
                . "'" . $this->vesselAndFlightDate . "',"
                . "'" . $this->copyReceivedDate . "',"
                . "'" . $this->originalReceivedDate . "',"
                . "'" . $this->debitNoteNumber . "',"
                . "'" . $this->cusdecDate . "'"
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
}
