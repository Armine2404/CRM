<?php


class EstadosAcciones extends Controlador
{



    public function __construct()
    {
        parent::__construct();
        $this->DatatableEstadosAcciones = $this->modelo('ModeloEstadosAcciones');

    }
    //Crear modelo y vista ruta: ur./nombrecontrolador/funcion/parametro consulta al modelo
    //
    //LLamar a funcion ss clientes
    // en func clientes require al modelo (fichero que manda los datos)

    public function index()
    {

        $this->iniciar();

        $this->vista('datatable/estadosAcciones');
        // if(!isset($_SESSION['autorizado']) || $_SESSION['autorizado'] != 1){
        //   redireccionar('/login');
        // } else {
        // }
    }

    public function getEstadosAcciones()
    {

        $estadosAcciones = $this->DatatableEstadosAcciones->obtenerEstadosAcciones();

        echo $estadosAcciones;
    }

    public function getEstadosAccionesSelect()
    {

        $estadosAcciones = $this->DatatableEstadosAcciones->obtenerEstadosAccionesSelect();

        echo json_encode($estadosAcciones);
    }
    public function agregarEstadoAccion(){

        if($_SERVER['REQUEST_METHOD'] == "POST"){
               
            $datos = [
                "estadoAccion" => $_POST['estadoAccion'],
                "permisos" => $this->permisos      
            ];
            try{

            if($this->DatatableEstadosAcciones->agregarEstadoAccion($datos)){
                redireccionar('/estadosAcciones');
            } else {
                die('Algo salio mal');
            }
        }     
        catch(PDOException $exception){  
        redireccionar('/estadosAcciones');
        return $exception->getMessage();      }                    
     
       

        } else {
        $datos = [
            "estadoAccion" => ''
           
        ];

            $this->vista('/estadosAcciones',$datos);


        }
    }
    public function actualizarEstadoAccion(){

        if($_SERVER['REQUEST_METHOD'] == "POST"){

         

            $datos = [
                "id" => $_POST['id'],
                "estadoAccion" => $_POST['estado'],
                "permisos" => $this->permisos 
          
            ];
            try{
            if($this->DatatableEstadosAcciones->actualizarEstadoAccion($datos)){

                redireccionar('/estadosAcciones');
            } else {
                die('Algo salio mal');
            }
        }     
        catch(PDOException $exception){  
        redireccionar('/estadosAcciones');
        return $exception->getMessage();     
     }                    
           
        } else {
        $datos = [
            "id" => '',
            "estadoAccion" => '',
            "permisos" => $this->permisos 
            
        ];
        echo 'No hay post';
          //  $this->vista('/acciones',$datos);
        }
    }    
    public function borrarEstadoAccion(){

        if($_SERVER['REQUEST_METHOD'] == "POST"){

            if( isset($_POST['id']) && $_POST['id'] != ''){

              $datos = [
                "id" => $_POST['id'],
                "permisos" => $this->permisos 
              ];
              try{

              if($this->DatatableEstadosAcciones->borrarEstadoAccion($datos)){
                redireccionar('/estadosAcciones');
              } else {
                die('Algo salio mal');
              }
            }     
            catch(PDOException $exception){  
            redireccionar('/estadosAcciones');
            return $exception->getMessage();                         
         
           }
            } else {
              die('Elige el estado para eliminar');
            }

        } else {
        $datos = [
            "id" => '',
            "estadoAccion" => '',
            "permisos" => $this->permisos           
        ];
            $this->vista('/estadosAcciones',$datos);
        }
    }

}
