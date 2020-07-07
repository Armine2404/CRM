<?php


class ModeloCrm{

    private $db;


    public function __construct(){
        $this->db = new Base;
    }
    public function obtenerTipoCliente()
    {
        $this->db->query('SELECT *  FROM estados_clientes');
        $resultado = $this->db->registros();
        return $resultado;
        }    
 public function obtenerUsuario()
        {
            $this->db->query("SELECT idUsuario, usuario  FROM usuarios");    
            $resultado = $this->db->registros();   
            return $resultado;
            }
    public function obtenerAcciones($where){

        $w = 'WHERE 1 = 1 '.$where;
        $sql = 'SELECT * FROM acciones a left join clientes b on a.idCliente = b.idCliente ';
        $sql .= $w;
        $sql .= ' GROUP BY a.idAccion';
        //echo $sql;
        $this->db->query($sql);

        $resultado = $this->db->registros();
        return $resultado;
    }

    public function obtenerAccionUpdate($idAccion){
        $this->db->query('SELECT * FROM acciones WHERE idAccion='.$idAccion);

        $resultado = $this->db->registros();

        return $resultado;
    }

    public function obtenerTareas($id){
    // echo 'SELECT * FROM num_tareas_usuario WHERE 1=1 '.$id;
      $this->db->query('SELECT * FROM num_tareas_usuario WHERE 1=1 '.$id);
      //$this->db->bind(':id', $id);

      $fila = $this->db->registro();
      //print_r($fila);
      return $fila;
    }

    public function getHistorico($idCliente){
        // $sql='SELECT * FROM log_cliente LEFT JOIN acciones on acciones.idAccion=log_cliente.idActividad WHERE log_cliente.idCliente=';
        // $sql.=$idCliente;
        // $sql.=" group by idLog";2
        $sql = "SELECT * FROM log_cliente LEFT JOIN acciones on acciones.idAccion=log_cliente.idActividad WHERE log_cliente.idCliente = $idCliente group by log_cliente.idLog";
        $this->db->query($sql);

        $resultado = $this->db->registros();


        return $resultado;
    }

    public function obtenerClientes(){
        $this->db->query('SELECT idCliente,denominacion FROM clientes');

        $resultado = $this->db->registros();

        return $resultado;
    }

    public function obtenerTipoAccion(){
        $this->db->query('SELECT idTipoAccion,tipoAccion FROM tipos_acciones');

        $resultado = $this->db->registros();

        return $resultado;
    }

    public function obtenerEstadoAccion(){
        $this->db->query('SELECT idEstadoAccion,estadoAccion FROM estados_acciones');

        $resultado = $this->db->registros();

        return $resultado;
    }

