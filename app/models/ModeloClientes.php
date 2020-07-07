<?php


class ModeloClientes{

    private $db;

    public function __construct(){
        $this->db = new Base;
    }

    public function obtenerClientesSelect(){
        $this->db->query('SELECT idCliente, denominacion FROM clientes');

        $resultado = $this->db->registros();

        return $resultado;
    }

    public function obtenerClientes(){

          $table = "(select c.idCliente, c.denominacion, c.fechaAlta, c.poblacion,
          c.provincia, c.telefono, c.email, c.direccion, c.cif, c.codigoPostal, c.contacto,
          c.cuentaBancaria, c.facturado, c.objetivo, es.estadoCliente from clientes c 
          LEFT JOIN estados_clientes es on es.idEstadoCliente = c.idEstadoCliente) temp";

        //  echo $table;
        // Table's primary key
        $primaryKey = 'idCliente';
        $columns = array(
            array( 'db' => 'idCliente', 'dt' => 0 ),
            array( 'db' => 'denominacion',  'dt' => 1 ),          
            array( 'db' => 'fechaAlta',  'dt' => 2),
            array( 'db' => 'poblacion',  'dt' => 3),
            array( 'db' => 'provincia',  'dt' => 4),           
            array( 'db' => 'telefono',  'dt' => 5),          
            array( 'db' => 'email',  'dt' => 6),
            array( 'db' => 'direccion',  'dt' => 7),           
            array( 'db' => 'cif',  'dt' => 8),          
            array( 'db' => 'codigoPostal',  'dt' => 9),
            array( 'db' => 'contacto',  'dt' => 10),
            array( 'db' => 'cuentaBancaria',  'dt' => 11),           
            array( 'db' => 'facturado',  'dt' => 12),          
            array( 'db' => 'objetivo',  'dt' => 13),
            array( 'db' => 'estadoCliente',  'dt' => 14)

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
    public function obtenerClienteId($id){
        $this->db->query('SELECT * FROM clientes WHERE idCliente = :id');
        $this->db->bind(':id', $id);

        $fila = $this->db->registro();
        echo json_encode($fila);
    }

    public function agregarCliente($datos){

        $this->db->query("insert into clientes (idEstadoCliente,denominacion,direccion,cif,
         fechaAlta,poblacion, provincia, codigoPostal, telefono, contacto, email,
         cuentaBancaria, facturado, objetivo) values (:idEstadoCliente, :denominacion, :direccion, :cif,
         :fechaAlta, :poblacion, :provincia, :codigoPostal, :telefono, :contacto, :email,
         :cuentaBancaria, :facturado, :objetivo)");

        // vincular valores
        $this->db->bind(':idEstadoCliente', $datos['idEstadoCliente']);
        $this->db->bind(':denominacion', $datos['denominacion']);
        $this->db->bind(':direccion', $datos['direccion']);
        $this->db->bind(':cif', $datos['cif']);
        $this->db->bind(':fechaAlta', $datos['fechaAlta']);
        $this->db->bind(':poblacion', $datos['poblacion']);
        $this->db->bind(':provincia', $datos['provincia']);
        $this->db->bind(':codigoPostal', $datos['codigoPostal']);
        $this->db->bind(':telefono', $datos['telefono']);
        $this->db->bind(':contacto', $datos['contacto']);
        $this->db->bind(':email', $datos['email']);
        $this->db->bind(':cuentaBancaria', $datos['cuentaBancaria']);
        $this->db->bind(':facturado', $datos['facturado']);
        $this->db->bind(':objetivo', $datos['objetivo']);

        //Ejecutar
        if($this->db->execute()){
            // $resultado = $this->db->lastInsertId();
            // return $resultado;
            return true;
        } else {
            return false;
        }

    }

    public function actualizarCliente($datos){

        $this->db->query('UPDATE clientes SET idEstadoCliente = :idEstadoCliente, denominacion = :denominacion, direccion = :direccion, cif = :cif,
        fechaAlta = :fechaAlta, poblacion = :poblacion, provincia = :provincia, codigoPostal = :codigoPostal, telefono = :telefono,
        contacto = :contacto, email = :email, cuentaBancaria = :cuentaBancaria, facturado = :facturado, objetivo = :objetivo
        WHERE idCliente = :id');

        $this->db->bind(':id', $datos['id']);
        $this->db->bind(':idEstadoCliente', $datos['idEstadoCliente']);
        $this->db->bind(':denominacion', $datos['denominacion']);
        $this->db->bind(':direccion', $datos['direccion']);
        $this->db->bind(':cif', $datos['cif']);
        $this->db->bind(':fechaAlta', $datos['fechaAlta']);
        $this->db->bind(':poblacion', $datos['poblacion']);
        $this->db->bind(':provincia', $datos['provincia']);
        $this->db->bind(':codigoPostal', $datos['codigoPostal']);
        $this->db->bind(':telefono', $datos['telefono']);
        $this->db->bind(':contacto', $datos['contacto']);
        $this->db->bind(':email', $datos['email']);
        $this->db->bind(':cuentaBancaria', $datos['cuentaBancaria']);
        $this->db->bind(':facturado', $datos['facturado']);
        $this->db->bind(':objetivo', $datos['objetivo']);

        //Ejecutar
        if($this->db->execute()){
            return true;
        }else {
            return false;
        }
    }

    public function actualizarCliente2($datos){
        // $this->db->query('UPDATE clientes SET idEstadoCliente = :idEstadoCliente, denominacion = :denominacion, direccion = :direccion, cif = :cif,
        //   fechaAlta = :fechaAlta,poblacion = :poblacion,provincia = :provincia,codigoPostal = :codigoPostal,telefono = :telefono, contacto =: contacto,
        //   email =:email, cuentaBancaria =:cuentaBancaria, facturado =:facturado, objetivo =:objetivo  WHERE idCliente = :id');

        $this->db->query('UPDATE clientes SET idEstadoCliente = '.$datos['idEstadoCliente'].', denominacion = "'.$datos['denominacion'].'", direccion = "'.$datos['direccion'].'", cif = "'.$datos['cif'].'",
          fechaAlta = "'.$datos['fechaAlta'].'",poblacion = "'.$datos['poblacion'].'",provincia = "'.$datos['provincia'].'",codigoPostal = "'.$datos['codigoPostal'].'",telefono = "'.$datos['telefono'].'",
           contacto = "'.$datos['contacto'].'", email = "'.$datos['email'].'", cuentaBancaria = "'.$datos['cuentaBancaria'].'", facturado = "'.$datos['facturado'].'", objetivo = "'.$datos['objetivo'].'"
            WHERE idCliente = '.$datos['id']);

        // $this->db->bind(':id', $datos['id']);
        // $this->db->bind(':idEstadoCliente', $datos['idEstadoCliente']);
        // $this->db->bind(':denominacion', $datos['denominacion']);
        // $this->db->bind(':direccion', $datos['direccion']);
        // $this->db->bind(':cif', $datos['cif']);
        // $this->db->bind(':fechaAlta', $datos['fechaAlta']);
        // $this->db->bind(':poblacion', $datos['poblacion']);
        // $this->db->bind(':provincia', $datos['provincia']);
        // $this->db->bind(':codigoPostal', $datos['codigoPostal']);
        // $this->db->bind(':telefono', $datos['telefono']);
        // $this->db->bind(':contacto', $datos['contacto']);
        // $this->db->bind(':email', $datos['email']);
        // $this->db->bind(':cuentaBancaria', $datos['cuentaBancaria']);
        // $this->db->bind(':facturado', $datos['facturado']);
        // $this->db->bind(':objetivo', $datos['objetivo']);

        //Ejecutar
        if($this->db->execute()){
            return true;
        }else {
            return false;
        }
    }

    public function borrarCliente($datos){

        $this->db->query("Delete from clientes where idCliente =".$datos['id']);

        //Ejecutar
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }

    }
}
