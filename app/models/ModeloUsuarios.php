<?php


class ModeloUsuarios{

    private $db;


    public function __construct(){
        $this->db = new Base;
    }


    public function obtenerUsuariosSelect(){
        $this->db->query('SELECT idUsuario, usuario FROM usuarios');

        $resultado = $this->db->registros();

        return $resultado;
    }

    public function obtenerUsuarioId($id){
      
        $this->db->query('SELECT * FROM usuarios WHERE idUsuario = :id');
        $this->db->bind(':id', $id);

        $fila = $this->db->registro();

        echo json_encode($fila);

    }

    public function obtenerUsuarios(){
        $this->db->query('SELECT * FROM usuarios');

        $resultado = $this->db->registros();

        return $resultado;
    }

    public function agregarUsuario($datos){

        $this->db->query("INSERT INTO usuarios (idRol, usuario, email, pass) VALUES (:idRol, :usuario, :email, :pass)");

        // vincular valores

        $this->db->bind(':idRol', $datos['idRol']);
        $this->db->bind(':usuario', $datos['usuario']);
        $this->db->bind(':email', $datos['email']);
        $this->db->bind(':pass', $datos['pass']);

        //Ejecutar
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }

    }

    public function actualizarUsuario($datos){
        $this->db->query('UPDATE usuarios SET idRol = :idRol, usuario = :usuario, email = :email, pass = :pass WHERE idUsuario = :id');
        $this->db->bind(':idRol', $datos['idRol']);
        $this->db->bind(':usuario', $datos['usuario']);
        $this->db->bind(':email', $datos['email']);
        $this->db->bind(':pass', $datos['pass']);
        $this->db->bind(':id', $datos['idUsuario']);

        //Ejecutar
        if($this->db->execute()){
            return true;
        }else {
            return false;
        }
    }

    public function borrarUsuario($datos){
        $this->db->query('DELETE FROM usuarios WHERE idUsuario = :id');
        $this->db->bind(':id', $datos['id']);

        //Ejecutar
        if($this->db->execute()){
            return true;
        }else {
            return false;
        }
    }

    public function obtenerUsuariosTabla(){

          $table =
         "(select  u.idUsuario, u.idRol, u.usuario, u.email, u.pass,  r.nombreRol from usuarios u 
          left join roles r on u.idRol = r.idRol  ) temp";

        //  echo $table;
        // Table's primary key
        $primaryKey = 'idUsuario';

        // Array of database columns which should be read and sent back to DataTables.
        // The `db` parameter represents the column name in the database, while the `dt`
        // parameter represents the DataTables column identifier. In this case simple
        // indexes
        $columns = array(
            array( 'db' => 'idUsuario', 'dt' => 0 ),
            array( 'db' => 'idRol', 'dt' => 1 ),
            array( 'db' => 'usuario',  'dt' => 2 ),
            array( 'db' => 'email',  'dt' => 3),
            array( 'db' => 'nombreRol',  'dt' => 4),
            array( 'db' => 'pass',  'dt' => 5)
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

}
