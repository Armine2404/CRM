<?php


class cambiar extends Controlador
{



    public function __construct()
    {
        $this->ModeloCambiar = $this->modelo('ModeloCambiar');

    }
    
    public function index()
    {

        $this->iniciar();

        $this->vista('login/cambiar');
      
    }

    public function actualizarContraseña(){

        if($_SERVER['REQUEST_METHOD'] == "POST"){

         

            $datos = [
                'email' => $_POST['email'],
                'pass' => $_POST['password'],
          
            ];
          
            try
            {  
            if($this->ModeloCambiar->actualizarContraseña($datos)){

                redireccionar('/login');
            } else {
                die('Algo salio mal');
                redireccionar('/login');
            }
           }     
           catch(PDOException $exception){  
            redireccionar('/login');
             return $exception->getMessage();                          
     
       }

        } else {
        $datos = [
            "email" => '',
            "pass" => '',
            
        ];
        echo 'No hay post';
          //  $this->vista('/acciones',$datos);


        }


    }

}