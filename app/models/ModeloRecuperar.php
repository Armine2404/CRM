<?php


class ModeloRecuperar{

    private $db;


    public function __construct(){
        $this->db = new Base;
    }

    public function obtenerEmail($datos){
      
        $this->db->query('SELECT * FROM usuarios WHERE email = :email');
        $this->db->bind(':email', $datos['email']);
        $fila = $this->db->registro();
        return $fila;

    }

}