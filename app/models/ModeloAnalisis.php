<?php


class ModeloAnalisis{

    private $db;


    public function __construct(){
        $this->db = new Base;
    }


    public function getAnalisisClientes($datos){

      if( isset($datos['add']) ){
        $añadeSQL = $datos['add'];
      } else {
        $añadeSQL = '';
      }


      if(isset($_POST['fecha']) && $_POST['fecha'] != ''){
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
      } else {
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
      }

      $sql = "SELECT d.estadoCliente as estado
              ,count( case when year(a.fechaAlta) = $thisYear then a.idCliente else NULL end ) as clients_this_year
              ,count( case when year(a.fechaAlta) = ($thisYear - 1 ) then a.idCliente else NULL end ) as clients_past_year
              ,count( case when year(a.fechaAlta) = $thisYear AND month(a.fechaAlta) = $thisMonth AND day(a.fechaAlta) = $thisDay then a.idCliente else NULL end ) as clients_today
              ,count( case when year(a.fechaAlta) = $pastYear AND month(a.fechaAlta) = $pastMonth AND day(a.fechaAlta) = $pastDay then a.idCliente else NULL end ) as clients_yesterday
              ,count( case when year(a.fechaAlta) = $pastYear2 AND month(a.fechaAlta) = $pastMonth2 AND day(a.fechaAlta) = $pastDay2 then a.idCliente else NULL end ) as clients_yesterday2
              ,count( case when year(a.fechaAlta) = $pastYear3 AND month(a.fechaAlta) = $pastMonth3 AND day(a.fechaAlta) = $pastDay3 then a.idCliente else NULL end ) as clients_yesterday3
              ,count( case when year(a.fechaAlta) = $pastYear3 AND month(a.fechaAlta) = $pastMonth3 AND day(a.fechaAlta) = $pastDay4 then a.idCliente else NULL end ) as clients_yesterday4
              ,count( case when year(a.fechaAlta) = $pastYear3 AND month(a.fechaAlta) = $pastMonth3 AND day(a.fechaAlta) = $pastDay5 then a.idCliente else NULL end ) as clients_yesterday5
              ,count( case when year(a.fechaAlta) = $futureYear AND month(a.fechaAlta) = $futureMonth AND day(a.fechaAlta) = $futureDay then a.idCliente else NULL end ) as clients_tomorrow
              ,count( case when year(a.fechaAlta) = $futureYear2 AND month(a.fechaAlta) = $futureMonth2 AND day(a.fechaAlta) = $futureDay2 then a.idCliente else NULL end ) as clients_tomorrow2
              ,count( case when year(a.fechaAlta) = $futureYear3 AND month(a.fechaAlta) = $futureMonth3 AND day(a.fechaAlta) = $futureDay3 then a.idCliente else NULL end ) as clients_tomorrow3
              ,count( case when year(a.fechaAlta) = $futureYear3 AND month(a.fechaAlta) = $futureMonth3 AND day(a.fechaAlta) = $futureDay4 then a.idCliente else NULL end ) as clients_tomorrow4
              ,count( case when year(a.fechaAlta) = $futureYear3 AND month(a.fechaAlta) = $futureMonth3 AND day(a.fechaAlta) = $futureDay5 then a.idCliente else NULL end ) as clients_tomorrow5
              ,count( case when year(a.fechaAlta) = $thisYear AND month(a.fechaAlta) = 1 then a.idCliente else NULL end ) as Ene
              ,count( case when year(a.fechaAlta) = $thisYear AND month(a.fechaAlta) = 2 then a.idCliente else NULL end ) as Feb
              ,count( case when year(a.fechaAlta) = $thisYear AND month(a.fechaAlta) = 3 then a.idCliente else NULL end ) as Mar
              ,count( case when year(a.fechaAlta) = $thisYear AND month(a.fechaAlta) = 4 then a.idCliente else NULL end ) as Abr
              ,count( case when year(a.fechaAlta) = $thisYear AND month(a.fechaAlta) = 5 then a.idCliente else NULL end ) as May
              ,count( case when year(a.fechaAlta) = $thisYear AND month(a.fechaAlta) = 6 then a.idCliente else NULL end ) as Jun
              ,count( case when year(a.fechaAlta) = $thisYear AND month(a.fechaAlta) = 7 then a.idCliente else NULL end ) as Jul
              ,count( case when year(a.fechaAlta) = $thisYear AND month(a.fechaAlta) = 8 then a.idCliente else NULL end ) as Ago
              ,count( case when year(a.fechaAlta) = $thisYear AND month(a.fechaAlta) = 9 then a.idCliente else NULL end ) as Sept
              ,count( case when year(a.fechaAlta) = $thisYear AND month(a.fechaAlta) = 10 then a.idCliente else NULL end ) as Oct
              ,count( case when year(a.fechaAlta) = $thisYear AND month(a.fechaAlta) = 11 then a.idCliente else NULL end ) as Nov
              ,count( case when year(a.fechaAlta) = $thisYear AND month(a.fechaAlta) = 12 then a.idCliente else NULL end ) as Dic
        FROM clientes a
        LEFT JOIN estados_clientes d on a.idEstadoCliente = d.idEstadoCliente
        $añadeSQL
        GROUP BY estadoCliente
        union
        SELECT  'FACTURADO'
                ,sum( case when year(a.fechaAlta) = $thisYear  then a.facturado else 0 end ) as clients_this_year
                ,sum( case when year(a.fechaAlta) = ($thisYear - 1 )  then a.facturado else 0 end ) as clients_past_year
                ,sum( case when year(a.fechaAlta) = $thisYear AND month(a.fechaAlta) = $thisMonth AND day(a.fechaAlta) = $thisDay  then a.facturado else 0 end ) as clients_today
                ,sum( case when year(a.fechaAlta) = $pastYear AND month(a.fechaAlta) = $pastMonth AND day(a.fechaAlta) = $pastDay  then a.facturado else 0 end ) as clients_yesterday
                ,sum( case when year(a.fechaAlta) = $pastYear2 AND month(a.fechaAlta) = $pastMonth2 AND day(a.fechaAlta) = $pastDay2  then a.facturado else 0 end ) as clients_yesterday2
                ,sum( case when year(a.fechaAlta) = $pastYear3 AND month(a.fechaAlta) = $pastMonth3 AND day(a.fechaAlta) = $pastDay3  then a.facturado else 0 end ) as clients_yesterday3
                ,sum( case when year(a.fechaAlta) = $pastYear3 AND month(a.fechaAlta) = $pastMonth3 AND day(a.fechaAlta) = $pastDay4  then a.facturado else 0 end ) as clients_yesterday4
                ,sum( case when year(a.fechaAlta) = $pastYear3 AND month(a.fechaAlta) = $pastMonth3 AND day(a.fechaAlta) = $pastDay5  then a.facturado else 0 end ) as clients_yesterday5
                ,sum( case when year(a.fechaAlta) = $futureYear AND month(a.fechaAlta) = $futureMonth AND day(a.fechaAlta) = $futureDay  then a.facturado else 0 end ) as clients_tomorrow
                ,sum( case when year(a.fechaAlta) = $futureYear2 AND month(a.fechaAlta) = $futureMonth2 AND day(a.fechaAlta) = $futureDay2  then a.facturado else 0 end ) as clients_tomorrow2
                ,sum( case when year(a.fechaAlta) = $futureYear3 AND month(a.fechaAlta) = $futureMonth3 AND day(a.fechaAlta) = $futureDay3  then a.facturado else 0 end ) as clients_tomorrow3
                ,sum( case when year(a.fechaAlta) = $futureYear3 AND month(a.fechaAlta) = $futureMonth3 AND day(a.fechaAlta) = $futureDay4  then a.facturado else 0 end ) as clients_tomorrow4
                ,sum( case when year(a.fechaAlta) = $futureYear3 AND month(a.fechaAlta) = $futureMonth3 AND day(a.fechaAlta) = $futureDay5  then a.facturado else 0 end ) as clients_tomorrow5
                ,sum( case when year(a.fechaAlta) = $thisYear AND month(a.fechaAlta) = 1  then a.facturado else 0 end ) as Ene
                ,sum( case when year(a.fechaAlta) = $thisYear AND month(a.fechaAlta) = 2  then a.facturado else 0 end ) as Feb
                ,sum( case when year(a.fechaAlta) = $thisYear AND month(a.fechaAlta) = 3  then a.facturado else 0 end ) as Mar
                ,sum( case when year(a.fechaAlta) = $thisYear AND month(a.fechaAlta) = 4  then a.facturado else 0 end ) as Abr
                ,sum( case when year(a.fechaAlta) = $thisYear AND month(a.fechaAlta) = 5  then a.facturado else 0 end ) as May
                ,sum( case when year(a.fechaAlta) = $thisYear AND month(a.fechaAlta) = 6  then a.facturado else 0 end ) as Jun
                ,sum( case when year(a.fechaAlta) = $thisYear AND month(a.fechaAlta) = 7  then a.facturado else 0 end ) as Jul
                ,sum( case when year(a.fechaAlta) = $thisYear AND month(a.fechaAlta) = 8  then a.facturado else 0 end ) as Ago
                ,sum( case when year(a.fechaAlta) = $thisYear AND month(a.fechaAlta) = 9  then a.facturado else 0 end ) as Sept
                ,sum( case when year(a.fechaAlta) = $thisYear AND month(a.fechaAlta) = 10  then a.facturado else 0 end ) as Oct
                ,sum( case when year(a.fechaAlta) = $thisYear AND month(a.fechaAlta) = 11  then a.facturado else 0 end ) as Nov
                ,sum( case when year(a.fechaAlta) = $thisYear AND month(a.fechaAlta) = 12  then a.facturado else 0 end ) as Dic
        FROM clientes a
        $añadeSQL
        union
        SELECT  'OBJETIVO'
                ,sum( case when year(a.fechaAlta) = $thisYear  then a.objetivo else 0 end ) as clients_this_year
                ,sum( case when year(a.fechaAlta) = ($thisYear - 1 )  then a.objetivo else 0 end ) as clients_past_year
                ,sum( case when year(a.fechaAlta) = $thisYear AND month(a.fechaAlta) = $thisMonth AND day(a.fechaAlta) = $thisDay  then a.objetivo else 0 end ) as clients_today
                ,sum( case when year(a.fechaAlta) = $pastYear AND month(a.fechaAlta) = $pastMonth AND day(a.fechaAlta) = $pastDay  then a.objetivo else 0 end ) as clients_yesterday
                ,sum( case when year(a.fechaAlta) = $pastYear2 AND month(a.fechaAlta) = $pastMonth2 AND day(a.fechaAlta) = $pastDay2  then a.objetivo else 0 end ) as clients_yesterday2
                ,sum( case when year(a.fechaAlta) = $pastYear3 AND month(a.fechaAlta) = $pastMonth3 AND day(a.fechaAlta) = $pastDay3  then a.objetivo else 0 end ) as clients_yesterday3
                ,sum( case when year(a.fechaAlta) = $pastYear3 AND month(a.fechaAlta) = $pastMonth3 AND day(a.fechaAlta) = $pastDay4  then a.objetivo else 0 end ) as clients_yesterday4
                ,sum( case when year(a.fechaAlta) = $pastYear3 AND month(a.fechaAlta) = $pastMonth3 AND day(a.fechaAlta) = $pastDay5  then a.objetivo else 0 end ) as clients_yesterday5
                ,sum( case when year(a.fechaAlta) = $futureYear AND month(a.fechaAlta) = $futureMonth AND day(a.fechaAlta) = $futureDay  then a.objetivo else 0 end ) as clients_tomorrow
                ,sum( case when year(a.fechaAlta) = $futureYear2 AND month(a.fechaAlta) = $futureMonth2 AND day(a.fechaAlta) = $futureDay2  then a.objetivo else 0 end ) as clients_tomorrow2
                ,sum( case when year(a.fechaAlta) = $futureYear3 AND month(a.fechaAlta) = $futureMonth3 AND day(a.fechaAlta) = $futureDay3  then a.objetivo else 0 end ) as clients_tomorrow3
                ,sum( case when year(a.fechaAlta) = $futureYear3 AND month(a.fechaAlta) = $futureMonth3 AND day(a.fechaAlta) = $futureDay4  then a.objetivo else 0 end ) as clients_tomorrow4
                ,sum( case when year(a.fechaAlta) = $futureYear3 AND month(a.fechaAlta) = $futureMonth3 AND day(a.fechaAlta) = $futureDay5  then a.objetivo else 0 end ) as clients_tomorrow5
                ,sum( case when year(a.fechaAlta) = $thisYear AND month(a.fechaAlta) = 1  then a.objetivo else 0 end ) as Ene
                ,sum( case when year(a.fechaAlta) = $thisYear AND month(a.fechaAlta) = 2  then a.objetivo else 0 end ) as Feb
                ,sum( case when year(a.fechaAlta) = $thisYear AND month(a.fechaAlta) = 3  then a.objetivo else 0 end ) as Mar
                ,sum( case when year(a.fechaAlta) = $thisYear AND month(a.fechaAlta) = 4  then a.objetivo else 0 end ) as Abr
                ,sum( case when year(a.fechaAlta) = $thisYear AND month(a.fechaAlta) = 5  then a.objetivo else 0 end ) as May
                ,sum( case when year(a.fechaAlta) = $thisYear AND month(a.fechaAlta) = 6  then a.objetivo else 0 end ) as Jun
                ,sum( case when year(a.fechaAlta) = $thisYear AND month(a.fechaAlta) = 7  then a.objetivo else 0 end ) as Jul
                ,sum( case when year(a.fechaAlta) = $thisYear AND month(a.fechaAlta) = 8  then a.objetivo else 0 end ) as Ago
                ,sum( case when year(a.fechaAlta) = $thisYear AND month(a.fechaAlta) = 9  then a.objetivo else 0 end ) as Sept
                ,sum( case when year(a.fechaAlta) = $thisYear AND month(a.fechaAlta) = 10  then a.objetivo else 0 end ) as Oct
                ,sum( case when year(a.fechaAlta) = $thisYear AND month(a.fechaAlta) = 11  then a.objetivo else 0 end ) as Nov
                ,sum( case when year(a.fechaAlta) = $thisYear AND month(a.fechaAlta) = 12  then a.objetivo else 0 end ) as Dic
        FROM clientes a
        $añadeSQL";


      //echo $sql;

        $this->db->query($sql);

        $resultado = $this->db->registros();

        return $resultado;
    }


