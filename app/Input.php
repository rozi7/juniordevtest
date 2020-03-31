<?php

namespace App;

class Input
{
    private $db;

    private $app;

    protected $postContainer = [];

    public function __construct($db, $app) {
        $this->db = $db;
        $this->app = $app;
        $this->postContainer = $_POST;
        $this->getContainer = $_GET;
        $method = $_SERVER['REQUEST_METHOD'];
        if($method == 'PUT'){
            parse_str(file_get_contents('php://input'), $_PUT);
            $this->putContainer = $_PUT;
        }else{
            $this->putContainer = array();
        }
    }

    public function post($n = null, $cleaning = true) {
        if(is_null($n)) return $this->postContainer;
        
        return $this->all($n, 'post', $cleaning);
    }

    public function put($n = null, $cleaning = true) {
        if(is_null($n)) return $this->putContainer;
        
        return $this->all($n, 'put', $cleaning);
    }

    public function postDate($n, $cleaning = true) {
        return $this->app->dateFromString($this->all($n, 'post', $cleaning));
    }

    public function get($n, $cleaning = true) {
        return $this->all($n, 'get', $cleaning);
    }

    public function all($n, $from = 'both', $cleaning = true) {
        $container = array_merge($this->postContainer, $this->getContainer, $this->putContainer);
        if($from == 'post') $container = $this->postContainer;
        elseif($from == 'get') $container = $this->getContainer;
        elseif($from == 'put') $container = $this->putContainer;
        
        if(!in_array($n, array_keys($container))) return null;
        
        if($cleaning) {
            $data = $container[$n];
            
            if(is_array($data)) return array_map([$this, 'cleaning'], $data);
            else return $this->cleaning($data);
        }
        else return $container[$n];
    }

    public function cleaning($data) {
        $data = trim($data);
        
        if(get_magic_quotes_gpc()){
            $data = stripslashes($data);
        }
        
        $data = mysqli_real_escape_string($this->db, $data);
        return $data;
    }
}