<?php


class Login extends Controlador{



    public function __construct(){
        parent::__construct();
       $this->loginModelo = $this->modelo('ModeloLogin');

    }

    public function index(){

               $this->vista('login/login');

    }

    public function comprobar(){
        if($_SERVER['REQUEST_METHOD'] == "POST"){
                $mail = trim($_POST['mail']);
                $password = trim($_POST['password']);
        }

       $usuario = $this->loginModelo->obtenerUsuarioMail($mail,$password);

        if($usuario->email && $usuario->pass){
            session_start();
            $_SESSION['id_usuario'] = $usuario->idUsuario;
            $_SESSION['nombre'] = $usuario->usuario;
            $_SESSION['mail'] = $usuario->email;
            $_SESSION['rol'] = $usuario->idRol;
            $_SESSION['nombreRol'] = $usuario->nombreRol;
            $_SESSION["timeout"] = time();
            $_SESSION["duracion"] = 3000; // duracion de la session en segundos - al finalizar el tiempo no te redirige al login
            $tareas=$this->notificaciones($usuario->idUsuario);
            
            $_SESSION["notifi"]=$tareas;
            //  $tareas=$this->notificaciones($usuario->idUsuario);
            
            // $_SESSION["pendientes"]= $tareas->pendientes;
            // $_SESSION["total"]= $tareas->total;
            // $_SESSION["penPorcentaje"]= $tareas->penPorcentaje;
            // $_SESSION["proceso"]= $tareas->proceso;
            // $_SESSION["proPorcentaje"]= $tareas->proPorcentaje;
            // $_SESSION["finalizadas"]= $tareas->finalizadas;
            // $_SESSION["finPorcentaje"]= $tareas->finPorcentaje;
            // $_SESSION["hoy"]= $tareas->hoy;
            // $_SESSION["hoyPorcentaje"]= $tareas->hoyPorcentaje;
            // $_SESSION["nombre"]= $tareas->usuario;

            //redireccionar('/paginas');
           redireccionar('/crm');
        } else {
           redireccionar('/login');
        }

    }

    



}
