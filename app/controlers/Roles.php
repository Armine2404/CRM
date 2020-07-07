<?php


class Roles extends Controlador
{



    public function __construct()
    {
        parent::__construct();
        $this->DatatableRoles = $this->modelo('ModeloRoles');

    }
    
    public function index()
    {

        $this->iniciar();

        $this->vista('datatable/roles');
      
    }

    public function getRoles()
    {

        $roles = $this->DatatableRoles->obtenerRoles();

        echo $roles;
    }
    public function getRolesSelect()
    {

        $roles = $this->DatatableRoles->obtenerRolesSelect();

        echo json_encode($roles);
    }


    public function agregarRol(){

        if($_SERVER['REQUEST_METHOD'] == "POST"){
               
            $datos = [
                "rol" => $_POST['rol'],
                "permisos" => $this->permisos       
            ];
             try{
            if($this->DatatableRoles->agregarRol($datos)){
                redireccionar('/roles');
            } else {
                die('Algo salio mal');
            }
        }     
        catch(PDOException $exception){  
        redireccionar('/roles');
        return $exception->getMessage();                        
     
       }

        } else {
        $datos = [
            "rol" => '',
            "permisos" => $this->permisos 
           
        ];

            $this->vista('/roles',$datos);
        }
    }

    public function actualizarRol(){

        if($_SERVER['REQUEST_METHOD'] == "POST"){

         

            $datos = [
                "id" => $_POST['id'],
                "rol" => $_POST['rol'],
                "permisos" => $this->permisos 
          
            ];
            try
            {  
            if($this->DatatableRoles->actualizarRol($datos)){

                redireccionar('/roles');
            } else {
                die('Algo salio mal');
            }
           }     
           catch(PDOException $exception){  
            redireccionar('/roles');
             return $exception->getMessage();                          
     
       }

        } else {
        $datos = [
            "id" => '',
            "rol" => '',
            "permisos" => $this->permisos 
            
        ];
        echo 'No hay post';
          //  $this->vista('/acciones',$datos);


        }


    }
    
    public function borrarRol(){

        if($_SERVER['REQUEST_METHOD'] == "POST"){

            if( isset($_POST['id']) && $_POST['id'] != ''){

              $datos = [
                "id" => $_POST['id'],
                "permisos" => $this->permisos 
              ];
              try
              {         
                if($this->DatatableRoles->borrarRol($datos)){
                    redireccionar('/roles');
                  } else {
                    die('Algo salio mal');
                  }  
               }     
               catch(PDOException $exception){  
               redireccionar('/roles');
               return $exception->getMessage();      }                    
            
              } else {
              die('Elige el rol para eliminar');
              }



        } else {
        $datos = [
            "id" => '',
            "rol" => '',
            "permisos" => $this->permisos 
           
        ];
            $this->vista('/roles',$datos);
        }
    }


        public function editar($id){

            if($_SERVER['REQUEST_METHOD'] == "POST"){
                $datos = [
                    "idRol" => $id,
                    "rol" => trim($_POST['rol']),
                    "permisos" => $this->permisos                 
                ];
    
                if($this->rolModelo->actualizarRol($datos)){
                    redireccionar('datatable/roles');
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