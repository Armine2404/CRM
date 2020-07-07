<?php


class ModeloEstadoCliente{

    private $db;

    public function __construct(){

        $this->db = new Base;
    }
    public function obtenerEstadoClienteSelect(){
        $this->db->query('SELECT idEstadoCliente, estadoCliente FROM estados_clientes');

        $resultado = $this->db->registros();

        return $resultado;
    }
    public function obtenerEstadoCliente(){

          $table = "(select * from estados_clientes) temp";
    
        $primaryKey = 'idEstadoCliente';
     
        $columns = array(
            array( 'db' => 'idEstadoCliente', 'dt' => 0 ),       
            array( 'db' => 'estadoCliente',  'dt' => 1 ),          
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

    public function agregarEstadoCliente($datos){

        $this->db->query("insert into estados_clientes (estadoCliente) values (:estadoCliente)");

        // vincular valores
        $this->db->bind(':estadoCliente', $datos['estadoCliente']);
       
        //Ejecutar
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }

    }
    public function actualizarEstadoCliente($datos){
        // print_r($datos);
        $this->db->query('UPDATE estados_clientes SET estadoCliente = :estadoCliente WHERE idEstadoCliente = :id');
        $this->db->bind(':id', $datos['idEstadoCliente']);
        $this->db->bind(':estadoCliente', $datos['estadoCliente']);
        

        //Ejecutar
        if($this->db->execute()){
            return true;

        }else {
            return false;
        }
    }

    public function borrarEstadoCliente($datos){

        $this->db->query("Delete from estados_clientes where idEstadoCliente =".$datos['id']);

        //Ejecutar
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }

    }
}
