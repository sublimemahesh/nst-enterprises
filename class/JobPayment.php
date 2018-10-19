<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of JobPayment
 *
 * @author U s E r ¨
 */
class JobPayment {

    public $id;
    public $job;
    public $createdAt;
    public $customer_name;
    public $payment;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT `id`,`job`,`createdAt`,`customer_name`,`payment` FROM `job_payment` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->job = $result['job'];
            $this->createdAt = $result['createdAt'];
            $this->customer_name = $result['customer_name'];
            $this->payment = $result['payment'];

            return $this;
        }
    }

    public function create() {

        $query = "INSERT INTO `job_payment` ("
                . "`job`,"
                . "`createdAt`,"
                . "`customer_name`,"
                . "`payment`) "
                . "VALUES  ("
                . "'" . $this->job . "',"
                . "'" . $this->createdAt . "',"
                . "'" . $this->customer_name . "',"
                . "'" . $this->payment . "'"
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

        $query = "SELECT * FROM `job_payment` ORDER BY `id` ASC ";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function update() {

        $query = "UPDATE  `job_payment` SET "
                . "`customer_name` ='" . $this->customer_name . "', "
                . "`payment` ='" . $this->payment . "' "
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

        $query = 'DELETE FROM `job_payment` WHERE id="' . $this->id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }

    public function arrange($key, $img) {
        $query = "UPDATE `job_payment` SET `payment` = '" . $key . "'  WHERE id = '" . $img . "'";
        $db = new Database();
        $result = $db->readQuery($query);
        return $result;
    }

    public function getPaymentsByJob($job) {

        $query = "SELECT * FROM `job_payment` WHERE `job` = " . $job;
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function getSumOfPaymentsByJob($job) {

        $query = "SELECT sum(`payment`) AS `sum` FROM `job_payment` WHERE `job` = " . $job;
        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));
        return $result;
    }
    
    public function countOfTodayPayment($today) {

        $query = "SELECT count(`id`) AS `count` FROM `job_payment` WHERE `createdAt`='" . $today ."'";

        $db = new Database();
        $result = mysql_fetch_array($db->readQuery($query));
        return $result;
    }

}
