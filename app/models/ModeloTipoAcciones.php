<?php


class ModeloTipoAcciones{

    private $db;


    public function __construct(){
        $this->db = new Base;
    }


    public function obtenerTipoAccionesSelect(){
        $this->db->query('SELECT idTipoAccion, tipoAccion FROM tipos_acciones');

        $resultado = $this->db->registros();

        return $resultado;
    }

    public function obtenerTipoAcciones(){
        $table =
         "(select  idTipoAccion, tipoAccion from tipos_acciones  ) temp";

        //  echo $table;
        // Table's primary key
        $primaryKey = 'idTipoAccion';

        // Array of database columns which should be read and sent back to DataTables.
        // The `db` parameter represents the column name in the database, while the `dt`
        // parameter represents the DataTables column identifier. In this case simple
        // indexes
        $columns = array(
            array( 'db' => 'idTipoAccion', 'dt' => 0 ),
            array( 'db' => 'tipoAccion', 'dt' => 1 )
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
    public function agregarTipoAccion($datos){

        $this->db->query("insert into tipos_acciones (tipoAccion) values (:tipoAccion)");

        // vincular valores
        $this->db->bind(':tipoAccion', $datos['tipoAccion']);
       
        //Ejecutar
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }

    }
    public function actualizarTipoAccion($datos){
        // print_r($datos);
        $this->db->query('UPDATE tipos_acciones SET tipoAccion = :tipo WHERE idTipoAccion = :id');
        $this->db->bind(':id', $datos['id']);
        $this->db->bind(':tipo', $datos['tipo']);
        

        //Ejecutar
        if($this->db->execute()){
            return true;
        }else {
            return false;
        }
    }

    public function borrarTipoAccion($datos){
    
        $this->db->query("Delete from tipos_acciones where idTipoAccion =".$datos['id']);

        //Ejecutar
        if($this->db->execute()){
            return true;
        }
         else {
            return false;
        }

    }
}