    public function getAnalisisClientesEstados($datos){

      if( isset($datos['add']) ){
        $añadeSQL = $datos['add'];
      } else {
        $añadeSQL = '';
      }

      if(isset($datos['date']) && $datos['date'] != ''){
        $thisYear = date('Y', strtotime($datos['date']));
        $thisMonth = date('m', strtotime($datos['date']));
        $thisDay = date('d', strtotime($datos['date']));
        $dayFull = date('d-m-Y', strtotime($datos['date']));
        $pastYear = date('Y', strtotime($datos['date']." -1 day"));
        $pastMonth = date('m', strtotime($datos['date']." -1 day"));
        $pastDay = date('d', strtotime($datos['date']." -1 day"));
        $lastMonth = date('m', strtotime($datos['date']." -1 month"));
        $lastYearMonth = date('Y', strtotime($datos['date']." -1 month"));
      } else {
        $thisYear = date('Y');
        $thisMonth = date('m');
        $thisDay = date('d');
        $dayFull = date('d-m-Y');
        $pastYear = date('Y', strtotime(" -1 day"));
        $pastMonth = date('m', strtotime(" -1 day"));
        $pastDay = date('d', strtotime(" -1 day"));
        $lastMonth = date('m', strtotime(" -1 month"));
        $lastYearMonth = date('Y', strtotime(" -1 month"));
      }

      $sql = "SELECT d.estadoCliente as estado
              ,count( case when year(a.fechaAlta) = $thisYear then a.idCliente else NULL end ) as clients_this_year
              ,count( case when year(a.fechaAlta) = ($thisYear - 1 ) then a.idCliente else NULL end ) as clients_past_year
              ,count( case when year(a.fechaAlta) = $thisYear AND month(a.fechaAlta) = $thisMonth AND day(a.fechaAlta) = $thisDay then a.idCliente else NULL end ) as clients_today
              ,count( case when year(a.fechaAlta) = $pastYear AND month(a.fechaAlta) = $pastMonth AND day(a.fechaAlta) = $pastDay then a.idCliente else NULL end ) as clients_yesterday
              ,count( case when year(a.fechaAlta) = $thisYear AND month(a.fechaAlta) = $thisMonth then a.idCliente else NULL end ) as clients_this_month
              ,count( case when year(a.fechaAlta) = $lastYearMonth AND month(a.fechaAlta) = $lastMonth then a.idCliente else NULL end ) as clients_past_month
      FROM clientes a
      LEFT JOIN estados_clientes d on a.idEstadoCliente = d.idEstadoCliente
      $añadeSQL
      GROUP BY estadoCliente
      ORDER BY estado";

      //echo $sql;

        $this->db->query($sql);

        $resultado = $this->db->registros();

        return $resultado;
    }


