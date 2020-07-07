<?php


class TipoAcciones extends Controlador
{



    public function __construct()
    {
        parent::__construct();
        $this->DatatableTipoAcciones = $this->modelo('ModeloTipoAcciones');

    }
    //Crear modelo y vista ruta: ur./nombrecontrolador/funcion/parametro consulta al modelo
    //
    //LLamar a funcion ss clientes
    // en func clientes require al modelo (fichero que manda los datos)

    public function index()
    {

        $this->iniciar();

        $this->vista('datatable/tipoAcciones');
        // if(!isset($_SESSION['autorizado']) || $_SESSION['autorizado'] != 1){
        //   redireccionar('/login');
        // } else {
        // }
    }

    public function getTipoAcciones()
    {

        $tipoAcciones = $this->DatatableTipoAcciones->obtenerTipoAcciones();

        echo $tipoAcciones;
    }

    public function getTipoAccionesSelect()
    {

        $tipoAcciones = $this->DatatableTipoAcciones->obtenerTipoAccionesSelect();

        echo json_encode($tipoAcciones);
    }

    public function agregarTipoAccion(){

        if($_SERVER['REQUEST_METHOD'] == "POST"){
               
            $datos = [
                "tipoAccion" => $_POST['tipo'],
                "permisos" => $this->permisos      
            ];
             try{

            if($this->DatatableTipoAcciones->agregarTipoAccion($datos)){
                redireccionar('/tipoAcciones');
            } else {
                die('Algo salio mal');
            }
        }     
        catch(PDOException $exception){  
        redireccionar('/tipoAcciones');
        return $exception->getMessage();                       
     
       }

        } else {
        $datos = [
            "estadoAccion" => ''
           
        ];

            $this->vista('/tipoAcciones',$datos);


        }
    }
    public function actualizarTipoAccion(){

        if($_SERVER['REQUEST_METHOD'] == "POST"){
        
            $datos = [
                "id" => $_POST['id'],
                "tipo" => $_POST['tipo'],
                "permisos" => $this->permisos 
          
            ];
            try{

            if($this->DatatableTipoAcciones->actualizarTipoAccion($datos)){

                redireccionar('/tipoAcciones');
            } else {
                die('Algo salio mal');
            }
        }     
        catch(PDOException $exception){  
        redireccionar('/tipoAcciones');
        return $exception->getMessage();                    
     
       }

        } else {
        $datos = [
            "id" => '',
            "tipo" => '',
            "permisos" => $this->permisos 
            
        ];
        echo 'No hay post';
          //  $this->vista('/acciones',$datos);


        }


    }
    
    public function borrarTipoAccion(){

        if($_SERVER['REQUEST_METHOD'] == "POST"){

            if( isset($_POST['id']) && $_POST['id'] != ''){

              $datos = [
                "id" => $_POST['id'],
                "permisos" => $this->permisos 
              ];
               try{

              if($this->DatatableTipoAcciones->borrarTipoAccion($datos)){
                redireccionar('/tipoAcciones');
              } else {
                die('Algo salio mal');
              }
            }     
            catch(PDOException $exception){  
            redireccionar('/tipoAcciones');
            return $exception->getMessage();                         
         
           }
            } else {
              die('Elige el tipo accion para eliminar');
            }



        } else {
        $datos = [
            "id" => '',
            "tipo" => '',
            "permisos" => $this->permisos 
           
        ];
            $this->vista('/tipoAcciones',$datos);
        }
    }
    public function editarCliente($id){

      $datos = [
          "id_accion" => $id,
          "nombre" => trim($_POST['nombre']),
          "mail" => trim($_POST['mail']),
          "telefono" => trim($_POST['telefono']),
          "permisos" => $this->permisos 
      ];

      if($this->DatatableClientes->actualizarCliente($datos)){
          redireccionar('/paginas');
      } else {
          die('Algo salio mal');
      }


    }

}
