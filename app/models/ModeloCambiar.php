<?php


class ModeloCambiar{

    private $db;


    public function __construct(){
        $this->db = new Base;
    }

    public function actualizarContraseña($datos){
        // print_r($datos);
        $this->db->query('UPDATE usuarios SET pass = :pass WHERE email = :email');
        $this->db->bind(':pass', $datos['pass']);
        $this->db->bind(':email', $datos['email']);
     
        //Ejecutar
        if($this->db->execute()){
            return true;

        }else {
            return false;
        }
    }

}