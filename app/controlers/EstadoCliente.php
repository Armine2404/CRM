<?php


class EstadoCliente extends Controlador
{



    public function __construct()
    {
        parent::__construct();
        $this->DatatableClientes = $this->modelo('ModeloEstadoCliente');

    }
    //Crear modelo y vista ruta: ur./nombrecontrolador/funcion/parametro consulta al modelo
    //
    //LLamar a funcion ss clientes
    // en func clientes require al modelo (fichero que manda los datos)

    public function index()
    {

        $this->iniciar();

        $this->vista('datatable/estadoCliente');
        // if(!isset($_SESSION['autorizado']) || $_SESSION['autorizado'] != 1){
        //   redireccionar('/login');
        // } else {
        // }
    }

    public function getEstadoCliente()
    {

        $estadoClientes = $this->DatatableClientes->obtenerEstadoCliente();

        echo $estadoClientes;
    }
    public function getEstadoClienteSelect()
    {

        $roles = $this->DatatableClientes->obtenerEstadoClienteSelect();

        echo json_encode($roles);
    }

    public function agregarEstadoCliente(){

        if($_SERVER['REQUEST_METHOD'] == "POST"){
               
            $datos = [
                "estadoCliente" => $_POST['estado'],
                "permisos" => $this->permisos      
            ];
            try{
                if($this->DatatableClientes->agregarEstadoCliente($datos)){
                    redireccionar('/estadoCliente');
                } else {
                    die('Algo salio mal');
                }
            }     
            catch(PDOException $exception) {  
                redireccionar('/estadoCliente');
                return $exception->getMessage();     
            }                    
            
        } else {
        $datos = [
            "estadoCliente" => '',
            "permisos" => $this->permisos             
           
        ];

            $this->vista('/estadoCliente',$datos);


        }
    }
    
    
    public function actualizarEstadoCliente(){

        if($_SERVER['REQUEST_METHOD'] == "POST"){

         

            $datos = [
                "idEstadoCliente" => $_POST['id'],
                "estadoCliente" => $_POST['estado'],
                "permisos" => $this->permisos 
          
            ];
            try{
            if($this->DatatableClientes->actualizarEstadoCliente($datos)){

                redireccionar('/estadoCliente');
            } else {
                die('Algo salio mal');
            }
        }     
        catch(PDOException $exception){  
        redireccionar('/estadoCliente');
        return $exception->getMessage();      }                    
     
        

        } else {
        $datos = [
            "idEstadoCliente" => '',
            "estadoCliente" => '',
            "permisos" => $this->permisos 
            
        ];
        echo 'No hay post';
          //  $this->vista('/acciones',$datos);


        }


    }
    
    public function borrarEstadoCliente(){

        if($_SERVER['REQUEST_METHOD'] == "POST"){

            if( isset($_POST['id']) && $_POST['id'] != ''){

              $datos = [
                "id" => $_POST['id'],
                "permisos" => $this->permisos 
              ];
              try{
              if($this->DatatableClientes->borrarEstadoCliente($datos)){
                redireccionar('/estadoCliente');
              } else {
                die('Algo salio mal');
              }
            }     
            catch(PDOException $exception){  
            redireccionar('/estadoCliente');
            return $exception->getMessage();      }                    
         
            
            } else {
              die('Elige la acción para eliminar');
            }



        } else {
        $datos = [
            "idEstadoCliente" => '',
            "estadoCliente" => '',
            "permisos" => $this->permisos 
           
        ];
            $this->vista('/estadoCliente',$datos);
        }
    }
}