<?php


class ModeloLogin{

    private $db;


    public function __construct(){
        $this->db = new Base;
    }




    public function obtenerUsuarioMail($mail,$pass){
    //    $this->db->query('SELECT * FROM usuarios WHERE email = :mail AND pass = :pass');
        $this->db->query('SELECT * FROM usuarios usu LEFT JOIN roles rol ON usu.idRol = rol.idRol WHERE email = :mail AND pass = :pass;');
        $this->db->bind(':mail', $mail);
        $this->db->bind(':pass', $pass);

        $fila = $this->db->registro();

        return $fila;
    }

    public function obtenerUsuarioId($id){
        $this->db->query('SELECT * FROM usuarios WHERE idUsuario = :id');
        $this->db->bind(':id', $id);

        $fila = $this->db->registro();

        return $fila;
    }






}
