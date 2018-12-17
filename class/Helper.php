<?php

class Helper {

    public function randamId() {

        $today = time();
        $startDate = date('YmdHi', strtotime('1912-03-14 09:06:00'));
        $range = $today - $startDate;
        $rand = rand(0, $range);
        $randam = $rand . "_" . ($startDate + $rand) . '_' . $today . "_n";
        return $randam;
    }

    public function invoiceNo() {

//        $year = date("Y");
//        $nextyear = date("y") + 1;
        $month = date("m");
        $today = date("Y-m-d");

        $res = Account::getInvoiceId($today);

        $getStartYear = explode('-', $res['start_date']);
        $startyear = $getStartYear[0];
        
        $getEndYear = explode('-', $res['end_date']);
        $year = $getEndYear[0];
        $endyear = substr( $year, -2);
        

        $maxid = $res['current_invoice_id'] + 1;
//        $JOBCOSTINGCARD = JobCostingCard::getMaxID();
//        $maxid = $JOBCOSTINGCARD['maxid']+1;


        if ($maxid < 10) {
            $last_number = '0' . $maxid;
        } else {
            $last_number = $maxid;
        }
        $invoice = 'NST/' . $startyear . '/' . $endyear . '/' . $month . '/' . $last_number;
  
        return $invoice;
    }
    
    public function jobNo() {

        $month = date("m");
        $today = date("Y-m-d");

        $res = Account::getCurrentAccount($today);

        $getStartYear = explode('-', $res['start_date']);
        $startyear = $getStartYear[0];
        
        $getEndYear = explode('-', $res['end_date']);
        $year = $getEndYear[0];
        $endyear = substr( $year, -2);
        

        $maxid = $res['current_job_id'] + 1;


        if ($maxid < 10) {
            $last_number = '000' . $maxid;
        } else {
            $last_number = $maxid;
        }
        $job = 'NST/' . $startyear . '/' . $endyear . '/' . $month . '/' . $last_number;
  
        return $job;
    }

    public function calImgResize($newHeight, $width, $height) {

        $percent = $newHeight / $height;
        $result1 = $percent * 100;

        $result2 = $width * $result1 / 100;

        return array($result2, $newHeight);
    }

    public function getSitePath() {
//      return substr_replace(dirname(__FILE__), '', 70);
        $path = str_replace('class', '', dirname(__FILE__));
        return $path;
    }

}
