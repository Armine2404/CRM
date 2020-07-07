<?php
// clase controlador principal
// se encarga de poder cargra los modelos y las vistas
class Controlador
{

public function __construct()
{
    $this->permisos = $this->permisos();
}

    public function notificaciones($id){
        $this->CrmModelo = $this->modelo('ModeloCrm');
        $id=" and idUsuario=".$id;
        $tareas = $this->CrmModelo->obtenerTareas($id);
        $datos=[
                  "pendientes" => $tareas->pendientes,
                  "penPorcentaje" => $tareas->penPorcentaje,
                  "proceso" => $tareas->proceso,
                  "proPorcentaje" => $tareas->proPorcentaje,
                  "finalizadas" => $tareas->finalizadas,
                  "finPorcentaje" => $tareas->finPorcentaje,
                  "hoy" => $tareas->hoy,
                  "hoyPorcentaje" => $tareas->hoyPorcentaje,
                  "nombre" => $tareas->usuario,
                  "total" => $tareas->total
                ];
        return $datos;
    }

    

    // cargar el modelo
    public function modelo($modelo)
    {
        // carga modelo
        require_once('../app/models/' . $modelo . '.php');
        // instanciamos el modelo
        return new $modelo();
    }
    



    // cargar vista
    public function vista($vista, $datos = [])
    {

        // chequear si el archivo vista existe
        if (file_exists('../app/views/' . $vista . '.php')) {
            require_once('../app/views/' . $vista . '.php');
        } else {
            // si no existe el archivo nos da un mensaje
            die("la vista no existe");
        }
    }

    public function iniciar()
    {
        session_start();
        
        if (!isset($_SESSION['nombre'])) {
                        
            redireccionar('/login');
            unset($_SESSION["timeout"]);
            session_destroy();
        }
        // Comprobar si $_SESSION["timeout"] está establecida
        if (isset($_SESSION["timeout"])) {
            // Calcular el tiempo de vida de la sesión (TTL = Time To Live)
            $sessionTTL = time() - $_SESSION["timeout"];
            if ($sessionTTL > $_SESSION["duracion"]) {
                
                   redireccionar('/login');
                   session_destroy();

            }
        }

        
    }

    public function permisos(){
        $fichero = file_get_contents('../app/config/permisos.json');
        $salida = json_decode($fichero);
        return $salida;
    }
    
    


    public function salir()
    {
        session_unset();
        session_destroy();
    }
}
