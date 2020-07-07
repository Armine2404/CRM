<?php


class Recuperar extends Controlador
{



    public function __construct()
    {
        $this->ModeloRecuperar = $this->modelo('ModeloRecuperar');

    }
    
    public function index()
    {

        $this->iniciar();

        $this->vista('login/recuperar');
      
    }
    public function getEmail()
    {
        if($_SERVER['REQUEST_METHOD'] == "POST"){
        $email=$_POST['mail'];   
        $datos = ['email' => $email];                
        $datosEmail = $this->ModeloRecuperar->obtenerEmail($datos); 
        require 'EmailRecuperar.php';
        }     

              
        redireccionar('/login');
    }
}