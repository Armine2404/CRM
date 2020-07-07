<?php


class Analisis extends Controlador
{



    public function __construct()
    {
      parent::__construct();
        $this->ModAnalisis = $this->modelo('ModeloAnalisis');
        $this->iniciar();

    }
    //Crear modelo y vista ruta: ur./nombrecontrolador/funcion/parametro consulta al modelo
    //
    //LLamar a funcion ss clientes
    // en func clientes require al modelo (fichero que manda los datos)

    public function index()
    {


        $this->vista('analisis/analisisClientes');
        // if(!isset($_SESSION['autorizado']) || $_SESSION['autorizado'] != 1){
        //   redireccionar('/login');
        // } else {
        // }
    }

    public function analisisClientes()
    {

        $this->vista('analisis/analisisClientes');
    }

    public function analisisAgenda()
    {

        $this->vista('analisis/analisisAgenda');
    }

    public function analisisHistorico()
    {
        $this->vista('analisis/analisisHistorico');
    }

    public function getAnalisisClientes()
    {
        $añadeSQL=' WHERE 1=1 ';
        $añadeSQLFecha = '';
        $arr = array();


        if(isset($_POST['fecha']) && $_POST['fecha'] != ''){
          $fecha = $_POST['fecha'];
          $thisYear = date('Y', strtotime($_POST['fecha']));
          $thisMonth = date('m', strtotime($_POST['fecha']));
          $thisDay = date('d', strtotime($_POST['fecha']));
          $pastYear = date('Y', strtotime($_POST['fecha']." -1 day"));
          $pastMonth = date('m', strtotime($_POST['fecha']." -1 day"));
          $pastDay = date('d', strtotime($_POST['fecha']." -1 day"));
          $pastYear2 = date('Y', strtotime($_POST['fecha']." -2 day"));
          $pastMonth2 = date('m', strtotime($_POST['fecha']." -2 day"));
          $pastDay2 = date('d', strtotime($_POST['fecha']." -2 day"));
          $pastYear3 = date('Y', strtotime($_POST['fecha']." -3 day"));
          $pastMonth3 = date('m', strtotime($_POST['fecha']." -3 day"));
          $pastDay3 = date('d', strtotime($_POST['fecha']." -3 day"));
          $pastYear4 = date('Y', strtotime($_POST['fecha']." -4 day"));
          $pastMonth4 = date('m', strtotime($_POST['fecha']." -4 day"));
          $pastDay4 = date('d', strtotime($_POST['fecha']." -4 day"));
          $pastYear5 = date('Y', strtotime($_POST['fecha']." -5 day"));
          $pastMonth5 = date('m', strtotime($_POST['fecha']." -5 day"));
          $pastDay5 = date('d', strtotime($_POST['fecha']." -5 day"));
          $futureYear = date('Y', strtotime($_POST['fecha']." +1 day"));
          $futureMonth = date('m', strtotime($_POST['fecha']." +1 day"));
          $futureDay = date('d', strtotime($_POST['fecha']." +1 day"));
          $futureYear2 = date('Y', strtotime($_POST['fecha']." +2 day"));
          $futureMonth2 = date('m', strtotime($_POST['fecha']." +2 day"));
          $futureDay2 = date('d', strtotime($_POST['fecha']." +2 day"));
          $futureYear3 = date('Y', strtotime($_POST['fecha']." +3 day"));
          $futureMonth3 = date('m', strtotime($_POST['fecha']." +3 day"));
          $futureDay3 = date('d', strtotime($_POST['fecha']." +3 day"));
          $futureYear4 = date('Y', strtotime($_POST['fecha']." +4 day"));
          $futureMonth4 = date('m', strtotime($_POST['fecha']." +4 day"));
          $futureDay4 = date('d', strtotime($_POST['fecha']." +4 day"));
          $futureYear5 = date('Y', strtotime($_POST['fecha']." +5 day"));
          $futureMonth5 = date('m', strtotime($_POST['fecha']." +5 day"));
          $futureDay5 = date('d', strtotime($_POST['fecha']." +5 day"));
          $lastMonth = date('m', strtotime($_POST['fecha']." -1 month"));
          $lastYearMonth = date('Y', strtotime($_POST['fecha']." -1 month"));
        } else {
          $fecha = '';
          $thisYear = date('Y');
          $thisMonth = date('m');
          $thisDay = date('d');
          $pastYear = date('Y', strtotime(" -1 day"));
          $pastMonth = date('m', strtotime(" -1 day"));
          $pastDay = date('d', strtotime(" -1 day"));
          $pastYear2 = date('Y', strtotime(" -2 day"));
          $pastMonth2 = date('m', strtotime(" -2 day"));
          $pastDay2 = date('d', strtotime(" -2 day"));
          $pastYear3 = date('Y', strtotime(" -3 day"));
          $pastMonth3 = date('m', strtotime(" -3 day"));
          $pastDay3 = date('d', strtotime(" -3 day"));
          $pastYear4 = date('Y', strtotime(" -4 day"));
          $pastMonth4 = date('m', strtotime(" -4 day"));
          $pastDay4 = date('d', strtotime(" -4 day"));
          $pastYear5 = date('Y', strtotime(" -5 day"));
          $pastMonth5 = date('m', strtotime(" -5 day"));
          $pastDay5 = date('d', strtotime(" -5 day"));
          $futureYear = date('Y', strtotime(" +1 day"));
          $futureMonth = date('m', strtotime(" +1 day"));
          $futureDay = date('d', strtotime(" +1 day"));
          $futureYear2 = date('Y', strtotime(" +2 day"));
          $futureMonth2 = date('m', strtotime(" +2 day"));
          $futureDay2 = date('d', strtotime(" +2 day"));
          $futureYear3 = date('Y', strtotime(" +3 day"));
          $futureMonth3 = date('m', strtotime(" +3 day"));
          $futureDay3 = date('d', strtotime(" +3 day"));
          $futureYear4 = date('Y', strtotime(" +4 day"));
          $futureMonth4 = date('m', strtotime(" +4 day"));
          $futureDay4 = date('d', strtotime(" +4 day"));
          $futureYear5 = date('Y', strtotime(" +5 day"));
          $futureMonth5 = date('m', strtotime(" +5 day"));
          $futureDay5 = date('d', strtotime(" +5 day"));
          $lastMonth = date('m', strtotime(" -1 month"));
          $lastYearMonth = date('Y', strtotime(" -1 month"));
        }

        if(isset($_POST['clientes'])){
          $idCliente = $_POST['clientes'];
        } else {
          $idCliente = [];
        }
        if(isset($_POST['estados'])){
          $idEstadoCliente = $_POST['estados'];
        } else {
          $idEstadoCliente = [];
        }

        if(sizeof($idCliente) != 0){

          $añadeSQL .= ' and (';
          $i = 0;
          for($i = 0; $i < sizeof($idCliente); $i++){
            if( $i == 0 ){
              $añadeSQL .= " a.idCliente= ".$idCliente[$i]." ";
            } else {
              $añadeSQL .= " OR a.idCliente= ".$idCliente[$i]." ";
            }
          }
          $añadeSQL .= ')';
        }
        if(sizeof($idEstadoCliente) != 0){

          $añadeSQL .= ' and (';
          $i = 0;
          for($i = 0; $i < sizeof($idEstadoCliente); $i++){
            if( $i == 0 ){
              $añadeSQL .= " a.idEstadoCliente= ".$idEstadoCliente[$i]." ";
            } else {
              $añadeSQL .= " OR a.idEstadoCliente= ".$idEstadoCliente[$i]." ";
            }
          }
          $añadeSQL .= ')';
        }

        $salida = '{"cols":[{"id":"","label":"Estado","type":"string"},
        {"id":"","label":"'.$thisYear.'", "type":"number"},
        {"id":"","label":"'.$pastYear.'", "type":"number"},
        {"id":"","label":"'.$thisDay.'-'.$thisMonth.'-'.$thisYear.'", "type":"number"},
        {"id":"","label":"'.$pastDay.'-'.$pastMonth.'-'.$pastYear.'", "type":"number"},
        {"id":"","label":"'.$thisMonth.'-'.$thisYear.'", "type":"number"},
        {"id":"","label":"'.$lastMonth.'-'.$lastYearMonth.'", "type":"number"}],"rows":[';

        $datos = [
            "add" => $añadeSQL,
            "date" => $fecha
        ];

        $res = $this->ModAnalisis->getAnalisisClientes($datos);

        $j = 0;
        $hayResultado = false;
        foreach ($res as $row) {

            $row = (array) $row;
          $estadosClientes[$row['estado']] = [ $row['clients_past_year'], $row['clients_this_year'], $row['clients_yesterday5'], $row['clients_yesterday4'],
                 $row['clients_yesterday3'],$row['clients_yesterday2'], $row['clients_yesterday'], $row['clients_today'], $row['clients_tomorrow'],
                $row['clients_tomorrow2'], $row['clients_tomorrow3'], $row['clients_tomorrow4'], $row['clients_tomorrow5'], $row['Ene'], $row['Feb'], $row['Mar'],
               $row['Abr'], $row['May'], $row['Jun'], $row['Jul'], $row['Ago'], $row['Sept'], $row['Oct'], $row['Nov'], $row['Dic'] ];
              $j = $j + 1;
              if($j == 2){
                $hayResultado = true;
              }
        }

        if( $hayResultado == true ){

          $estadosTitulo = [];
          foreach( $estadosClientes as $estado => $clientes){
            array_push($estadosTitulo, $estado);
          }

          $fechas = [ strval($thisYear - 1), strval($thisYear), strval($pastDay5).'-'.strval($pastMonth5) , strval($pastDay4).'-'.strval($pastMonth4)
          ,strval($pastDay3).'-'.strval($pastMonth3) , strval($pastDay2).'-'.strval($pastMonth2), strval($pastDay).'-'.strval($pastMonth), strval($thisDay).'-'.strval($thisMonth),
          strval($futureDay).'-'.strval($futureMonth), strval($futureDay2).'-'.strval($futureMonth2), strval($futureDay3).'-'.strval($futureMonth3),
          strval($futureDay4).'-'.strval($futureMonth4), strval($futureDay5).'-'.strval($futureMonth5), 'Ene', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Ago', 'Sept', 'Oct', 'Nov', 'Dic' ];
          $salida = '{"cols":[{"label":"Fecha","type":"string"},';
          $i = 0;
          foreach( $estadosTitulo as $estadoTitulo ){
            $salida .= '{"label":"'.$estadoTitulo.'","type":"number"},';
          }
          $salida .= '{"label":"Total","type":"number"},{"label":"% AA","type":"number"}';
          $salida .= '],"rows":[';
          $oldTot = 0;
          //echo json_encode($estadosTitulo);
          for( $i = 0; $i < sizeof($estadosClientes[$estadosTitulo[0]]); $i++ ){
            $salida .= '{"c":[{"v":"'.$fechas[$i].'"},';
            $tot = 0;
            $c = 0;
            foreach( $estadosTitulo as $estadoTitulo ){
              if( !isset($estadosClientes[$estadoTitulo][$i]) || $estadosClientes[$estadoTitulo][$i] == NULL || $estadosClientes[$estadoTitulo][$i] == ''){
                $estadosClientes[$estadoTitulo][$i] = 0;
              }
              $salida .= '{"v":"'.$estadosClientes[$estadoTitulo][$i].'"},';

              if( $estadoTitulo != 'FACTURADO' ){
                $tot = $tot + $estadosClientes[$estadoTitulo][$i];
              }
            }
            if( $i == 2 || $i == 13 || $oldTot == 0 ){
              $AAtot = 0;
            } else {
              $AAtot = number_format ((($tot*100)/$oldTot)-100 ,0,".","");
            }
            $salida .= '{"v":"'.$tot.'"},{"v":"'.$AAtot.'"}';
            $salida .= ']},';
            $oldTot = $tot;
          }

        } else if($hayResultado == false){
          $salida = '{"cols":[{"label":"Fecha","type":"string"},{"label":"En progreso","type":"number"},{"label":"Pendiente","type":"number"},{"label":"Finalizado","type":"number"},{"label":"Tiempo","type":"number"},{"label":"Total","type":"number"},{"label":"% AA","type":"number"}],"rows":[{"c":[{"v":"No resultados"},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0}]},{"c":[{"v":"No resultados"},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0}]},{"c":[{"v":"No resultados"},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0}]},{"c":[{"v":"No resultados"},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0}]},
          {"c":[{"v":"No resultados"},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0}]},{"c":[{"v":"No resultados"},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0}]},{"c":[{"v":"No resultados"},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0}]},{"c":[{"v":"No resultados"},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0}]},{"c":[{"v":"No resultados"},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0}]},
          {"c":[{"v":"No resultados"},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0}]},{"c":[{"v":"No resultados"},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0}]},{"c":[{"v":"No resultados"},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0}]},{"c":[{"v":"No resultados"},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0}]},
          {"c":[{"v":"No resultados"},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0}]},{"c":[{"v":"No resultados"},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0}]},{"c":[{"v":"No resultados"},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0}]},{"c":[{"v":"No resultados"},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0}]},
          {"c":[{"v":"No resultados"},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0}]},{"c":[{"v":"No resultados"},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0}]},{"c":[{"v":"No resultados"},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0}]},{"c":[{"v":"No resultados"},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0}]},
          {"c":[{"v":"No resultados"},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0}]},{"c":[{"v":"No resultados"},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0}]},{"c":[{"v":"No resultados"},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0}]},{"c":[{"v":"No resultados"},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0}]},';
        }

        $salida = substr_replace($salida ,"",-1);
        $salida .= ']}';

        echo $salida;
    }

    public function getAnalisisClientesEstados()
    {
        $añadeSQL=' WHERE 1=1 ';
        $añadeSQLFecha = '';
        $arr = array();

        if(isset($_POST['fecha']) && $_POST['fecha'] != ''){
          $fecha = $_POST['fecha'];
          $thisYear = date('Y', strtotime($_POST['fecha']));
          $thisMonth = date('m', strtotime($_POST['fecha']));
          $thisDay = date('d', strtotime($_POST['fecha']));
          $pastYear = date('Y', strtotime($_POST['fecha']." -1 day"));
          $pastMonth = date('m', strtotime($_POST['fecha']." -1 day"));
          $pastDay = date('d', strtotime($_POST['fecha']." -1 day"));
          $lastMonth = date('m', strtotime($_POST['fecha']." -1 month"));
          $lastYearMonth = date('Y', strtotime($_POST['fecha']." -1 month"));
        } else {
          $fecha = '';
          $thisYear = date('Y');
          $thisMonth = date('m');
          $thisDay = date('d');
          $pastYear = date('Y', strtotime(" -1 day"));
          $pastMonth = date('m', strtotime(" -1 day"));
          $pastDay = date('d', strtotime(" -1 day"));
          $lastMonth = date('m', strtotime(" -1 month"));
          $lastYearMonth = date('Y', strtotime(" -1 month"));
        }

        if(isset($_POST['clientes'])){
          $idCliente = $_POST['clientes'];
        } else {
          $idCliente = [];
        }
        if(isset($_POST['estados'])){
          $idEstadoCliente = $_POST['estados'];
        } else {
          $idEstadoCliente = [];
        }

        //Create sql query on filters
        if(sizeof($idCliente) != 0){

          $añadeSQL .= ' and (';
          $i = 0;
          for($i = 0; $i < sizeof($idCliente); $i++){
            if( $i == 0 ){
              $añadeSQL .= " a.idCliente= ".$idCliente[$i]." ";
            } else {
              $añadeSQL .= " OR a.idCliente= ".$idCliente[$i]." ";
            }
          }
          $añadeSQL .= ')';
        }
        if(sizeof($idEstadoCliente) != 0){

          $añadeSQL .= ' and (';
          $i = 0;
          for($i = 0; $i < sizeof($idEstadoCliente); $i++){
            if( $i == 0 ){
              $añadeSQL .= " a.idEstadoCliente= ".$idEstadoCliente[$i]." ";
            } else {
              $añadeSQL .= " OR a.idEstadoCliente= ".$idEstadoCliente[$i]." ";
            }
          }
          $añadeSQL .= ')';
        }

        $salida = '{"cols":[{"id":"","label":"Estado","type":"string"},
        {"id":"","label":"'.$thisYear.'", "type":"number"},
        {"id":"","label":"'.$pastYear.'", "type":"number"},
        {"id":"","label":"'.$thisDay.'-'.$thisMonth.'-'.$thisYear.'", "type":"number"},
        {"id":"","label":"'.$pastDay.'-'.$pastMonth.'-'.$pastYear.'", "type":"number"},
        {"id":"","label":"'.$thisMonth.'-'.$thisYear.'", "type":"number"},
        {"id":"","label":"'.$lastMonth.'-'.$lastYearMonth.'", "type":"number"}],"rows":[';

        $datos = [
            "add" => $añadeSQL,
            "date" => $fecha
        ];

        $res = $this->ModAnalisis->getAnalisisClientesEstados($datos);
        $hayResultado = false;
        if($res){
            foreach ($res as $row) {
            //  echo $row;
              $row = (array) $row;
              $hayResultado = true;
              $salida .= '{"c":[{"v":"'.$row['estado'].'"},{"v":'.$row['clients_this_year'].'},{"v":'.$row['clients_past_year'].'}
              ,{"v":'.$row['clients_today'].'},{"v":'.$row['clients_yesterday'].'},{"v":'.$row['clients_this_month'].'}
              ,{"v":'.$row['clients_past_month'].'}]},';
            }
        }

        if($hayResultado == false){
          $salida .= '{"c":[{"v":"No resultados"},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0}]},';
        }

        $salida = substr_replace($salida ,"",-1);
        $salida .= ']}';

        echo $salida;
    }

    public function getAnalisisAgenda()
    {
        $añadeSQL=' WHERE 1=1 ';
        $añadeSQLFecha = '';
        $arr = array();


        if(isset($_POST['fecha']) && $_POST['fecha'] != ''){
          $fecha = $_POST['fecha'];
          $thisYear = date('Y', strtotime($_POST['fecha']));
          $thisMonth = date('m', strtotime($_POST['fecha']));
          $thisDay = date('d', strtotime($_POST['fecha']));
          $pastYear = date('Y', strtotime($_POST['fecha']." -1 day"));
          $pastMonth = date('m', strtotime($_POST['fecha']." -1 day"));
          $pastDay = date('d', strtotime($_POST['fecha']." -1 day"));
          $pastYear2 = date('Y', strtotime($_POST['fecha']." -2 day"));
          $pastMonth2 = date('m', strtotime($_POST['fecha']." -2 day"));
          $pastDay2 = date('d', strtotime($_POST['fecha']." -2 day"));
          $pastYear3 = date('Y', strtotime($_POST['fecha']." -3 day"));
          $pastMonth3 = date('m', strtotime($_POST['fecha']." -3 day"));
          $pastDay3 = date('d', strtotime($_POST['fecha']." -3 day"));
          $pastYear4 = date('Y', strtotime($_POST['fecha']." -4 day"));
          $pastMonth4 = date('m', strtotime($_POST['fecha']." -4 day"));
          $pastDay4 = date('d', strtotime($_POST['fecha']." -4 day"));
          $pastYear5 = date('Y', strtotime($_POST['fecha']." -5 day"));
          $pastMonth5 = date('m', strtotime($_POST['fecha']." -5 day"));
          $pastDay5 = date('d', strtotime($_POST['fecha']." -5 day"));
          $futureYear = date('Y', strtotime($_POST['fecha']." +1 day"));
          $futureMonth = date('m', strtotime($_POST['fecha']." +1 day"));
          $futureDay = date('d', strtotime($_POST['fecha']." +1 day"));
          $futureYear2 = date('Y', strtotime($_POST['fecha']." +2 day"));
          $futureMonth2 = date('m', strtotime($_POST['fecha']." +2 day"));
          $futureDay2 = date('d', strtotime($_POST['fecha']." +2 day"));
          $futureYear3 = date('Y', strtotime($_POST['fecha']." +3 day"));
          $futureMonth3 = date('m', strtotime($_POST['fecha']." +3 day"));
          $futureDay3 = date('d', strtotime($_POST['fecha']." +3 day"));
          $futureYear4 = date('Y', strtotime($_POST['fecha']." +4 day"));
          $futureMonth4 = date('m', strtotime($_POST['fecha']." +4 day"));
          $futureDay4 = date('d', strtotime($_POST['fecha']." +4 day"));
          $futureYear5 = date('Y', strtotime($_POST['fecha']." +5 day"));
          $futureMonth5 = date('m', strtotime($_POST['fecha']." +5 day"));
          $futureDay5 = date('d', strtotime($_POST['fecha']." +5 day"));
          $lastMonth = date('m', strtotime($_POST['fecha']." -1 month"));
          $lastYearMonth = date('Y', strtotime($_POST['fecha']." -1 month"));
        } else {
          $fecha = '';
          $thisYear = date('Y');
          $thisMonth = date('m');
          $thisDay = date('d');
          $pastYear = date('Y', strtotime(" -1 day"));
          $pastMonth = date('m', strtotime(" -1 day"));
          $pastDay = date('d', strtotime(" -1 day"));
          $pastYear2 = date('Y', strtotime(" -2 day"));
          $pastMonth2 = date('m', strtotime(" -2 day"));
          $pastDay2 = date('d', strtotime(" -2 day"));
          $pastYear3 = date('Y', strtotime(" -3 day"));
          $pastMonth3 = date('m', strtotime(" -3 day"));
          $pastDay3 = date('d', strtotime(" -3 day"));
          $pastYear4 = date('Y', strtotime(" -4 day"));
          $pastMonth4 = date('m', strtotime(" -4 day"));
          $pastDay4 = date('d', strtotime(" -4 day"));
          $pastYear5 = date('Y', strtotime(" -5 day"));
          $pastMonth5 = date('m', strtotime(" -5 day"));
          $pastDay5 = date('d', strtotime(" -5 day"));
          $futureYear = date('Y', strtotime(" +1 day"));
          $futureMonth = date('m', strtotime(" +1 day"));
          $futureDay = date('d', strtotime(" +1 day"));
          $futureYear2 = date('Y', strtotime(" +2 day"));
          $futureMonth2 = date('m', strtotime(" +2 day"));
          $futureDay2 = date('d', strtotime(" +2 day"));
          $futureYear3 = date('Y', strtotime(" +3 day"));
          $futureMonth3 = date('m', strtotime(" +3 day"));
          $futureDay3 = date('d', strtotime(" +3 day"));
          $futureYear4 = date('Y', strtotime(" +4 day"));
          $futureMonth4 = date('m', strtotime(" +4 day"));
          $futureDay4 = date('d', strtotime(" +4 day"));
          $futureYear5 = date('Y', strtotime(" +5 day"));
          $futureMonth5 = date('m', strtotime(" +5 day"));
          $futureDay5 = date('d', strtotime(" +5 day"));
          $lastMonth = date('m', strtotime(" -1 month"));
          $lastYearMonth = date('Y', strtotime(" -1 month"));
        }

        if(isset($_POST['usuarios'])){
          $idUsuario = $_POST['usuarios'];
        } else {
          $idUsuario = [];
        }
        if(isset($_POST['clientes'])){
          $idCliente = $_POST['clientes'];
        } else {
          $idCliente = [];
        }
        if(isset($_POST['estados'])){
          $idEstadoAccion = $_POST['estados'];
        } else {
          $idEstadoAccion = [];
        }
        if(isset($_POST['tipos'])){
          $idTipoAccion = $_POST['tipos'];
        } else {
          $idTipoAccion = [];
        }

        //Create sql query on filters
        if(sizeof($idUsuario) != 0){

          $añadeSQL .= ' and (';
          $i = 0;
          for($i = 0; $i < sizeof($idUsuario); $i++){
            if( $i == 0 ){

              $añadeSQL .= " a.idUsuario= ".$idUsuario[$i]." ";
            } else {
              $añadeSQL .= " OR a.idUsuario= ".$idUsuario[$i]." ";
            }
          }
          $añadeSQL .= ')';
        }
        if(sizeof($idCliente) != 0){

          $añadeSQL .= ' and (';
          $i = 0;
          for($i = 0; $i < sizeof($idCliente); $i++){
            if( $i == 0 ){
              $añadeSQL .= " a.idCliente= ".$idCliente[$i]." ";
            } else {
              $añadeSQL .= " OR a.idCliente= ".$idCliente[$i]." ";
            }
          }
          $añadeSQL .= ')';
        }
        if(sizeof($idEstadoAccion) != 0){

          $añadeSQL .= ' and (';
          $i = 0;
          for($i = 0; $i < sizeof($idEstadoAccion); $i++){
            if( $i == 0 ){
              $añadeSQL .= " a.idEstadoAccion= ".$idEstadoAccion[$i]." ";
            } else {
              $añadeSQL .= " OR a.idEstadoAccion= ".$idEstadoAccion[$i]." ";
            }
          }
          $añadeSQL .= ')';
        }
        if(sizeof($idTipoAccion) != 0){

          $añadeSQL .= ' and (';
          $i = 0;
          for($i = 0; $i < sizeof($idTipoAccion); $i++){
            if( $i == 0 ){
              $añadeSQL .= " a.idTipoAccion= ".$idTipoAccion[$i]." ";
            } else {
              $añadeSQL .= " OR a.idTipoAccion= ".$idTipoAccion[$i]." ";
            }
          }
          $añadeSQL .= ')';
        }
        // if(isset($_POST['fecha']) && $_POST['fecha'] != ''){
        //   $añadeSQL .= " AND YEAR(a.created)= ".$thisYear." AND MONTH(a.created) <= ".$thisMonth." AND DAY(a.created) <= ( CASE WHEN MONTH(a.created) = ".$thisMonth." THEN ".$thisDay." ELSE 31 END )";
        // }

        $salida = '{"cols":[{"id":"","label":"Estado","type":"string"},
        {"id":"","label":"'.$thisYear.'", "type":"number"},
        {"id":"","label":"'.$pastYear.'", "type":"number"},
        {"id":"","label":"'.$thisDay.'-'.$thisMonth.'-'.$thisYear.'", "type":"number"},
        {"id":"","label":"'.$pastDay.'-'.$pastMonth.'-'.$pastYear.'", "type":"number"},
        {"id":"","label":"'.$thisMonth.'-'.$thisYear.'", "type":"number"},
        {"id":"","label":"'.$lastMonth.'-'.$lastYearMonth.'", "type":"number"}],"rows":[';

        $datos = [
            "add" => $añadeSQL,
            "date" => $fecha
        ];

        $res = $this->ModAnalisis->getAnalisisAgenda($datos);

        $j = 0;
        $hayResultado = false;
        foreach ($res as $row) {

            $row = (array) $row;
          $estadosAcciones[$row['estado']] = [ $row['actions_past_year'], $row['actions_this_year'], $row['actions_yesterday5'], $row['actions_yesterday4'],
                 $row['actions_yesterday3'],$row['actions_yesterday2'], $row['actions_yesterday'], $row['actions_today'], $row['actions_tomorrow'],
                $row['actions_tomorrow2'], $row['actions_tomorrow3'], $row['actions_tomorrow4'], $row['actions_tomorrow5'], $row['Ene'], $row['Feb'], $row['Mar'],
               $row['Abr'], $row['May'], $row['Jun'], $row['Jul'], $row['Ago'], $row['Sept'], $row['Oct'], $row['Nov'], $row['Dic'] ];
              $j = $j + 1;
              if($j == 2){
                $hayResultado = true;
              }
        }

        if( $hayResultado == true ){

          $estadosTitulo = [];
          foreach( $estadosAcciones as $estado => $acciones){
            array_push($estadosTitulo, $estado);
          }

          $fechas = [ strval($thisYear - 1), strval($thisYear), strval($pastDay5).'-'.strval($pastMonth5) , strval($pastDay4).'-'.strval($pastMonth4)
          ,strval($pastDay3).'-'.strval($pastMonth3) , strval($pastDay2).'-'.strval($pastMonth2), strval($pastDay).'-'.strval($pastMonth), strval($thisDay).'-'.strval($thisMonth),
          strval($futureDay).'-'.strval($futureMonth), strval($futureDay2).'-'.strval($futureMonth2), strval($futureDay3).'-'.strval($futureMonth3),
          strval($futureDay4).'-'.strval($futureMonth4), strval($futureDay5).'-'.strval($futureMonth5), 'Ene', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Ago', 'Sept', 'Oct', 'Nov', 'Dic' ];
          $salida = '{"cols":[{"label":"Fecha","type":"string"},';
          $i = 0;
          foreach( $estadosTitulo as $estadoTitulo ){
            $salida .= '{"label":"'.$estadoTitulo.'","type":"number"},';

            if($estadoTitulo == 'Pendiente' ){
              $salida .= '{"id":"","role":"style","type":"string"},';
            } else if( $estadoTitulo == 'En progreso' ){
              $salida .= '{"id":"","role":"style","type":"string"},';
            } else if( $estadoTitulo == 'Finalizada' ){
              $salida .= '{"id":"","role":"style","type":"string"},';
            } else if( $estadoTitulo != 'DURACION MEDIA') {
              $salida .= '{"id":"","role":"style","type":"string"},';
            }
          }
          $salida .= '{"label":"Total","type":"number"},{"label":"% AA","type":"number"}';
          $salida .= '],"rows":[';
          $oldTot = 0;
          //echo json_encode($estadosTitulo);
          for( $i = 0; $i < sizeof($estadosAcciones[$estadosTitulo[0]]); $i++ ){
            $salida .= '{"c":[{"v":"'.$fechas[$i].'"},';
            $tot = 0;
            $c = 0;
            foreach( $estadosTitulo as $estadoTitulo ){
              if( !isset($estadosAcciones[$estadoTitulo][$i]) || $estadosAcciones[$estadoTitulo][$i] == NULL || $estadosAcciones[$estadoTitulo][$i] == ''){
                $estadosAcciones[$estadoTitulo][$i] = 0;
              }
              $salida .= '{"v":"'.$estadosAcciones[$estadoTitulo][$i].'"},';

              $color = 'black';
              if($estadoTitulo == 'Pendiente' ){
                $color = '#DD4B39'; //rojo
                $salida .= '{"v":"'.$color.'"},';
              } else if( $estadoTitulo == 'En progreso' ){
                $color = '#FFC107';  //amarillo
                $salida .= '{"v":"'.$color.'"},';
              } else if( $estadoTitulo == 'Finalizada' ){
                $color = '#00A65A'; //verde
                $salida .= '{"v":"'.$color.'"},';
              } else  if( $estadoTitulo != 'DURACION MEDIA'){
                $colors = ['#845EC2', '#C197FF','#00C9A7', '#005B44'];
                $salida .= '{"v":"'.$colors[$c].'"},';
                if( $c < 5 ){
                  $c = $c+1;
                } else {
                  $c = 0;
                }
              }

              if( $estadoTitulo != 'DURACION MEDIA' ){
                $tot = $tot + $estadosAcciones[$estadoTitulo][$i];
              }
            }
            if( $i == 2 || $i == 13 || $oldTot == 0 ){
              $AAtot = 0;
            } else {
              $AAtot = number_format ((($tot*100)/$oldTot)-100 ,0,".","");
            }
            $salida .= '{"v":"'.$tot.'"},{"v":"'.$AAtot.'"}';
            $salida .= ']},';
            $oldTot = $tot;
          }

        } else if($hayResultado == false){
          $salida = '{"cols":[{"label":"Fecha","type":"string"},{"label":"En progreso","type":"number"},{"label":"Pendiente","type":"number"},{"label":"Finalizado","type":"number"},{"label":"Tiempo","type":"number"},{"label":"Total","type":"number"},{"label":"% AA","type":"number"}],"rows":[{"c":[{"v":"No resultados"},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0}]},{"c":[{"v":"No resultados"},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0}]},{"c":[{"v":"No resultados"},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0}]},{"c":[{"v":"No resultados"},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0}]},
          {"c":[{"v":"No resultados"},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0}]},{"c":[{"v":"No resultados"},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0}]},{"c":[{"v":"No resultados"},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0}]},{"c":[{"v":"No resultados"},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0}]},{"c":[{"v":"No resultados"},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0}]},
          {"c":[{"v":"No resultados"},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0}]},{"c":[{"v":"No resultados"},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0}]},{"c":[{"v":"No resultados"},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0}]},{"c":[{"v":"No resultados"},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0}]},
          {"c":[{"v":"No resultados"},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0}]},{"c":[{"v":"No resultados"},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0}]},{"c":[{"v":"No resultados"},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0}]},{"c":[{"v":"No resultados"},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0}]},
          {"c":[{"v":"No resultados"},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0}]},{"c":[{"v":"No resultados"},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0}]},{"c":[{"v":"No resultados"},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0}]},{"c":[{"v":"No resultados"},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0}]},
          {"c":[{"v":"No resultados"},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0}]},{"c":[{"v":"No resultados"},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0}]},{"c":[{"v":"No resultados"},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0}]},{"c":[{"v":"No resultados"},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0}]},';
        }

        $salida = substr_replace($salida ,"",-1);
        $salida .= ']}';

        echo $salida;
    }

    public function getAnalisisAgendaEstados()
    {
        $añadeSQL=' WHERE 1=1 ';
        $añadeSQLFecha = '';
        $arr = array();

        if(isset($_POST['fecha']) && $_POST['fecha'] != ''){
          $fecha = $_POST['fecha'];
          $thisYear = date('Y', strtotime($_POST['fecha']));
          $thisMonth = date('m', strtotime($_POST['fecha']));
          $thisDay = date('d', strtotime($_POST['fecha']));
          $pastYear = date('Y', strtotime($_POST['fecha']." -1 day"));
          $pastMonth = date('m', strtotime($_POST['fecha']." -1 day"));
          $pastDay = date('d', strtotime($_POST['fecha']." -1 day"));
          $lastMonth = date('m', strtotime($_POST['fecha']." -1 month"));
          $lastYearMonth = date('Y', strtotime($_POST['fecha']." -1 month"));
        } else {
          $fecha = '';
          $thisYear = date('Y');
          $thisMonth = date('m');
          $thisDay = date('d');
          $pastYear = date('Y', strtotime(" -1 day"));
          $pastMonth = date('m', strtotime(" -1 day"));
          $pastDay = date('d', strtotime(" -1 day"));
          $lastMonth = date('m', strtotime(" -1 month"));
          $lastYearMonth = date('Y', strtotime(" -1 month"));
        }

        if(isset($_POST['usuarios'])){
          $idUsuario = $_POST['usuarios'];
        } else {
          $idUsuario = [];
        }
        if(isset($_POST['clientes'])){
          $idCliente = $_POST['clientes'];
        } else {
          $idCliente = [];
        }
        if(isset($_POST['estados'])){
          $idEstadoAccion = $_POST['estados'];
        } else {
          $idEstadoAccion = [];
        }
        if(isset($_POST['tipos'])){
          $idTipoAccion = $_POST['tipos'];
        } else {
          $idTipoAccion = [];
        }

        //Create sql query on filters
        if(sizeof($idUsuario) != 0){

          $añadeSQL .= ' and (';
          $i = 0;
          for($i = 0; $i < sizeof($idUsuario); $i++){
            if( $i == 0 ){

              $añadeSQL .= " a.idUsuario= ".$idUsuario[$i]." ";
            } else {
              $añadeSQL .= " OR a.idUsuario= ".$idUsuario[$i]." ";
            }
          }
          $añadeSQL .= ')';
        }
        if(sizeof($idCliente) != 0){

          $añadeSQL .= ' and (';
          $i = 0;
          for($i = 0; $i < sizeof($idCliente); $i++){
            if( $i == 0 ){
              $añadeSQL .= " a.idCliente= ".$idCliente[$i]." ";
            } else {
              $añadeSQL .= " OR a.idCliente= ".$idCliente[$i]." ";
            }
          }
          $añadeSQL .= ')';
        }
        if(sizeof($idEstadoAccion) != 0){

          $añadeSQL .= ' and (';
          $i = 0;
          for($i = 0; $i < sizeof($idEstadoAccion); $i++){
            if( $i == 0 ){
              $añadeSQL .= " a.idEstadoAccion= ".$idEstadoAccion[$i]." ";
            } else {
              $añadeSQL .= " OR a.idEstadoAccion= ".$idEstadoAccion[$i]." ";
            }
          }
          $añadeSQL .= ')';
        }
        if(sizeof($idTipoAccion) != 0){

          $añadeSQL .= ' and (';
          $i = 0;
          for($i = 0; $i < sizeof($idTipoAccion); $i++){
            if( $i == 0 ){
              $añadeSQL .= " a.idTipoAccion= ".$idTipoAccion[$i]." ";
            } else {
              $añadeSQL .= " OR a.idTipoAccion= ".$idTipoAccion[$i]." ";
            }
          }
          $añadeSQL .= ')';
        }
        // if(isset($_POST['fecha']) && $_POST['fecha'] != ''){
        //   $añadeSQL .= " AND YEAR(a.created)= ".$thisYear." AND MONTH(a.created) <= ".$thisMonth." AND DAY(a.created) <= ( CASE WHEN MONTH(a.created) = ".$thisMonth." THEN ".$thisDay." ELSE 31 END )";
        // }

        $salida = '{"cols":[{"id":"","label":"Estado","type":"string"},
        {"id":"","label":"'.$thisYear.'", "type":"number"},
        {"id":"","label":"'.$pastYear.'", "type":"number"},
        {"id":"","label":"'.$thisDay.'-'.$thisMonth.'-'.$thisYear.'", "type":"number"},
        {"id":"","label":"'.$pastDay.'-'.$pastMonth.'-'.$pastYear.'", "type":"number"},
        {"id":"","label":"'.$thisMonth.'-'.$thisYear.'", "type":"number"},
        {"id":"","label":"'.$lastMonth.'-'.$lastYearMonth.'", "type":"number"}],"rows":[';

        $datos = [
            "add" => $añadeSQL,
            "date" => $fecha
        ];

        $res = $this->ModAnalisis->getAnalisisAgendaEstados($datos);
        $hayResultado = false;
        if($res){
            foreach ($res as $row) {
            //  echo $row;
              $row = (array) $row;
              $hayResultado = true;
              $salida .= '{"c":[{"v":"'.$row['estado'].'"},{"v":'.$row['actions_this_year'].'},{"v":'.$row['actions_past_year'].'}
              ,{"v":'.$row['actions_today'].'},{"v":'.$row['actions_yesterday'].'},{"v":'.$row['actions_this_month'].'}
              ,{"v":'.$row['actions_past_month'].'}]},';
            }
        }

        if($hayResultado == false){
          $salida .= '{"c":[{"v":"No resultados"},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0},{"v":0}]},';
        }

        $salida = substr_replace($salida ,"",-1);
        $salida .= ']}';

        echo $salida;
    }

    public function getAnalisisHistorico()
    {

        $datos = $this->ModAnalisis->getAnalisisHistorico();

        echo $datos;
    }

}
