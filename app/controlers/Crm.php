<?php


class Crm extends Controlador{



    public function __construct(){
      parent::__construct();
       $this->CrmModelo = $this->modelo('ModeloCrm');
       $this->iniciar();
    }

    public function index(){
      
      $tareas=$this->getTareas();
      $acciones = $this->CrmModelo->obtenerAcciones('');
      $datos = [
          'acciones' => $acciones,
          "permisos" => $this->permisos
      ];
      //print_r($tareas);
      $notifi=[
                  "pendientes" => $tareas['pendientes'],                  
                  "penPorcentaje" => $tareas['penPorcentaje'],
                  "proceso" => $tareas['proceso'],
                  "proPorcentaje" => $tareas['proPorcentaje'],
                  "finalizadas" => $tareas['finalizadas'],
                  "finPorcentaje" => $tareas['finPorcentaje'],
                  "hoy" => $tareas['hoy'],
                  "hoyPorcentaje" => $tareas['hoyPorcentaje'],
                  "nombre" => $tareas['usuario'],
                  "total" => $tareas['total']
                ];
      $datos=array_merge($datos,$notifi);
      $this->vista('crm/crm',$datos);

    }

    public function getAcciones()
    {
        if($_SERVER['REQUEST_METHOD'] == "POST"){

              	if(isset($_POST['idUsuario'])){
              		$idUsuario = $_POST['idUsuario'];
              	} else {
              		$idUsuario = [];
              	}
                if(isset($_POST['idTipoCliente'])){
              		$idTipoCliente = $_POST['idTipoCliente'];
              	} else {
              		$idTipoCliente = [];
              	}
                if(isset($_POST['idTipo'])){
              		$idTipoAccion = $_POST['idTipo'];
                  //echo 'UEEE'.json_encode($idTipoAccion);
              	} else {
              		$idTipoAccion = [];
              	}
                if(isset($_POST['idEstado'])){
              		$idEstadoAccion = $_POST['idEstado'];
              	} else {
              		$idEstadoAccion = [];
              	}

              	//Create sql query on filters
                $anadeSQL = '';
              	if(sizeof($idUsuario) != 0){
              		$i = 0;
              		for($i = 0; $i < sizeof($idUsuario); $i++){
              			if( $i == 0 ){
              				$anadeSQL .= " and ( a.idUsuario= ".$idUsuario[$i]." ";
              			} else {
              				$anadeSQL .= " OR a.idUsuario= ".$idUsuario[$i]." ";
              			}
              		}
                  if( $i > 0 ){
                    $anadeSQL .= " ) ";
                  }
              	}
              	if(sizeof($idTipoCliente) != 0){
              		$i = 0;
              		for($i = 0; $i < sizeof($idTipoCliente); $i++){
              			if( $i == 0 ){
              				$anadeSQL .= " and ( b.idEstadoCliente= ".$idTipoCliente[$i]." ";
              			} else {
              				$anadeSQL .= " OR b.idEstadoCliente= ".$idTipoCliente[$i]." ";
              			}
              		}
                  if( $i > 0 ){
                    $anadeSQL .= " ) ";
                  }
              	}
              	if(sizeof($idTipoAccion) != 0){
              		$i = 0;
              		for($i = 0; $i < sizeof($idTipoAccion); $i++){
              			if( $i == 0 ){
              				$anadeSQL .= " and ( a.idTipoAccion= ".$idTipoAccion[$i]." ";
              			} else {
              				$anadeSQL .= " OR a.idTipoAccion= ".$idTipoAccion[$i]." ";
              			}
              		}
                  if( $i > 0 ){
                    $anadeSQL .= " ) ";
                  }
              	}
              	if(sizeof($idEstadoAccion) != 0){
              		$i = 0;
              		for($i = 0; $i < sizeof($idEstadoAccion); $i++){
              			if( $i == 0 ){
              				$anadeSQL .= " and ( a.idEstadoAccion= ".$idEstadoAccion[$i]." ";
              			} else {
              				$anadeSQL .= " OR a.idEstadoAccion= ".$idEstadoAccion[$i]." ";
              			}
              		}
                  if( $i > 0 ){
                    $anadeSQL .= " ) ";
                  }
              	}


            $acciones = $this->CrmModelo->obtenerAcciones($anadeSQL);
                
            echo json_encode($acciones);
        }

    }
    public function getAccionUpdate()
    {
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $idAccion = $_POST['id'];
        }

