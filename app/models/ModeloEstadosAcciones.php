<?php


class ModeloEstadosAcciones{

    private $db;


    public function __construct(){
        $this->db = new Base;
    }


    public function obtenerEstadosAccionesSelect(){
        $this->db->query('SELECT idEstadoAccion, estadoAccion FROM estados_acciones');

        $resultado = $this->db->registros();

        return $resultado;
    }

    public function obtenerEstadosAcciones(){

          $table = "(select * from estados_acciones) temp";

        //  echo $table;
        // Table's primary key
        $primaryKey = 'idEstadoAccion';
        $columns = array(
            array( 'db' => 'idEstadoAccion', 'dt' => 0 ),
            array( 'db' => 'estadoAccion', 'dt' => 1 )

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
    public function agregarEstadoAccion($datos){

        $this->db->query("insert into estados_acciones (estadoAccion) values (:estadoAccion)");

        // vincular valores
        $this->db->bind(':estadoAccion', $datos['estadoAccion']);
       
        //Ejecutar
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }

    }
    public function actualizarEstadoAccion($datos){
        // print_r($datos);
        $this->db->query('UPDATE estados_acciones SET estadoAccion = :estadoAccion WHERE idEstadoAccion = :id');
        $this->db->bind(':id', $datos['id']);
        $this->db->bind(':estadoAccion', $datos['estadoAccion']);
        

        //Ejecutar
        if($this->db->execute()){
            return true;

        }else {
            return false;
        }
    }

    public function borrarEstadoAccion($datos){
    
        $this->db->query("Delete from estados_acciones where idEstadoAccion =".$datos['id']);

        //Ejecutar
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }

    }
}
