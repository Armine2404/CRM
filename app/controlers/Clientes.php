<?php

class Clientes extends Controlador
{

    public function __construct()
    {
        parent::__construct();
        $this->DatatableClientes = $this->modelo('ModeloClientes');
        // asignamos permisos
        //$this->permisos = $this->permisos();

    }
    //Crear modelo y vista ruta: ur./nombrecontrolador/funcion/parametro consulta al modelo
    //
    //LLamar a funcion ss clientes
    // en func clientes require al modelo (fichero que manda los datos)

    public function index()
    {
        // iniciamos session
        $this->iniciar();
        // enviamos datos a la vista en el array datos
        $datos = [
            "permisos" => $this->permisos
        ];
        $this->vista('datatable/clientes', $datos);
        // if(!isset($_SESSION['autorizado']) || $_SESSION['autorizado'] != 1){
        //   redireccionar('/login');
        // } else {
        // }
    }

    public function getClientes()
    {
        $clientes = $this->DatatableClientes->obtenerClientes();
        echo $clientes;
    }

    public function getClientesSelect()
    {
        $clientes = $this->DatatableClientes->obtenerClientesSelect();
        echo json_encode($clientes);
    }

    public function agregarCliente()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            //   echo " estado" ;
            echo $_POST['estado'];
            $datos = [
                "idEstadoCliente" => $_POST['estado'],
                "denominacion" => $_POST['denominacion'],
                "direccion" => $_POST['direccion'],
                "cif" => $_POST['cif'],
                "fechaAlta" => $_POST['fechaAlta'],
                "poblacion" => $_POST['poblacion'],
                "provincia" => $_POST['provincia'],
                "codigoPostal" => $_POST['codigoPostal'],
                "telefono" => $_POST['telefono'],
                "contacto" => $_POST['contacto'],
                "email" => $_POST['email'],
                "cuentaBancaria" => $_POST['cuentaBancaria'],
                "facturado" => $_POST['facturado'],
                "objetivo" => $_POST['objetivo'],
                "permisos" => $this->permisos
            ];

            try {
                if ($this->DatatableClientes->agregarCliente($datos)) {
                    redireccionar('/clientes');
                } else {
                    die('Algo salio mal');
                }
            } catch (PDOException $exception) {
                redireccionar('/clientes');
                return $exception->getMessage();
            }
        } else {
            $datos = [
                "idEstadoCliente" => " ",
                "denominacion" => " ",
                "direccion" => " ",
                "cif" => " ",
                "fechaAlta" => " ",
                "poblacion" => " ",
                "provincia" => " ",
                "codigoPostal" => " ",
                "telefono" => " ",
                "contacto" => " ",
                "email" => " ",
                "cuentaBancaria" => " ",
                "facturado" => " ",
                "objetivo" => $_POST['objetivo'],
                "permisos" => $this->permisos

            ];

            $this->vista('/clientes', $datos);
        }
    }

    public function getCliente($id)
    {

        $cliente = $this->DatatableClientes->obtenerClienteId($id);

        $datos = [
            'cliente' => $cliente,
            "permisos" => $this->permisos
        ];

        return $datos;
    }

    public function actualizarCliente()
    {

        if ($_SERVER['REQUEST_METHOD'] == "POST") {


            date_default_timezone_set("Europe/Madrid");
            if (isset($_POST['fechaAlta']) && $_POST['fechaAlta'] != '') {
                $fechaAlta = date('Y-m-d H:i:s', strtotime($_POST['fechaAlta']));
            } else {
                $fechaAlta = "0000-00-00 00:00:00";
            }

            $datos = [
                "id" => $_POST['id'],
                "idEstadoCliente" => $_POST['idEstado'],
                "denominacion" => $_POST['denominacion'],
                "direccion" => $_POST['direccion'],
                "cif" => $_POST['cif'],
                "fechaAlta" => $fechaAlta,
                "poblacion" => $_POST['poblacion'],
                "provincia" => $_POST['provincia'],
                "codigoPostal" => $_POST['codigoPostal'],
                "telefono" => $_POST['telefono'],
                "contacto" => $_POST['contacto'],
                "email" => $_POST['email'],
                "cuentaBancaria" => $_POST['cuentaBancaria'],
                "facturado" => $_POST['facturado'],
                "objetivo" => $_POST['objetivo'],
                "permisos" => $this->permisos
            ];
            try {

                if ($this->DatatableClientes->actualizarCliente($datos)) {
                    redireccionar('/clientes');
                } else {
                    die('Algo salio mal');
                }
            } catch (PDOException $exception) {
                redireccionar('/clientes');
                return $exception->getMessage();
            }
        } else {
            $datos = [
                "id" => " ",
                "idEstadoCliente" => " ",
                "denominacion" => " ",
                "direccion" => " ",
                "cif" => " ",
                "fechaAlta" => " ",
                "poblacion" => " ",
                "provincia" => " ",
                "codigoPostal" => " ",
                "telefono" => " ",
                "contacto" => " ",
                "email" => " ",
                "cuentaBancaria" => " ",
                "facturado" => " ",
                "objetivo" => "",
                "permisos" => $this->permisos

            ];

            $this->vista('/clientes', $datos);
        }
    }
    public function borrarCliente()
    {

        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            if (isset($_POST['id']) && $_POST['id'] != '') {

                $datos = [
                    "id" => $_POST['id'],
                    "permisos" => $this->permisos
                ];
                try {

                    if ($this->DatatableClientes->borrarCliente($datos)) {
                        redireccionar('/clientes');
                    } else {
                        die('Algo salio mal');
                    }
                } catch (PDOException $exception) {
                    redireccionar('/clientes');
                    return $exception->getMessage();
                }
            } else {
                die('Elige el cliente para eliminar');
            }
        } else {

            $datos = [
                "idEstadoCliente" => " ",
                "denominacion" => " ",
                "direccion" => " ",
                "cif" => " ",
                "fechaAlta" => " ",
                "poblacion" => " ",
                "provincia" => " ",
                "codigoPostal" => " ",
                "telefono" => " ",
                "contacto" => " ",
                "email" => " ",
                "cuentaBancaria" => " ",
                "facturado" => " ",
                "objetivo" => "",
                "permisos" => $this->permisos

            ];
            $this->vista('/clientes', $datos);
        }
    }


}