    public function getAnalisisAgenda($datos){

      if( isset($datos['add']) ){
        $añadeSQL = $datos['add'];
      } else {
        $añadeSQL = '';
      }


      if(isset($_POST['fecha']) && $_POST['fecha'] != ''){
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
      } else {
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
      }

      $sql = "SELECT d.estadoAccion as estado
              ,count( case when year(a.start) = $thisYear then a.idAccion else NULL end ) as actions_this_year
              ,count( case when year(a.start) = ($thisYear - 1 ) then a.idAccion else NULL end ) as actions_past_year
              ,count( case when year(a.start) = $thisYear AND month(a.start) = $thisMonth AND day(a.start) = $thisDay then a.idAccion else NULL end ) as actions_today
              ,count( case when year(a.start) = $pastYear AND month(a.start) = $pastMonth AND day(a.start) = $pastDay then a.idAccion else NULL end ) as actions_yesterday
              ,count( case when year(a.start) = $pastYear2 AND month(a.start) = $pastMonth2 AND day(a.start) = $pastDay2 then a.idAccion else NULL end ) as actions_yesterday2
              ,count( case when year(a.start) = $pastYear3 AND month(a.start) = $pastMonth3 AND day(a.start) = $pastDay3 then a.idAccion else NULL end ) as actions_yesterday3
              ,count( case when year(a.start) = $pastYear3 AND month(a.start) = $pastMonth3 AND day(a.start) = $pastDay4 then a.idAccion else NULL end ) as actions_yesterday4
              ,count( case when year(a.start) = $pastYear3 AND month(a.start) = $pastMonth3 AND day(a.start) = $pastDay5 then a.idAccion else NULL end ) as actions_yesterday5
              ,count( case when year(a.start) = $futureYear AND month(a.start) = $futureMonth AND day(a.start) = $futureDay then a.idAccion else NULL end ) as actions_tomorrow
              ,count( case when year(a.start) = $futureYear2 AND month(a.start) = $futureMonth2 AND day(a.start) = $futureDay2 then a.idAccion else NULL end ) as actions_tomorrow2
              ,count( case when year(a.start) = $futureYear3 AND month(a.start) = $futureMonth3 AND day(a.start) = $futureDay3 then a.idAccion else NULL end ) as actions_tomorrow3
              ,count( case when year(a.start) = $futureYear3 AND month(a.start) = $futureMonth3 AND day(a.start) = $futureDay4 then a.idAccion else NULL end ) as actions_tomorrow4
              ,count( case when year(a.start) = $futureYear3 AND month(a.start) = $futureMonth3 AND day(a.start) = $futureDay5 then a.idAccion else NULL end ) as actions_tomorrow5
              ,count( case when year(a.start) = $thisYear AND month(a.start) = 1 then a.idAccion else NULL end ) as Ene
              ,count( case when year(a.start) = $thisYear AND month(a.start) = 2 then a.idAccion else NULL end ) as Feb
              ,count( case when year(a.start) = $thisYear AND month(a.start) = 3 then a.idAccion else NULL end ) as Mar
              ,count( case when year(a.start) = $thisYear AND month(a.start) = 4 then a.idAccion else NULL end ) as Abr
              ,count( case when year(a.start) = $thisYear AND month(a.start) = 5 then a.idAccion else NULL end ) as May
              ,count( case when year(a.start) = $thisYear AND month(a.start) = 6 then a.idAccion else NULL end ) as Jun
              ,count( case when year(a.start) = $thisYear AND month(a.start) = 7 then a.idAccion else NULL end ) as Jul
              ,count( case when year(a.start) = $thisYear AND month(a.start) = 8 then a.idAccion else NULL end ) as Ago
              ,count( case when year(a.start) = $thisYear AND month(a.start) = 9 then a.idAccion else NULL end ) as Sept
              ,count( case when year(a.start) = $thisYear AND month(a.start) = 10 then a.idAccion else NULL end ) as Oct
              ,count( case when year(a.start) = $thisYear AND month(a.start) = 11 then a.idAccion else NULL end ) as Nov
              ,count( case when year(a.start) = $thisYear AND month(a.start) = 12 then a.idAccion else NULL end ) as Dic
        FROM acciones a
        LEFT JOIN estados_acciones d on a.idEstadoAccion = d.idEstadoAccion
        $añadeSQL
        GROUP BY estadoAccion
        union
        SELECT  'DURACION MEDIA'
                ,sum( case when year(a.start) = $thisYear AND a.end IS NOT NULL then TIMESTAMPDIFF(MINUTE,a.start,a.end) else 0 end ) / count( case when year(a.start) = $thisYear AND a.end IS NOT NULL then a.idAccion else NULL end )  as actions_this_year
                ,sum( case when year(a.start) = ($thisYear - 1 ) AND a.end IS NOT NULL then TIMESTAMPDIFF(MINUTE,a.start,a.end) else 0 end ) / count( case when year(a.start) = ($thisYear - 1 ) AND a.end IS NOT NULL then a.idAccion else NULL end ) as actions_past_year
                ,sum( case when year(a.start) = $thisYear AND month(a.start) = $thisMonth AND day(a.start) = $thisDay AND a.end IS NOT NULL then TIMESTAMPDIFF(MINUTE,a.start,a.end) else 0 end ) / count( case when year(a.start) = $thisYear AND month(a.start) = $thisMonth AND day(a.start) = $thisDay AND a.end IS NOT NULL then a.idAccion else NULL end ) as actions_today
                ,sum( case when year(a.start) = $pastYear AND month(a.start) = $pastMonth AND day(a.start) = $pastDay AND a.end IS NOT NULL then TIMESTAMPDIFF(MINUTE,a.start,a.end) else 0 end ) / count( case when year(a.start) = $pastYear AND month(a.start) = $pastMonth AND day(a.start) = $pastDay AND a.end IS NOT NULL then a.idAccion else NULL end ) as actions_yesterday
                ,sum( case when year(a.start) = $pastYear2 AND month(a.start) = $pastMonth2 AND day(a.start) = $pastDay2 AND a.end IS NOT NULL then TIMESTAMPDIFF(MINUTE,a.start,a.end) else 0 end ) / count( case when year(a.start) = $pastYear2 AND month(a.start) = $pastMonth2 AND day(a.start) = $pastDay2 AND a.end IS NOT NULL then a.idAccion else NULL end ) as actions_yesterday2
                ,sum( case when year(a.start) = $pastYear3 AND month(a.start) = $pastMonth3 AND day(a.start) = $pastDay3 AND a.end IS NOT NULL then TIMESTAMPDIFF(MINUTE,a.start,a.end) else 0 end ) / count( case when year(a.start) = $pastYear3 AND month(a.start) = $pastMonth3 AND day(a.start) = $pastDay3 AND a.end IS NOT NULL then a.idAccion else NULL end ) as actions_yesterday3
                ,sum( case when year(a.start) = $pastYear3 AND month(a.start) = $pastMonth3 AND day(a.start) = $pastDay4 AND a.end IS NOT NULL then TIMESTAMPDIFF(MINUTE,a.start,a.end) else 0 end ) / count( case when year(a.start) = $pastYear3 AND month(a.start) = $pastMonth3 AND day(a.start) = $pastDay4 AND a.end IS NOT NULL then a.idAccion else NULL end ) as actions_yesterday4
                ,sum( case when year(a.start) = $pastYear3 AND month(a.start) = $pastMonth3 AND day(a.start) = $pastDay5 AND a.end IS NOT NULL then TIMESTAMPDIFF(MINUTE,a.start,a.end) else 0 end ) / count( case when year(a.start) = $pastYear3 AND month(a.start) = $pastMonth3 AND day(a.start) = $pastDay5 AND a.end IS NOT NULL then a.idAccion else NULL end ) as actions_yesterday5
                ,sum( case when year(a.start) = $futureYear AND month(a.start) = $futureMonth AND day(a.start) = $futureDay AND a.end IS NOT NULL then TIMESTAMPDIFF(MINUTE,a.start,a.end) else 0 end ) / count( case when year(a.start) = $futureYear AND month(a.start) = $futureMonth AND day(a.start) = $futureDay AND a.end IS NOT NULL then a.idAccion else NULL end ) as actions_tomorrow
                ,sum( case when year(a.start) = $futureYear2 AND month(a.start) = $futureMonth2 AND day(a.start) = $futureDay2 AND a.end IS NOT NULL then TIMESTAMPDIFF(MINUTE,a.start,a.end) else 0 end ) / count( case when year(a.start) = $futureYear2 AND month(a.start) = $futureMonth2 AND day(a.start) = $futureDay2 AND a.end IS NOT NULL then a.idAccion else NULL end ) as actions_tomorrow2
                ,sum( case when year(a.start) = $futureYear3 AND month(a.start) = $futureMonth3 AND day(a.start) = $futureDay3 AND a.end IS NOT NULL then TIMESTAMPDIFF(MINUTE,a.start,a.end) else 0 end ) / count( case when year(a.start) = $futureYear3 AND month(a.start) = $futureMonth3 AND day(a.start) = $futureDay3 AND a.end IS NOT NULL then a.idAccion else NULL end ) as actions_tomorrow3
                ,sum( case when year(a.start) = $futureYear3 AND month(a.start) = $futureMonth3 AND day(a.start) = $futureDay4 AND a.end IS NOT NULL then TIMESTAMPDIFF(MINUTE,a.start,a.end) else 0 end ) / count( case when year(a.start) = $futureYear3 AND month(a.start) = $futureMonth3 AND day(a.start) = $futureDay4 AND a.end IS NOT NULL then a.idAccion else NULL end ) as actions_tomorrow4
                ,sum( case when year(a.start) = $futureYear3 AND month(a.start) = $futureMonth3 AND day(a.start) = $futureDay5 AND a.end IS NOT NULL then TIMESTAMPDIFF(MINUTE,a.start,a.end) else 0 end ) / count( case when year(a.start) = $futureYear3 AND month(a.start) = $futureMonth3 AND day(a.start) = $futureDay5 AND a.end IS NOT NULL then a.idAccion else NULL end ) as actions_tomorrow5
                ,sum( case when year(a.start) = $thisYear AND month(a.start) = 1 AND a.end IS NOT NULL then TIMESTAMPDIFF(MINUTE,a.start,a.end) else 0 end ) / count( case when year(a.start) = $thisYear AND month(a.start) = 1 AND a.end IS NOT NULL then a.idAccion else NULL end ) as Ene
                ,sum( case when year(a.start) = $thisYear AND month(a.start) = 2 AND a.end IS NOT NULL then TIMESTAMPDIFF(MINUTE,a.start,a.end) else 0 end ) / count( case when year(a.start) = $thisYear AND month(a.start) = 2 AND a.end IS NOT NULL then a.idAccion else NULL end ) as Feb
                ,sum( case when year(a.start) = $thisYear AND month(a.start) = 3 AND a.end IS NOT NULL then TIMESTAMPDIFF(MINUTE,a.start,a.end) else 0 end ) / count( case when year(a.start) = $thisYear AND month(a.start) = 3 AND a.end IS NOT NULL then a.idAccion else NULL end ) as Mar
                ,sum( case when year(a.start) = $thisYear AND month(a.start) = 4 AND a.end IS NOT NULL then TIMESTAMPDIFF(MINUTE,a.start,a.end) else 0 end ) / count( case when year(a.start) = $thisYear AND month(a.start) = 4 AND a.end IS NOT NULL then a.idAccion else NULL end ) as Abr
                ,sum( case when year(a.start) = $thisYear AND month(a.start) = 5 AND a.end IS NOT NULL then TIMESTAMPDIFF(MINUTE,a.start,a.end) else 0 end ) / count( case when year(a.start) = $thisYear AND month(a.start) = 5 AND a.end IS NOT NULL then a.idAccion else NULL end ) as May
                ,sum( case when year(a.start) = $thisYear AND month(a.start) = 6 AND a.end IS NOT NULL then TIMESTAMPDIFF(MINUTE,a.start,a.end) else 0 end ) / count( case when year(a.start) = $thisYear AND month(a.start) = 6 AND a.end IS NOT NULL then a.idAccion else NULL end ) as Jun
                ,sum( case when year(a.start) = $thisYear AND month(a.start) = 7 AND a.end IS NOT NULL then TIMESTAMPDIFF(MINUTE,a.start,a.end) else 0 end ) / count( case when year(a.start) = $thisYear AND month(a.start) = 7 AND a.end IS NOT NULL then a.idAccion else NULL end ) as Jul
                ,sum( case when year(a.start) = $thisYear AND month(a.start) = 8 AND a.end IS NOT NULL then TIMESTAMPDIFF(MINUTE,a.start,a.end) else 0 end ) / count( case when year(a.start) = $thisYear AND month(a.start) = 8 AND a.end IS NOT NULL then a.idAccion else NULL end ) as Ago
                ,sum( case when year(a.start) = $thisYear AND month(a.start) = 9 AND a.end IS NOT NULL then TIMESTAMPDIFF(MINUTE,a.start,a.end) else 0 end ) / count( case when year(a.start) = $thisYear AND month(a.start) = 9 AND a.end IS NOT NULL then a.idAccion else NULL end ) as Sept
                ,sum( case when year(a.start) = $thisYear AND month(a.start) = 10 AND a.end IS NOT NULL then TIMESTAMPDIFF(MINUTE,a.start,a.end) else 0 end ) / count( case when year(a.start) = $thisYear AND month(a.start) = 10 AND a.end IS NOT NULL then a.idAccion else NULL end ) as Oct
                ,sum( case when year(a.start) = $thisYear AND month(a.start) = 11 AND a.end IS NOT NULL then TIMESTAMPDIFF(MINUTE,a.start,a.end) else 0 end ) / count( case when year(a.start) = $thisYear AND month(a.start) = 11 AND a.end IS NOT NULL then a.idAccion else NULL end ) as Nov
                ,sum( case when year(a.start) = $thisYear AND month(a.start) = 12 AND a.end IS NOT NULL then TIMESTAMPDIFF(MINUTE,a.start,a.end) else 0 end ) / count( case when year(a.start) = $thisYear AND month(a.start) = 12 AND a.end IS NOT NULL then a.idAccion else NULL end ) as Dic
        FROM acciones a
        $añadeSQL";


      //echo $sql;

        $this->db->query($sql);

        $resultado = $this->db->registros();

        return $resultado;
    }


