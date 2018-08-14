<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of InvoiceDeliveryDetails
 *
 * @author U s E r ¨
 */
class InvoiceDeliveryDetails {
    public $id;
    public $invoice;
    public $name;
    public $amount;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT `id`,`invoice`,`name`,`amount` FROM `invoice_delivery` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->invoice = $result['invoice'];
            $this->name = $result['name'];
            $this->amount = $result['amount'];

            return $this;
        }
    }

    public function create() {

        $query = "INSERT INTO `invoice_delivery` ("
                . "`invoice`,"
                . "`name`,"
                . "`amount`) "
                . "VALUES  ("
                . "'" . $this->invoice . "',"
                . "'" . $this->name . "',"
                . "'" . $this->amount . "'"
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

        $query = "SELECT * FROM `invoice_delivery`";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function update() {
        
        $query = "UPDATE  `invoice_delivery` SET "
                . "`invoice` ='" . $this->invoice . "', "
                . "`name` ='" . $this->name . "', "
                . "`amount` ='" . $this->amount . "' "
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

        $query = 'DELETE FROM `invoice_delivery` WHERE id="' . $this->id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }

    public function getDeliveryDetailsByInvoice($invoice) {

        $query = "SELECT * FROM `invoice_delivery` WHERE `invoice`=" . $invoice;
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

}