    public function agregarAccion($datos){

        $this->db->query(" INSERT INTO acciones (idUsuario,idCliente,idTipoAccion,idEstadoAccion,accion,created, start, end) VALUES (:idUsuario,:idCliente,:idTipoAccion,:idEstadoAccion,:accion,:created, :start, :end)");

        // vincular valores

        $this->db->bind(':idUsuario', $datos['idUsuario']);
        $this->db->bind(':idCliente', $datos['idCliente']);
        $this->db->bind(':idTipoAccion', $datos['idTipoAccion']);
        $this->db->bind(':idEstadoAccion', $datos['idEstadoAccion']);
        $this->db->bind(':accion', $datos['accion']);
        $this->db->bind(':created', $datos['created']);
        $this->db->bind(':start', $datos['start']);
        $this->db->bind(':end', $datos['end']);

        //Ejecutar
        if($this->db->execute()){
            $this->db->query('SELECT * FROM acciones acc
            left join clientes on clientes.idCliente=acc.idCliente
            left join usuarios on usuarios.idUsuario=acc.idUsuario
            left join estados_acciones on estados_acciones.idEstadoAccion=acc.idEstadoAccion
            left join tipos_acciones on tipos_acciones.idTipoAccion=acc.idTipoAccion
            where acc.idAccion=(SELECT max(a.idAccion) as id FROM acciones a)');

            $ultimaAccion = $this->db->registros();
            //$ultimaAccion=$ultimaAccion[0];
            $log="Cliente: ".$ultimaAccion[0]->denominacion." Tipo Tarea:".$ultimaAccion[0]->tipoAccion." Tarea:".$datos['accion']." Estado:".$ultimaAccion[0]->estadoAccion." Inicio:".$datos['start']." Fin:".$datos['end']." Tarea Creada por:".$ultimaAccion[0]->usuario." el ".$datos['created'];

            $this->db->query(" INSERT INTO log_cliente (idCliente,idActividad,cabeceraLog,log,fechaLog,idusuLogado) VALUES (:idCliente,:idActividad,:cabeceraLog,:log,:fechaLog,:idUsuLogado)");

            $this->db->bind(':idCliente', $datos['idUsuario']);
            $this->db->bind(':idActividad', $ultimaAccion[0]->idAccion);
            $this->db->bind(':cabeceraLog', $datos['log']);
            $this->db->bind(':log', $log);
            $this->db->bind(':fechaLog', $datos['created']);
            $this->db->bind(':idUsuLogado', $datos['idUsuario']);

            $this->db->execute();
            return true;
        } else {
            return false;
        }

    }
    public function getmail($id){
        
        $this->db->query('SELECT * FROM usuarios WHERE idUsuario = :id');
        $this->db->bind(':id', $id);

        $fila = $this->db->registro();
        return $fila;
       
    }

    public function updateAccionResize($datos){

        $this->db->query('UPDATE acciones SET accion=:accion,created=:created,start=:start,end=:end where idAccion=:idAccion');

        // vincular valores

        $this->db->bind(':idAccion', $datos['idEvento']);
        $this->db->bind(':accion', $datos['accion']);
        $this->db->bind(':created', $datos['created']);
        $this->db->bind(':start', $datos['start']);
        $this->db->bind(':end', $datos['end']);

        //Ejecutar
        if($this->db->execute()){
            $this->db->query('SELECT * FROM acciones acc
            left join clientes on clientes.idCliente=acc.idCliente
            left join usuarios on usuarios.idUsuario=acc.idUsuario
            left join estados_acciones on estados_acciones.idEstadoAccion=acc.idEstadoAccion
            left join tipos_acciones on tipos_acciones.idTipoAccion=acc.idTipoAccion
            where acc.idAccion='.$datos['idEvento']);

            $ultimaAccion = $this->db->registros();
            //$ultimaAccion=$ultimaAccion[0];
            $log="Cliente: ".$ultimaAccion[0]->denominacion." Tipo Tarea:".$ultimaAccion[0]->tipoAccion." Tarea:".$datos['accion']." Estado:".$ultimaAccion[0]->estadoAccion." Inicio:".$datos['start']." Fin:".$datos['end']." Tarea Creada por:".$ultimaAccion[0]->usuario." el ".$datos['created'];

            $this->db->query(" INSERT INTO log_cliente (idCliente,idActividad,cabeceraLog,log,fechaLog,idusuLogado) VALUES (:idCliente,:idActividad,:cabeceraLog,:log,:fechaLog,:idUsuLogado)");

            $this->db->bind(':idCliente', $datos['idCliente']);
            $this->db->bind(':idActividad', $ultimaAccion[0]->idAccion);
            $this->db->bind(':cabeceraLog', $datos['log']);
            $this->db->bind(':log', $log);
            $this->db->bind(':fechaLog', $datos['created']);
            $this->db->bind(':idUsuLogado', $datos['idUsuario']);

            $this->db->execute();

            return true;
        } else {
            return false;
        }

    }
	public function insertLogCambiosAccionesCliente($datos,$ultimaAccion){
		
		$log="Cliente: ".$ultimaAccion[0]->denominacion." Tipo Tarea:".$ultimaAccion[0]->tipoAccion." Tarea:".$datos['accion']." Estado:".$ultimaAccion[0]->estadoAccion." Inicio:".$datos['start']." Fin:".$datos['end']." Tarea Creada por:".$ultimaAccion[0]->usuario." el ".$ultimaAccion[0]->created;
		

            $this->db->query(" INSERT INTO log_cliente (idCliente,idActividad,cabeceraLog,log,fechaLog,idusuLogado) VALUES (:idCliente,:idActividad,:cabeceraLog,:log,:fechaLog,:idUsuLogado)");

            $this->db->bind(':idCliente', $datos['idCliente']);
            $this->db->bind(':idActividad', $ultimaAccion[0]->idAccion);
            $this->db->bind(':cabeceraLog', $datos['log']);
            $this->db->bind(':log', $log);
            $this->db->bind(':fechaLog', $ultimaAccion[0]->created);
            $this->db->bind(':idUsuLogado', $datos['idUsuario']);

            $salida=($this->db->execute())? "Insert correcto":"Fallo Insert";
			return $salida;
		
	}
	
	public function selectDatosCambioAcccionCliente($datos){
		$this->db->query('SELECT * FROM acciones acc
            left join clientes on clientes.idCliente=acc.idCliente
            left join usuarios on usuarios.idUsuario=acc.idUsuario
            left join estados_acciones on estados_acciones.idEstadoAccion=acc.idEstadoAccion
            left join tipos_acciones on tipos_acciones.idTipoAccion=acc.idTipoAccion
            where acc.idAccion='.$datos['idAccion']);

            $ultimaAccion = $this->db->registros();
		
		return $ultimaAccion;
		
	
	}
    public function updateAccion($datos){

        $this->db->query('UPDATE acciones SET accion=:accion, start = :start, end = :end, idTipoAccion=:idTipoAccion, idUsuario = :idUsuario, idEstadoAccion=:idEstadoAccion,idCliente=:idCliente where idAccion=:idAccion');
       
        // vincular valores

        $this->db->bind(':idAccion', $datos['idAccion']);
        $this->db->bind(':idUsuario', $datos['idUsuario']);
        $this->db->bind(':accion', $datos['accion']);
        $this->db->bind(':start', $datos['start']);
        $this->db->bind(':end', $datos['end']);
        $this->db->bind(':idTipoAccion', $datos['idTipoAccion']);
        $this->db->bind(':idEstadoAccion', $datos['idEstadoAccion']);
        $this->db->bind(':idCliente', $datos['idCliente']);
        //Ejecutar
        if($this->db->execute()){ 			
            return true;
        } else {
            return false;
        }
    }
	

    public function addMensaje($datos){

        $this->db->query(" INSERT INTO log_cliente (idCliente,idActividad,cabeceraLog,log,fechaLog,idusuLogado) VALUES (:idCliente,:idActividad,:cabeceraLog,:log,:fechaLog,:idUsuLogado)");

        $this->db->bind(':idCliente', $datos['idCliente']);
        $this->db->bind(':idActividad', $datos['idAccion']);
        $this->db->bind(':cabeceraLog',"Mensaje:");
        $this->db->bind(':log', $datos['mensaje']);
        $this->db->bind(':fechaLog', date('Y-m-d'));
        $this->db->bind(':idUsuLogado', $datos['idUsuario']);

        //Ejecutar
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }

    }

    public function deleteAccion($idAccion){
         $this->db->query('SELECT * FROM acciones acc
        left join clientes on clientes.idCliente=acc.idCliente
        left join usuarios on usuarios.idUsuario=acc.idUsuario
        left join estados_acciones on estados_acciones.idEstadoAccion=acc.idEstadoAccion
        left join tipos_acciones on tipos_acciones.idTipoAccion=acc.idTipoAccion
        where acc.idAccion='.$idAccion);

        $datosAccion = $this->db->registros();

        $log="Cliente: ".$datosAccion[0]->denominacion." Tipo Tarea:".$datosAccion[0]->tipoAccion." Tarea:".$datosAccion[0]->accion." Estado:".$datosAccion[0]->estadoAccion." Inicio:".$datosAccion[0]->start." Fin:".$datosAccion[0]->end." Tarea Eliminada por:".$datosAccion[0]->usuario." el ".$datosAccion[0]->created;

        $this->db->query(" INSERT INTO log_cliente (idCliente,idActividad,cabeceraLog,log,fechaLog,idusuLogado) VALUES (:idCliente,:idActividad,:cabeceraLog,:log,:fechaLog,:idUsuLogado)");

            $this->db->bind(':idCliente', $datosAccion[0]->idCliente);
            $this->db->bind(':idActividad',$idAccion);
            $this->db->bind(':cabeceraLog',"Tarea Eliminada:");
            $this->db->bind(':log', $log);
            $this->db->bind(':fechaLog', $datosAccion[0]->created);
            $this->db->bind(':idUsuLogado', $datosAccion[0]->idUsuario);

        if($this->db->execute()){
            $this->db->query('DELETE FROM acciones WHERE idAccion = :id');
            $this->db->bind(':id', $idAccion);


            //Ejecutar
            if($this->db->execute()){
                return true;

            }else {
                return false;
            }
        }else{
            return false;
        }

    }

}
