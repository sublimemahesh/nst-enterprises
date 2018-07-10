<?php

/**
 * Description of Invoice
 *
 * @author U s E r ¨
 */
class Invoice {

    public $id;
    public $job_costing_card;
    public $createdAt;
    public $vat_reg_no;
    public $cleared_date;
    public $gross_weight;
    public $volume;
    public $cusdec_no;
    public $agency_fees;
    public $documentation;
    public $vat;
    public $tax_total;
    public $statutory_sub_total;
    public $delivery_sub_total;
    public $payable_amount;
    public $advance;
    public $due;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT `id`,`job_costing_card`,`createdAt`,`vat_reg_no`,`cleared_date`,`gross_weight`,`volume`,`cusdec_no`,`agency_fees`,`documentation`,`vat`,`tax_total`,`statutory_sub_total`,`delivery_sub_total`,`payable_amount`,`advance`,`due` FROM `invoice` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->job_costing_card = $result['job_costing_card'];
            $this->createdAt = $result['createdAt'];
            $this->vat_reg_no = $result['vat_reg_no'];
            $this->cleared_date = $result['cleared_date'];
            $this->gross_weight = $result['gross_weight'];
            $this->volume = $result['volume'];
            $this->cusdec_no = $result['cusdec_no'];
            $this->agency_fees = $result['agency_fees'];
            $this->documentation = $result['documentation'];
            $this->vat = $result['vat'];
            $this->tax_total = $result['tax_total'];
            $this->statutory_sub_total = $result['statutory_sub_total'];
            $this->delivery_sub_total = $result['delivery_sub_total'];
            $this->payable_amount = $result['payable_amount'];
            $this->advance = $result['advance'];
            $this->due = $result['due'];

            return $this;
        }
    }

    public function create() {


        $query = "INSERT INTO `invoice` ("
                . "`job_costing_card`,"
                . "`createdAt`,"
                . "`vat_reg_no`,"
                . "`cleared_date`,"
                . "`gross_weight`,"
                . "`volume`,"
                . "`cusdec_no`,"
                . "`agency_fees`,"
                . "`documentation`,"
                . "`vat`,"
                . "`tax_total`,"
                . "`statutory_sub_total`,"
                . "`delivery_sub_total`,"
                . "`payable_amount`,"
                . "`advance`,"
                . "`due`) "
                . "VALUES  ("
                . "'" . $this->job_costing_card . "',"
                . "'" . $this->createdAt . "',"
                . "'" . $this->vat_reg_no . "',"
                . "'" . $this->cleared_date . "',"
                . "'" . $this->gross_weight . "',"
                . "'" . $this->volume . "',"
                . "'" . $this->cusdec_no . "',"
                . "'" . $this->agency_fees . "',"
                . "'" . $this->documentation . "',"
                . "'" . $this->vat . "',"
                . "'" . $this->tax_total . "',"
                . "'" . $this->statutory_sub_total . "',"
                . "'" . $this->delivery_sub_total . "',"
                . "'" . $this->payable_amount . "',"
                . "'" . $this->advance . "',"
                . "'" . $this->due . "'"
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

        $query = "SELECT * FROM `invoice`";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function update() {

        $query = "UPDATE  `invoice` SET "
                . "`vat_reg_no` ='" . $this->vat_reg_no . "', "
                . "`cleared_date` ='" . $this->cleared_date . "', "
                . "`gross_weight` ='" . $this->gross_weight . "', "
                . "`volume` ='" . $this->volume . "', "
                . "`cusdec_no` ='" . $this->cusdec_no . "', "
                . "`agency_fees` ='" . $this->agency_fees . "', "
                . "`documentation` ='" . $this->documentation . "', "
                . "`vat` ='" . $this->vat . "', "
                . "`tax_total` ='" . $this->tax_total . "', "
                . "`statutory_sub_total` ='" . $this->statutory_sub_total . "', "
                . "`delivery_sub_total` ='" . $this->delivery_sub_total . "', "
                . "`payable_amount` ='" . $this->payable_amount . "', "
                . "`advance` ='" . $this->advance . "', "
                . "`due` ='" . $this->due . "' "
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

        $query = 'DELETE FROM `invoice` WHERE id="' . $this->id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }

    public function getInvoiceByJobCostingCard($job_costing_card) {

        $query = "SELECT * FROM `invoice` WHERE `job_costing_card`=" . $job_costing_card;

        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));

        return $result;
    }

}
