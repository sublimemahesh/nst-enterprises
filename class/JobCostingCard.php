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

    public function __construct($id) {
        if ($id) {

            $query = "SELECT `id`,`job`,`date` FROM `job_costing_card` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->job = $result['job'];
            $this->date = $result['date'];

            return $this;
        }
    }

    public function create() {

        $query = "INSERT INTO `job_costing_card` ("
                . "`job`,"
                . "`date`) "
                . "VALUES  ("
                . "'" . $this->job . "',"
                . "'" . $this->date . "'"
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
                . "`date` ='" . $this->date . "' "
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

}
