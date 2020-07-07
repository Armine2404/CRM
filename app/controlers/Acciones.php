<?php


class Acciones extends Controlador
{



    public function __construct()
    {
      parent::__construct();
        $this->DatatableAcciones = $this->modelo('ModeloAcciones');

    }

    public function index()
    {

        $this->iniciar();
        
      $datos = [
        "permisos" => $this->permisos
      ];
        $this->vista('datatable/acciones',$datos);
        // if(!isset($_SESSION['autorizado']) || $_SESSION['autorizado'] != 1){
        //   redireccionar('/login');
        // } else {
        // }
    }

    public function getAccionesTabla()
    {

        $acciones = $this->DatatableAcciones->obtenerAccionesTabla();

        echo $acciones;
    }


    public function agregarAccion(){

        if($_SERVER['REQUEST_METHOD'] == "POST"){

            date_default_timezone_set("Europe/Madrid");
            if( isset($_POST['idCliente']) && $_POST['idCliente'] != ''){
              $idCliente = $_POST['idCliente'];
            } else {
              $idCliente = NULL;
            }
            if( isset($_POST['accion']) && $_POST['accion'] != ''){
              $accion = $_POST['accion'];
            } else {
              $accion = '';
            }
            $fecha_actual = date("Y-m-d");
            if( isset($_POST['start']) && $_POST['start'] != ''){
              $start = date('Y-m-d H:i:s', strtotime($_POST['start']));
            } else {
              $start = "0000-00-00 00:00:00";
            }
            if( isset($_POST['end']) && $_POST['end'] != ''){
              $end = date('Y-m-d H:i:s', strtotime($_POST['end']));
            } else {
              $end = "0000-00-00 00:00:00";
            }

            $datos = [
                "idUsuario" => $_POST['idUsuario'],
                "idCliente" => $idCliente,
                "idTipoAccion" => $_POST['idTipoAccion'],
                "idEstadoAccion" => $_POST['idEstadoAccion'],
                "accion" => trim($_POST['accion']),
                "created" => $fecha_actual,
                "start" => $start,
                "end" => $end,
                "permisos" => $this->permisos
            ];
             try{

            if($this->DatatableAcciones->agregarAccion($datos)){
                redireccionar('/acciones');
            } else {
                die('Algo salio mal');
            }
          }     
          catch(PDOException $exception){  
          redireccionar('/acciones');
          return $exception->getMessage();     
         }                    
       
         } 

         else {
        $datos = [
            "idAccion" => '',
            "idUsuario" => '',
            "idCliente" => '',
            "idTipoAccion" => '',
            "idEstadoAccion" => '',
            "accion" => '',
            "created" => '',
            "start" => '',
            "end" => '',
            "permisos" => $this->permisos
        ];

            $this->vista('/acciones',$datos);


        }
    }

    public function getAccion($id)
    {

        $accion = $this->DatatableAcciones->obtenerAccionId($id);

        $datos = [
            'accion' => $accion
        ];

        return $datos;
    }


    public function actualizarAccion(){

        if($_SERVER['REQUEST_METHOD'] == "POST"){

            date_default_timezone_set("Europe/Madrid");
            if( isset($_POST['idCliente']) && $_POST['idCliente'] != ''){
              $idCliente = $_POST['idCliente'];
            } else {
              $idCliente = NULL;
            }
            if( isset($_POST['accion']) && $_POST['accion'] != ''){
              $accion = $_POST['accion'];
            } else {
              $accion = '';
            }
            if( isset($_POST['created']) && $_POST['created'] != ''){
              $created = date('Y-m-d H:i:s', strtotime($_POST['created']));
            } else {
              $created = "0000-00-00 00:00:00";
            }
            if( isset($_POST['start']) && $_POST['start'] != ''){
              $start = date('Y-m-d H:i:s', strtotime($_POST['start']));
            } else {
              $start = "0000-00-00 00:00:00";
            }
            if( isset($_POST['end']) && $_POST['end'] != ''){
              $end = date('Y-m-d H:i:s', strtotime($_POST['end']));
            } else {
              $end = "0000-00-00 00:00:00";
            }
            if( isset($_POST['done']) && $_POST['done'] != ''){
              $done = date('Y-m-d H:i:s', strtotime($_POST['done']));
            } else {
              $done = "0000-00-00 00:00:00";
            }

            $datos = [
                "id" => $_POST['id'],
                "idUsuario" => $_POST['idUsuario'],
                "idCliente" => $idCliente,
                "idTipoAccion" => $_POST['idTipoAccion'],
                "idEstadoAccion" => $_POST['idEstadoAccion'],
                "accion" => trim($_POST['accion']),
                "created" => $created,
                "start" => $start,
                "end" => $end,
                "done" => $done,
                "permisos" => $this->permisos
            ];

            try{

            if($this->DatatableAcciones->actualizarAccion($datos)){

                redireccionar('/acciones');
            } else {
                die('Algo salio mal');
            }
          }     
          catch(PDOException $exception){  
          redireccionar('/acciones');
          return $exception->getMessage();      
        }                    
       
         } 

         else {
        $datos = [
            "idAccion" => '',
            "idUsuario" => '',
            "idCliente" => '',
            "idTipoAccion" => '',
            "idEstadoAccion" => '',
            "accion" => '',
            "created" => '',
            "start" => '',
            "end" => '',
            "done" => '',
            "permisos" => $this->permisos
        ];
        echo 'No hay post';
          //  $this->vista('/acciones',$datos);


        }


    }


    public function borrarAccion(){

        if($_SERVER['REQUEST_METHOD'] == "POST"){

            if( isset($_POST['id']) && $_POST['id'] != ''){

              $datos = [
                "id" => $_POST['id'],
                "permisos" => $this->permisos
              ];
               try{
              if($this->DatatableAcciones->borrarAccion($datos)){
                redireccionar('/acciones');
              } else {
                die('Algo salio mal');
              }
            }     
            catch(PDOException $exception){  
            redireccionar('/acciones');
            return $exception->getMessage();      }                    
         
            
            } else {
              die('Elige la acción para eliminar');
            }
            
           } else {
        $datos = [
            "idAccion" => '',
            "idUsuario" => '',
            "idCliente" => '',
            "idTipoAccion" => '',
            "idEstadoAccion" => '',
            "accion" => '',
            "created" => '',
            "start" => '',
            "end" => '',
            "permisos" => $this->permisos
        ];
            $this->vista('/acciones',$datos);
        }
    }


}
