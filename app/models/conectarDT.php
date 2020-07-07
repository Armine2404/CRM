<?php

class ConectarDT {
   protected $user = "package";
    public $db;
    protected $pass = "Package2020$";

    public function __construct() {

    $this->db = new PDO('mysql:host=185.92.246.83;dbname=admin_package', $this->user, $this->pass);
    return $this->db;

    }

}
