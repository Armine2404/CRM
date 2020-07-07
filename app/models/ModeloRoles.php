<?php


class ModeloRoles{

    private $db;

    public function __construct(){
        $this->db = new Base;
    }
    
    public function obtenerRolesSelect(){
        $this->db->query('SELECT idRol, nombreRol FROM roles');

        $resultado = $this->db->registros();

        return $resultado;
    }
    public function obtenerRoles(){     
          $table = "(select * from roles) temp";
        // Table's primary key
        $primaryKey = 'idRol';
        $columns = array(
            array( 'db' => 'idRol', 'dt' => 0 ),
            array( 'db' => 'nombreRol',  'dt' => 1 )         
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
    public function agregarRol($datos){

        $this->db->query("insert into roles (nombreRol) values (:rol)");

        // vincular valores
        $this->db->bind(':rol', $datos['rol']);
       
        //Ejecutar
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }

    }
    public function obtenerClienteId($id){
        $this->db->query('SELECT * FROM usuarios WHERE id_usuario = :id');
        $this->db->bind(':id', $id);

        $fila = $this->db->registro();

        return $fila;
    }
    public function actualizarRol($datos){
        // print_r($datos);
        $this->db->query('UPDATE roles SET nombreRol = :rol WHERE idRol = :id');
        $this->db->bind(':id', $datos['id']);
        $this->db->bind(':rol', $datos['rol']);
        

        //Ejecutar
        if($this->db->execute()){
            return true;

        }else {
            return false;
        }
    }

    public function borrarRol($datos){
    
        $this->db->query("Delete from roles where idRol =".$datos['id']);
        
        //Ejecutar
        if($this->db->execute()){
            return true;
        } 
        else {
            echo "error";
            return false;
        }

    }
}
