<?php
class Tiempos extends Controlador
{



    public function __construct()
    {
        parent::__construct();
        $this->DatatableTiempos = $this->modelo('ModeloTiempos');

    }
    
    public function index()
    {

        $this->iniciar();

        $this->vista('datatable/tiempos');
      
    }
}