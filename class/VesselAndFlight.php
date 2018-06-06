<?php

/**
 * Description of VesselAndFlight
 *
 * @author U s E r ¨
 */
class VesselAndFlight {
    
    public $id;
    public $isVessel;
    public $isFlight;
    public $name;
    public $isActive;
    public $queue;
    
    public function __construct($id) {
        if ($id) {

            $query = "SELECT `id`,`isVessel`,`isFlight`,`name`,`isActive`,`queue` FROM `vessel_and_flight` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->isVessel = $result['isVessel'];
            $this->isFlight = $result['isFlight'];
            $this->name = $result['name'];
            $this->isActive = $result['isActive'];
            $this->queue = $result['queue'];

            return $this;
        }
    }
    
    public function create() {

        $query = "INSERT INTO `vessel_and_flight` ("
                . "`isVessel`,"
                . "`isFlight`,"
                . "`name`,"
                . "`isActive`,"
                . "`queue`) "
                . "VALUES  ("
                . "'" . $this->isVessel . "',"
                . "'" . $this->isFlight . "',"
                . "'" . $this->name . "',"
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

        $query = "SELECT * FROM `vessel_and_flight` ORDER BY `queue` ASC ";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }
    
    public function update() {

        $query = "UPDATE  `vessel_and_flight` SET "
                . "`isVessel` ='" . $this->isVessel . "', "
                . "`isFlight` ='" . $this->isFlight . "', "
                . "`name` ='" . $this->name . "', "
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

        $query = 'DELETE FROM `vessel_and_flight` WHERE id="' . $this->id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }
    
    public function getActiveAll() {

        $query = "SELECT * FROM `vessel_and_flight` WHERE `isActive` = 1 ORDER BY `queue` ASC ";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }
    
    public function vesselAndFlightActivation() {

        $query = "UPDATE  `vessel_and_flight` SET "
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
