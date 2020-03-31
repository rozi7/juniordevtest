<?php

namespace App;

class Database
{
    private $_conn;

    public function __construct($host, $user, $pass, $dbname) {
        $this->connect($host, $user, $pass, $dbname);
    }

    public function connect($host, $user, $pass, $dbname) {
        $this->_conn = new \mysqli($host, $user, $pass, $dbname);
    }

    public function connection() {
        return $this->_conn;
    }
}