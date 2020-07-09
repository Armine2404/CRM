<?php

class ConectarDT {
   protected $user = "root";
    public $db;
    protected $pass = "";

    public function __construct() {

    $this->db = new PDO('mysql:host=localhost;dbname=admin_package', $this->user, $this->pass);
    return $this->db;

    }

}
