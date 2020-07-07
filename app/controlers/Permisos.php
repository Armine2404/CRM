<?php


class Permisos extends Controlador
{

    public function __construct()
    {
        parent::__construct();
    }


    public function index()
    {
        // iniciamos session
        $this->iniciar();


        $datos = [
            "permisos" => $this->permisos
        ];


        $this->vista('permisos/permisos', $datos);
    }

    public function actualizarPermisos(){

        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $datos = [
                "administrador"=>[
                    "analisis"=> $_POST['valoresCheck'][0][1],
                    "planificacion"=>$_POST['valoresCheck'][3][1],
                    "clientes"=>$_POST['valoresCheck'][6][1],
                    "agenda"=>$_POST['valoresCheck'][9][1],
                    "acciones"=>$_POST['valoresCheck'][12][1],
                    "config"=>$_POST['valoresCheck'][15][1],
                    "tipoCliente"=>$_POST['valoresCheck'][18][1],
                    "usuarios"=>$_POST['valoresCheck'][21][1],
                    "roles"=>$_POST['valoresCheck'][24][1],
                    "permisos"=>$_POST['valoresCheck'][33][1],
                    "tipoAcciones"=>$_POST['valoresCheck'][27][1],
                    "tiempos"=>$_POST['valoresCheck'][30][1],
                    "buscadorclientes"=>$_POST['valoresCheck'][36][1]
                ],
                "direccion"=>[
                    "analisis"=>$_POST['valoresCheck'][1][1],
                    "planificacion"=>$_POST['valoresCheck'][4][1],
                    "clientes"=>$_POST['valoresCheck'][7][1],
                    "agenda"=>$_POST['valoresCheck'][10][1],
                    "acciones"=>$_POST['valoresCheck'][13][1],
                    "config"=>$_POST['valoresCheck'][16][1],
                    "tipoCliente"=>$_POST['valoresCheck'][19][1],
                    "usuarios"=>$_POST['valoresCheck'][22][1],
                    "roles"=>$_POST['valoresCheck'][25][1],
                    "permisos"=>$_POST['valoresCheck'][34][1],
                    "tipoAcciones"=>$_POST['valoresCheck'][28][1],
                    "tiempos"=>$_POST['valoresCheck'][31][1],
                    "buscadorclientes"=>$_POST['valoresCheck'][37][1]
                ],
                "agente"=>[
                    "analisis"=> $_POST['valoresCheck'][2][1],
                    "planificacion"=>$_POST['valoresCheck'][5][1],
                    "clientes"=>$_POST['valoresCheck'][8][1],
                    "agenda"=>$_POST['valoresCheck'][11][1],
                    "acciones"=>$_POST['valoresCheck'][14][1],
                    "config"=>$_POST['valoresCheck'][17][1],
                    "tipoCliente"=>$_POST['valoresCheck'][20][1],
                    "usuarios"=>$_POST['valoresCheck'][23][1],
                    "roles"=>$_POST['valoresCheck'][26][1],
                    "permisos"=> $_POST['valoresCheck'][35][1],
                    "tipoAcciones"=>$_POST['valoresCheck'][29][1],
                    "tiempos"=>$_POST['valoresCheck'][32][1],
                    "buscadorclientes"=>$_POST['valoresCheck'][38][1]
                ]];
                // escribimos en el json los datos actualizados
                $fh = fopen("../app/config/permisos.json", 'w');
                fwrite($fh, json_encode($datos,JSON_UNESCAPED_UNICODE));
                fclose($fh);        
                echo "Datos actualizados con exito!!";

        }  
       
    }

    
}
