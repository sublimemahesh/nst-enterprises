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
    public $type;
    public $voucherNumber;
    public $amount;
    public $description;
    public $invoiceamount;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT `id`,`jobCostingCard`,`reimbursementItem`,`type`,`voucherNumber`,`amount`,`description`,`invoice_amount` FROM `reimbursement_details` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->jobCostingCard = $result['jobCostingCard'];
            $this->reimbursementItem = $result['reimbursementItem'];
            $this->type = $result['type'];
            $this->voucherNumber = $result['voucherNumber'];
            $this->amount = $result['amount'];
            $this->description = $result['description'];
            $this->invoiceamount = $result['invoice_amount'];

            return $this;
        }
    }

    public function create() {

        $query = "INSERT INTO `reimbursement_details` ("
                . "`jobCostingCard`,"
                . "`reimbursementItem`,"
                . "`type`,"
                . "`voucherNumber`,"
                . "`amount`,"
                . "`description`) "
                . "VALUES  ("
                . "'" . $this->jobCostingCard . "',"
                . "'" . $this->reimbursementItem . "',"
                . "'" . $this->type . "',"
                . "'" . $this->voucherNumber . "',"
                . "'" . $this->amount . "',"
                . "'" . $this->description . "'"
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
                . "`voucherNumber` ='" . $this->voucherNumber . "', "
                . "`amount` ='" . $this->amount . "', "
                . "`description` ='" . $this->description . "' "
                . "WHERE `id` = '" . $this->id . "'";

        $db = new Database();

        $result = $db->readQuery($query);

        if ($result) {
            return TRUE;
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
    
    public function getReimbursementDetailsByReimbursementItemAndType($reimbursementitem, $jobcostingcard, $type) {
        
        $query = "SELECT * FROM `reimbursement_details` WHERE `reimbursementItem` = '". $reimbursementitem ."' AND `jobCostingCard` = '". $jobcostingcard ."' AND `type` = '". $type ."'";
        $db = new Database();
        
        $result = mysql_fetch_array($db->readQuery($query));
        
        return $result;
    }
    
    public function getReimbursementDetailsByReimbursementItemAndJobCostingCard($reimbursementitem, $jobcostingcard) {
        
        $query = "SELECT * FROM `reimbursement_details` WHERE `reimbursementItem` = '". $reimbursementitem ."' AND `jobCostingCard` = '". $jobcostingcard ."'";
        $db = new Database();
        
        $result = mysql_fetch_array($db->readQuery($query));
        
        return $result;
    }
    
    public function getCountByJobCostingCardAndType($jobcostingcard, $type) {

        $query = "SELECT count(`id`) AS `count`, type FROM `reimbursement_details` WHERE `jobCostingCard` = '". $jobcostingcard ."' AND `type` = '". $type ."'";
        $db = new Database();
        
        $result = mysql_fetch_array($db->readQuery($query));
        
        return $result;
    }
    
    public function getSubTotalByJobCostingCardAndType($jobcostingcard, $type) {

        $query = "SELECT sum(`amount`) AS `subtotal` FROM `reimbursement_details` WHERE `jobCostingCard` = '". $jobcostingcard ."' AND `type` = '". $type ."'";
        $db = new Database();
        
        $result = mysql_fetch_array($db->readQuery($query));

        return $result;
    }
    
    public function countByType($jobcostingcard) {

        $query = "SELECT `type`, count(id) AS `count` FROM `reimbursement_details` WHERE `jobCostingCard` = '". $jobcostingcard ."' GROUP BY `type`";
        $db = new Database();
        
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }
    
    public function getGrandTotalByJobCostingCard($jobcostingcard) {

        $query = "SELECT sum(`amount`) AS `grandtotal` FROM `reimbursement_details` WHERE `jobCostingCard` = '". $jobcostingcard ."'";
        $db = new Database();
        
        $result = mysql_fetch_array($db->readQuery($query));

        return $result;
    }
    
    public function updateInvoiceAmount() {

        $query = "UPDATE  `reimbursement_details` SET "
                . "`invoice_amount` ='" . $this->invoiceamount . "' "
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
