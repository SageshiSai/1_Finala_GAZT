<?php 
class conect_data {
     public $host;
     public $userbbdd;
     public $passbbdd;
     public $ddbbname;

    function __construct() {
        if ($_SERVER['SERVER_NAME'] == 'localhost') {
            $this->host = 'localhost';
            $this->userbbdd = 'root';
            $this->passbbdd = '';
            $this->ddbbname = 'editorial';
        } 
    }
    
}