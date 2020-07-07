<?php


class Usuarios extends Controlador
{



    public function __construct()
    {
        parent::__construct();
        $this->DatatableUsuarios = $this->modelo('ModeloUsuarios');

    }
    //Crear modelo y vista ruta: ur./nombrecontrolador/funcion/parametro consulta al modelo
    //
    //LLamar a funcion ss clientes
    // en func clientes require al modelo (fichero que manda los datos)

    public function index()
    {

        $this->iniciar();

        $this->vista('datatable/usuarios');
        // if(!isset($_SESSION['autorizado']) || $_SESSION['autorizado'] != 1){
        //   redireccionar('/login');
        // } else {
        // }
    }

    public function getUsuarios()
    {

        $acciones = $this->DatatableUsuarios->obtenerUsuarios();

        echo $acciones;
    }

    public function getUsuariosTabla()
    {

        $acciones = $this->DatatableUsuarios->obtenerUsuariosTabla();

        echo $acciones;
    }

    public function getUsuariosSelect()
    {

        $usuarios = $this->DatatableUsuarios->obtenerUsuariosSelect();

        echo json_encode($usuarios);
    }


    public function agregarUsuario(){

        if($_SERVER['REQUEST_METHOD'] == "POST"){

            $datos = [
                "idRol" => $_POST['idRol'],
                "usuario" => $_POST['usuario'],
                "email" => $_POST['email'],
                "pass" => $_POST['password'],
                "permisos" => $this->permisos 
            ];
             
            try{

            if($this->DatatableUsuarios->agregarUsuario($datos)){
                redireccionar('/usuarios');
            } else {
                die('Algo salio mal');
            }
        }     
        catch(PDOException $exception){  
        redireccionar('/usuarios');
        return $exception->getMessage();    
      }                    
     
        

        } else {
        $datos = [
            "idRol" => " ",
                "usuario" => " ",
                "email" => " ",
                "pass" => " ",
                "permisos" => $this->permisos 

        ];

            $this->vista('/usuarios',$datos);


        }
    }

    public function getUsuario($id)
    {

        $usuario = $this->DatatableUsuarios->obtenerUsuarioId($id);

        $datos = [
            'usuario' => $usuario,
            "permisos" => $this->permisos 
        ];

        return $datos;
    }


    public function actualizarUsuario(){

        if($_SERVER['REQUEST_METHOD'] == "POST"){

            $datos = [
                "idUsuario" => $_POST['id'],
                "idRol" => $_POST['idRol'],
                "usuario" => $_POST['usuario'],
                "email" => $_POST['email'],
                "pass" => $_POST['passEdit'],
                "permisos" => $this->permisos 
            ];

            try{

            if($this->DatatableUsuarios->actualizarUsuario($datos)){
                redireccionar('/usuarios');
            } else {
                die('Algo salio mal');
            }
        }     
        catch(PDOException $exception){  
        redireccionar('/usuarios');
        return $exception->getMessage();      }                    
     
       

        } else {
          $datos = [
              "idUsuario" => " ",
              "idRol" => " ",
              "usuario" => " ",
              "email" => " ",
              "permisos" => $this->permisos 
          ];

          $this->vista('/usuarios',$datos);

        }
    }


    public function borrarUsuario(){

        if($_SERVER['REQUEST_METHOD'] == "POST"){

            if( isset($_POST['id']) && $_POST['id'] != ''){

              $datos = [
                "id" => $_POST['id'],
                "permisos" => $this->permisos 
              ];
              try{

              if($this->DatatableUsuarios->borrarUsuario($datos)){
                redireccionar('/usuarios');
              } else {
                die('Algo salio mal');
              }
            }     
            catch(PDOException $exception){  
            redireccionar('/usuarios');
            return $exception->getMessage();      
        }                    
         
            
            } else {
              die('Elige el usuario para eliminar');
            }

        } else {
          $datos = [
                  "idRol" => " ",
                  "usuario" => " ",
                  "email" => " ",
                  "pass" => " ",
                  "permisos" => $this->permisos 
          ];
          $this->vista('/usuarios',$datos);
        }
    }
}
