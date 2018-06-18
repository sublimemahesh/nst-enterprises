<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ReimbursementDetails
 *
 * @author U s E r ¨
 */
class ReimbursementDetails {

    public $id;
    public $jobCostingCard;
    public $reimbursementItem;
    public $voucherNumber;
    public $amount;
    public $description;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT `id`,`jobCostingCard`,`reimbursementItem`,`voucherNumber`,`amount`,`description` FROM `reimbursement_details` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->jobCostingCard = $result['jobCostingCard'];
            $this->reimbursementItem = $result['reimbursementItem'];
            $this->voucherNumber = $result['voucherNumber'];
            $this->amount = $result['amount'];
            $this->description = $result['description'];

            return $this;
        }
    }

    public function create() {

        $query = "INSERT INTO `reimbursement_details` ("
                . "`jobCostingCard`,"
                . "`reimbursementItem`,"
                . "`voucherNumber`,"
                . "`amount`,"
                . "`description`) "
                . "VALUES  ("
                . "'" . $this->jobCostingCard . "',"
                . "'" . $this->reimbursementItem . "',"
                . "'" . $this->voucherNumber . "',"
                . "'" . $this->amount . "',"
                . "'" . $this->description . "'"
                . ")";

        $db = new Database();

        $result = $db->readQuery($query);

        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function all() {

        $query = "SELECT * FROM `reimbursement_details` ORDER BY `description` ASC ";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function update() {

        $query = "UPDATE  `reimbursement_details` SET "
                . "`jobCostingCard` ='" . $this->jobCostingCard . "', "
                . "`reimbursementItem` ='" . $this->reimbursementItem . "', "
                . "`voucherNumber` ='" . $this->voucherNumber . "', "
                . "`amount` ='" . $this->amount . "', "
                . "`description` ='" . $this->description . "' "
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

        $query = 'DELETE FROM `reimbursement_details` WHERE id="' . $this->id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }
    
    public function getReimbursementDetailsByJobCostingCard($jobcostingcard) {

        $query = "SELECT * FROM `reimbursement_details` WHERE `jobCostingCard` = '". $jobcostingcard ."'";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

}
