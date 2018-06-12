<?php

/**
 * Description of Database
 *
 * @author U s E r ¨
 */
class Database {

//    private $host = 'kelum818.ipagemysql.com';
//    private $name = 'nstenterprises';
//    private $user = 'nstenterprises';
//    private $password = 'NsT@)880';
    
    private $host = 'localhost';
    private $name = 'nst-enterprises';
    private $user = 'root';
    private $password = '';

    public function __construct() {
        mysql_connect($this->host, $this->user, $this->password) or die("Invalid host  or user details");
        mysql_select_db($this->name) or die("Unable to select database");
    }

    public function readQuery($query) {

        $result = mysql_query($query) or die(mysql_error());
        return $result;
    }

}
