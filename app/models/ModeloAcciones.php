<?php


class ModeloAcciones{

    private $db;


    public function __construct(){
        $this->db = new Base;
    }

    public function obtenerAccionesTabla(){

        // $table= <<<EOT
        // (
        //   select acc.idACCION as id, tip.DESTIPOFORMACION as tipo , area.DESAREA as area ,moda.DESMODALIDAD as modalidad ,acc.NOMBREACCION as nombre ,
        //   acc.DESCRIBEACCION as descripcion from accionesformativas acc left join tipodeaccion tip on acc.CODTIPO = CODTIPOFORMACION
        //   left join areadeformacion area on acc.CODAREA = area.CODAREA left join modalidadesdeacciones moda on acc.CODMODALIDAD = moda.CODMODALIDAD
        //   ) temp
        //   EOT;
        $table = "( select a.idAccion, a.idUsuario, a.idCliente, a.idTipoAccion, a.idEstadoAccion, a.accion, a.created, a.start, a.end, usuarios.usuario,
                    clientes.denominacion, estados_acciones.estadoAccion, tipos_acciones.tipoAccion, ec.estadoCliente from acciones a left join usuarios on a.idUsuario = usuarios.idUsuario
                     left join clientes on a.idCliente = clientes.idCliente left join estados_acciones on a.idEstadoAccion = estados_acciones.idEstadoAccion
                     left join estados_clientes ec on ec.idEstadoCliente = clientes.idEstadoCliente
                     left join tipos_acciones on a.idTipoAccion = tipos_acciones.idTipoAccion ) temp";

        // Table's primary key
        $primaryKey = 'idAccion';

        // Array of database columns which should be read and sent back to DataTables.
        // The `db` parameter represents the column name in the database, while the `dt`
        // parameter represents the DataTables column identifier. In this case simple
        // indexes
        $columns = array(
            array( 'db' => 'idAccion', 'dt' => 0 ),
            array( 'db' => 'idUsuario',  'dt' => 1 ),
            array( 'db' => 'idCliente',  'dt' => 2 ),
            array( 'db' => 'idTipoAccion',  'dt' => 3 ),
            array( 'db' => 'idEstadoAccion',  'dt' => 4 ),
            array( 'db' => 'usuario',  'dt' => 5 ),
            array( 'db' => 'denominacion',  'dt' => 6 ),
            array( 'db' => 'estadoCliente',  'dt' => 7 ),
            array( 'db' => 'tipoAccion',  'dt' => 8 ),
            array( 'db' => 'estadoAccion',  'dt' => 9 ),
            array( 'db' => 'accion',  'dt' => 10 ),
            array( 'db' => 'created',  'dt' => 11,
            'formatter' => function( $d, $row ) {
              if( $d == NULL ){ return ''; }
              else { return date( 'd-m-Y', strtotime($d)); }
              }),
            array( 'db' => 'start',  'dt' => 12,
            'formatter' => function( $d, $row ) {
              if( $d == NULL ){ return ''; }
              else { return date( 'd-m-Y', strtotime($d)); }
              }),
            array( 'db' => 'end',  'dt' => 13,
            'formatter' => function( $d, $row ) {
              if( $d == NULL ){ return ''; }
              else { return date( 'd-m-Y', strtotime($d)); }
              }),
             
        );

        /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
         * If you just want to use the basic configuration for DataTables with PHP
         * server-side, there is no need to edit below this line.
         */


        require( 'ssp.class.php' );
        echo json_encode(
            SSP::simple( $_GET, $table, $primaryKey, $columns )
        );


    }

    public function obtenerAccionId($id){
        $this->db->query('SELECT * FROM acciones WHERE idAccion = :id');
        $this->db->bind(':id', $id);

        $fila = $this->db->registro();

        echo json_encode($fila);

    }

    public function agregarAccion($datos){

        $this->db->query("insert into acciones (idUsuario,idCliente,idTipoAccion,idEstadoAccion,accion,
          created,start,end) values (:idUsuario,:idCliente,:idTipoAccion,:idEstadoAccion,:accion,
            :created,:start,:end)");

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
            return true;
        } else {
            return false;
        }

    }

    public function actualizarAccion($datos){

        $this->db->query('UPDATE acciones SET idUsuario = :idUsuario, idCliente = :idCliente, idTipoAccion = :idTipoAccion, idEstadoAccion = :idEstadoAccion,
          accion = :accion,created = :created,start = :start,end = :end,done = :done WHERE idAccion = :id');
        $this->db->bind(':id', $datos['id']);
        $this->db->bind(':idUsuario', $datos['idUsuario']);
        $this->db->bind(':idCliente', $datos['idCliente']);
        $this->db->bind(':idTipoAccion', $datos['idTipoAccion']);
        $this->db->bind(':idEstadoAccion', $datos['idEstadoAccion']);
        $this->db->bind(':accion', $datos['accion']);
        $this->db->bind(':created', $datos['created']);
        $this->db->bind(':start', $datos['start']);
        $this->db->bind(':end', $datos['end']);
        $this->db->bind(':done', $datos['done']);

        //Ejecutar
        if($this->db->execute()){
            return true;

        }else {
            return false;
        }
    }

    public function borrarAccion($datos){

        $this->db->query("Delete from acciones where idAccion =".$datos['id']);

        //Ejecutar
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }

    }
}