    public function getAnalisisAgendaEstados($datos){

      if( isset($datos['add']) ){
        $añadeSQL = $datos['add'];
      } else {
        $añadeSQL = '';
      }

      if(isset($datos['date']) && $datos['date'] != ''){
        $thisYear = date('Y', strtotime($datos['date']));
        $thisMonth = date('m', strtotime($datos['date']));
        $thisDay = date('d', strtotime($datos['date']));
        $dayFull = date('d-m-Y', strtotime($datos['date']));
        $pastYear = date('Y', strtotime($datos['date']." -1 day"));
        $pastMonth = date('m', strtotime($datos['date']." -1 day"));
        $pastDay = date('d', strtotime($datos['date']." -1 day"));
        $lastMonth = date('m', strtotime($datos['date']." -1 month"));
        $lastYearMonth = date('Y', strtotime($datos['date']." -1 month"));
      } else {
        $thisYear = date('Y');
        $thisMonth = date('m');
        $thisDay = date('d');
        $dayFull = date('d-m-Y');
        $pastYear = date('Y', strtotime(" -1 day"));
        $pastMonth = date('m', strtotime(" -1 day"));
        $pastDay = date('d', strtotime(" -1 day"));
        $lastMonth = date('m', strtotime(" -1 month"));
        $lastYearMonth = date('Y', strtotime(" -1 month"));
      }

      $sql = "SELECT d.estadoAccion as estado
              ,count( case when year(a.start) = $thisYear then a.idAccion else NULL end ) as actions_this_year
              ,count( case when year(a.start) = ($thisYear - 1 ) then a.idAccion else NULL end ) as actions_past_year
              ,count( case when year(a.start) = $thisYear AND month(a.start) = $thisMonth AND day(a.start) = $thisDay then a.idAccion else NULL end ) as actions_today
              ,count( case when year(a.start) = $pastYear AND month(a.start) = $pastMonth AND day(a.start) = $pastDay then a.idAccion else NULL end ) as actions_yesterday
              ,count( case when year(a.start) = $thisYear AND month(a.start) = $thisMonth then a.idAccion else NULL end ) as actions_this_month
              ,count( case when year(a.start) = $lastYearMonth AND month(a.start) = $lastMonth then a.idAccion else NULL end ) as actions_past_month
      FROM acciones a
      LEFT JOIN estados_acciones d on a.idEstadoAccion = d.idEstadoAccion
      $añadeSQL
      GROUP BY estadoAccion
      ORDER BY estado";

      $sql2 = "SELECT d.estadoAccion as estado
              ,count( case when year(a.created) = $thisYear then a.idAccion else NULL end ) as actions_this_year
              ,count( case when year(a.created) = ($thisYear - 1 ) then a.idAccion else NULL end ) as actions_past_year
              ,count( case when year(a.created) = $thisYear AND month(a.created) = $thisMonth AND day(a.created) = $thisDay then a.idAccion else NULL end ) as actions_today
              ,count( case when year(a.created) = $pastYear AND month(a.created) = $pastMonth AND day(a.created) = $pastDay then a.idAccion else NULL end ) as actions_yesterday
              ,count( case when year(a.created) = $thisYear AND month(a.created) = $thisMonth then a.idAccion else NULL end ) as actions_this_month
              ,count( case when year(a.created) = $lastYearMonth AND month(a.created) = $lastMonth then a.idAccion else NULL end ) as actions_past_month
      FROM acciones a
      LEFT JOIN estados_acciones d on a.idEstadoAccion = d.idEstadoAccion
      $añadeSQL
      GROUP BY estadoAccion
      ORDER BY estado";

      //echo $sql;

        $this->db->query($sql);

        $resultado = $this->db->registros();

        return $resultado;
    }


    public function getAnalisisHistorico($datos){

      if( isset($datos['add']) ){
        $añadeSQL = $datos['add'];
      } else {
        $añadeSQL = '';
      }

      if( isset($datos['addDate']) ){
        $añadeSQLFecha = $datos['addDate'];
      } else {
        $añadeSQLFecha = '';
      }

      $sql = "SELECT
            a.idCliente,
            a.idEstadoCliente,+
            a.fechaAlta,
            a.denominacion as nombre,
            a.email,
            a.provincia,
            a.facturado,
            a.objetivo,
            b.estadoCliente
          FROM clientes a
          LEFT JOIN estados_clientes b ON a.idEstadoCliente = b.idEstadoCliente
          $añadeSQL $añadeSQLFecha
          ORDER BY fechaAlta desc";

        $this->db->query($sql);

        $resultado = $this->db->registros();

        return $resultado;
    }

}
