<?php

/**
 * Description of Database
 *
 * @author U s E r ¨
 */
class Database {

//    private $host = 'localhost';
//    private $name = 'islapiiu_nst';
//    private $user = 'islapiiu_main';
//    private $password = 'Ue.t;FNgC?BG,Paf8V';
    
    // private $host = 'localhost';
    // private $name = 'synoteca_nst';
    // private $user = 'synoteca_nst';
    // private $password = 'MRS^XKx7xdx+';

  private $host = 'localhost';
  private $name = 'nst';
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