        $acciones = $this->CrmModelo->obtenerAccionUpdate($idAccion);

        echo json_encode($acciones);
    }

    public function getClientes()
    {

        $clientes = $this->CrmModelo->obtenerClientes();

        echo json_encode($clientes);
    }

    public function getTareas(){
      $anadeSQL = '';
      //print_r($_POST);
      if($_SERVER['REQUEST_METHOD'] == "POST"){
             if(isset($_POST['idUsuario'])){
              		$idUsuario = $_POST['idUsuario'];
              	} else {
              		$idUsuario = [];
                }  
                
              //Create sql query on filters
          //print_r($idUsuario);
          if(sizeof($idUsuario) != 0){
            $i = 0;
            for($i = 0; $i < sizeof($idUsuario); $i++){
              if( $i == 0 ){
                $anadeSQL .= " and ( idUsuario= ".$idUsuario[$i]." ";
              } else {
                $anadeSQL .= " OR idUsuario= ".$idUsuario[$i]." ";
              }
            }
            if( $i > 0 ){
              $anadeSQL .= " ) ";
            }
          }
              
         }else{
           $añadeSQL=" and ( idUsuario= ".$_SESSION['id_usuario']." )";
         }
         //print_r($añadeSQL);


        // if($_SERVER['REQUEST_METHOD'] == "POST"){
        //     $id = $_POST['idUsuario'];
        // }
        //$this->notificaciones2($anadeSQL);
      //obtener informacion del usuario desde el modelo
      $tareas = $this->CrmModelo->obtenerTareas($anadeSQL);


      $datos = [
          "pendientes" => $tareas->pendientes,
          "penPorcentaje" => $tareas->penPorcentaje,
          "proceso" => $tareas->proceso,
          "proPorcentaje" => $tareas->proPorcentaje,
          "finalizadas" => $tareas->finalizadas,
          "finPorcentaje" => $tareas->finPorcentaje,
          "hoy" => $tareas->hoy,
          "hoyPorcentaje" => $tareas->hoyPorcentaje,
          "nombre" => $tareas->usuario,
          "total" => $tareas->total,
          "permisos" => $this->permisos
      ];

      //$this->vista('includes/navBar',$datos);
      //$this->vista('crm/crm',$datos);
              if(isset($_POST['idUsuario'])){
              		return $datos;
              	} else {
              		$this->vista('crm/crm',$datos);
                } 
      

    }

    public function resetTareas(){
      $anadeSQL = '';
      //print_r($_POST);
      if($_SERVER['REQUEST_METHOD'] == "POST"){
             if(isset($_POST['idUsuario'])){
              		$idUsuario = $_POST['idUsuario'];
              	} else {
              		$idUsuario = [];
                }  
                
              //Create sql query on filters
          //print_r($idUsuario);
          if(sizeof($idUsuario) != 0){
            $i = 0;
            for($i = 0; $i < sizeof($idUsuario); $i++){
              if( $i == 0 ){
                $anadeSQL .= " and ( idUsuario= ".$idUsuario[$i]." ";
              } else {
                $anadeSQL .= " OR idUsuario= ".$idUsuario[$i]." ";
              }
            }
            if( $i > 0 ){
              $anadeSQL .= " ) ";
            }
          }
              
         }else{
           $añadeSQL=" and ( idUsuario= ".$_SESSION['id_usuario']." )";
         }
         //print_r($añadeSQL);


        // if($_SERVER['REQUEST_METHOD'] == "POST"){
        //     $id = $_POST['idUsuario'];
        // }
        //$this->notificaciones2($anadeSQL);
      //obtener informacion del usuario desde el modelo
      $tareas = $this->CrmModelo->obtenerTareas($anadeSQL);


      $datos = [
          "pendientes" => $tareas->pendientes,
          "penPorcentaje" => $tareas->penPorcentaje,
          "proceso" => $tareas->proceso,
          "proPorcentaje" => $tareas->proPorcentaje,
          "finalizadas" => $tareas->finalizadas,
          "finPorcentaje" => $tareas->finPorcentaje,
          "hoy" => $tareas->hoy,
          "hoyPorcentaje" => $tareas->hoyPorcentaje,
          "nombre" => $tareas->usuario,
          "total" => $tareas->total,
          "permisos" => $this->permisos
      ];

      //$this->vista('includes/navBar',$datos);
      //$this->vista('crm/crm',$datos);
      
              	
      echo json_encode($datos);

    }

    public function getHistorico()
    {
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $idCliente=$_POST['idCliente'];
        }

        $historico = $this->CrmModelo->getHistorico($idCliente);

        $salida = '<div class="time-label">'
						.'<span class="bg-danger">'
							.'Hoy'
						.'</span>'
                    .'</div>';

        $cont=0;
		  foreach($historico as $row) {
              $textoEstado="";
              $textoLog="";
              $estado="danger";
             $estadoEvento=$row->idEstadoAccion;
             if($estadoEvento==1){
                 $estado='danger';
                 $textoEstado=' pendiente';
             }else if($estadoEvento==2){
                 $estado='info';
                 $textoEstado=' en proceso';
             }else if($estadoEvento==3){
                 $estado='success';
                 $textoEstado=' finalizada';
             }
            $textoEstado=$row->cabeceraLog.'('.$row->accion.')'.$textoEstado;
			      $salida.='<div>'
						.'<i class="fa fa-envelope bg-'.$estado.'"></i>'

						.'<div class="timeline-item">'
							.'<span class="time"><i class="far fa-clock"></i> '.date_format(date_create($row->fechaLog),"d-m-Y").'</span>'              
							.'<h3 class="timeline-header"><a href="#">'.$textoEstado.'</a></h3>'
                            .'<div class="timeline-body">'                           
              .$textoLog=str_replace("Tarea","Tarea ", str_replace("Fin","<br> Fin ", str_replace("Inicio","<br> Inicio ", str_replace("Estado","<br> Estado ", str_replace("Cliente","<br> Cliente ", str_replace("Tipo Tarea","<br> Tipo Tarea", $row->Log))))))
                                .$textoLog

							.'</div>'
						.'</div>'
					.'</div>';

		}

        $salida.='<div>'
					.'<i class="far fa-clock bg-gray"></i>'
				 .'</div>';

        echo $salida;
    }

    public function getTipoAcciones()
    {

        $tipoAcciones = $this->CrmModelo->obtenerTipoAccion();

        echo json_encode($tipoAcciones);
    }
    public function getTipoCliente()
    {

        $tipoCliente = $this->CrmModelo->obtenerTipoCliente();

        echo json_encode($tipoCliente);
    }
    public function getUsuario()
    {

        $usuario = $this->CrmModelo->obtenerUsuario();

        echo json_encode($usuario);
    }

    public function getEstadoAcciones()
    {

        $estadoAcciones = $this->CrmModelo->obtenerEstadoAccion();

        echo json_encode($estadoAcciones);
    }

    public function agregar(){

        if($_SERVER['REQUEST_METHOD'] == "POST"){

            date_default_timezone_set("Europe/Madrid");
            if( isset($_POST['idCliente']) && $_POST['idCliente'] != ''){
              $idCliente = $_POST['idCliente'];
            } else {
              $idCliente = 'NULL';
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
                "idUsuario" => trim($_POST['idUsuario']),
                "idCliente" => $idCliente,
                "idTipoAccion" => trim($_POST['idTipoAccion']),
                "idEstadoAccion" => trim($_POST['idEstadoAccion']),
                "accion" => trim($_POST['accion']),
                "created" => $fecha_actual,
                "start" => $start,
                "end" => $end,
                "log" =>"Nueva Tarea:",
                "permisos" => $this->permisos
            ];                      
            if($this->CrmModelo->agregarAccion($datos)){    
              $datosUsuario = $this->CrmModelo->getmail($_POST['idUsuario']);     
                  
              require 'Email.php';
              
                redireccionar('/crm');
            } else {
                die('Algo salio mal');
            }


        } else {
            $datos = [
                "idUsuario" =>"",
                "idCliente" =>"",
                "idTipoAccion" =>"",
                "idEstadoAccion" =>"",
                "accion" =>"",
                "created" =>"",
                "start" =>"",
                "end" => "",
                "done" =>"",
                "log" =>"Nueva Tarea:",
                "permisos" => $this->permisos
            ];

            $this->vista('crm/crm',$datos);


        }
    }

    public function updateAccionResize(){
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            date_default_timezone_set("Europe/Madrid");
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
            if( isset($_POST['log']) && $_POST['log'] ==0){
              $log = "Cambio hora tarea";
            } else {
              $log = "Cambio día tarea";
            }
            $datos = [
                "idEvento" => trim($_POST['id']),
                "idUsuario" => trim($_POST['idUsuario']),
                "accion" => trim($_POST['title']),
                "created" => $fecha_actual,
                "start" => $start,
                "end" => $end,
                "log" =>$log,
                "permisos" => $this->permisos
            ];
        } else {
            $datos = [
                "idEvento" => "",
                "accion" => "",
                "created" => "",
                "start" => "",
                "end" => "",
                "permisos" => $this->permisos
            ];

            $this->vista('crm/crm',$datos);


        }

      if($this->CrmModelo->updateAccionResize($datos)){
        
          redireccionar('/crm');
      } else {
          die('Algo salio mal');
      }


    }

    public function updateAccion(){
		$pb=[];
		if($_SERVER['REQUEST_METHOD'] == "POST"){
			$pb[]="POST ok";
			$idCliente=(isset($_POST['idCliente']) && !empty($_POST['idCliente']))?$_POST['idCliente']:'NULL';

			$idEstadoAccion=(isset($_POST['idEstadoAccion']) && !empty($_POST['idEstadoAccion']))?$_POST['idEstadoAccion']:'NULL';

			$idTipoAccion=(isset($_POST['idTipoAccion']) && !empty($_POST['idTipoAccion']))?$_POST['idTipoAccion']:'NULL';

      $accion=(isset($_POST['accion']) && !empty($_POST['accion']))?$_POST['accion']:'NULL';
      
      
			$idUsuario=(isset($_POST['idUsuario']) && !empty($_POST['idUsuario']))?$_POST['idUsuario']:'NULL';

			$start=(isset($_POST['start']) && !empty($_POST['start']))?$_POST['start']:'0000-00-00 00:00:00';

			$end=(isset($_POST['end']) && !empty($_POST['end']))?$_POST['end']:'0000-00-00 00:00:00';			

            $datos = [
                "idAccion" => trim($_POST['idAccion']),
                "idUsuario" => $idUsuario,
                "accion" => $accion,   
                "start" => $start, 
                "end" => $end, 
                "idUsuario" => $idUsuario,      
                "idCliente" => $idCliente,
                "idEstadoAccion" => $idEstadoAccion,
                "idTipoAccion" => $idTipoAccion,
                "log" =>"Cambio detalle tarea:",
                "permisos" => $this->permisos
            ];
			
			$control=$this->CrmModelo->updateAccion($datos); 
			if($control==1){
				$pb[]="Update ok";
				$controlSelect=$this->CrmModelo->selectDatosCambioAcccionCliente($datos);
				if(!empty($controlSelect)){
					$pb[]="Select ok";
					$controlInsert=$this->CrmModelo->insertLogCambiosAccionesCliente($datos,$controlSelect);
					if(!empty($controlSelect)){
						$pb[]="Insert Log ok";
					}else{
						$pb[]="Insert Log fail,no sigue el proceso";
					}	
				}else{
					$pb[]="Select fail,no sigue el proceso";
				}				
			}else{
				
				$pb[]="Update fail,no sigue el proceso";
			}			 
		}
		print_r($pb);
    }

    public function addMensajeHistorico(){
        if($_SERVER['REQUEST_METHOD'] == "POST"){

            $datos = [
                "idAccion" => trim($_POST['idAccion']),
                "idUsuario" => trim($_POST['idUsuario']),
                "idCliente" => trim($_POST['idCliente']),
                "mensaje" => trim($_POST['mensaje']),
                "log" =>"Nuevo Mensaje:",
                "permisos" => $this->permisos
            ];
        } else {
            $datos = [
                "idAccion" => "",
                "idUsuario" => "",
                "mensaje" => "",
                "log" =>"",
                "permisos" => $this->permisos
            ];

            $this->vista('crm/crm',$datos);
        }

      if($this->CrmModelo->addMensaje($datos)){
          redireccionar('/crm');
      } else {
          die('Algo salio mal');
      }


    }

    public function deleteAccion(){
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $idAccion=$_POST['idAccion'];

        }

      if($this->CrmModelo->deleteAccion($idAccion)){
        
          redireccionar('/crm');
      } else {
          die('Algo salio mal');
      }


    }

    

}
