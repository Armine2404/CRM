<?php


class Paginas extends Controlador{

    public function __construct(){
        parent::__construct();
        // echo  "Controlador paginas cargado";
        $this->usuarioModelo = $this->modelo('Usuario');
        $this->iniciar();
    }

    public function index(){

        //Obtener los usuarios
        $usuarios = $this->usuarioModelo->obtenerUsuarios();

        $datos = [
            'usuarios' => $usuarios,
            "permisos" => $this->permisos 
        ];
        $this->vista('paginas/inicio', $datos);


    }


    public function agregar(){

        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $datos = [
                "nombre" => trim($_POST['nombre']),
                "mail" => trim($_POST['mail']),
                "telefono" => trim($_POST['telefono']),
                "permisos" => $this->permisos 
            ];

            if($this->usuarioModelo->agregarUsuario($datos)){
                redireccionar('/paginas');
            } else {
                die('Algo salio mal');
            }


        } else {
            $datos = [
                "nombre" => '',
                "mail" => '',
                "telefono" => '',
                "permisos" => $this->permisos 
            ];

            $this->vista('paginas/agregar',$datos);


        }
    }


        public function editar($id){

            if($_SERVER['REQUEST_METHOD'] == "POST"){
                $datos = [
                    "id_usuario" => $id,
                    "nombre" => trim($_POST['nombre']),
                    "mail" => trim($_POST['mail']),
                    "telefono" => trim($_POST['telefono']),
                    "permisos" => $this->permisos 
                ];

                if($this->usuarioModelo->actualizarUsuario($datos)){
                    redireccionar('/paginas');
                } else {
                    die('Algo salio mal');
                }

            } else {

                //obtener informacion del usuario desde el modelo
                $usuario = $this->usuarioModelo->obtenerUsuarioId($id);


                $datos = [
                    "id_usuario" => $usuario->id_usuario,
                    "nombre" => $usuario->nombre,
                    "mail" => $usuario->mail,
                    "telefono" => $usuario->telefono,
                    "permisos" => $this->permisos 
                ];

                $this->vista('paginas/editar',$datos);

        }

        }


        public function borrar($id){

            //obtener informacion del usuario desde el modelo
            $usuario = $this->usuarioModelo->obtenerUsuarioId($id);


            $datos = [
                "id_usuario" => $usuario->id_usuario,
                "nombre" => $usuario->nombre,
                "mail" => $usuario->mail,
                "telefono" => $usuario->telefono,
                "permisos" => $this->permisos 
            ];

            if($_SERVER['REQUEST_METHOD'] == "POST"){
                $datos = [
                    "id_usuario" => $id,
                    "permisos" => $this->permisos 
                ];

                if($this->usuarioModelo->borrarUsuario($datos)){
                    redireccionar('/paginas');
                } else {
                    die('Algo salio mal');
                }


            }
            $this->vista('paginas/borrar',$datos);

        }









}