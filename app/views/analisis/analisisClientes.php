<?php require(RUTA_APP . '/views/includes/header2.php');   ?>

<!-- EMPIEZA BREADCRUMB -->
          <div class="content-wrapper">
          <!-- Content Header (Page header) -->
          <div class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                  <h1 class="m-0 text-dark">Análisis Clientes</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo RUTA_URL ?>/analisis/analisisClientes">Inicio</a></li>
                    <li class="breadcrumb-item active">Análisis Clientes</li>
                  </ol>
                </div><!-- /.col -->
              </div><!-- /.row -->
            </div><!-- /.container-fluid -->
          </div>
          <!-- /.content-header -->

          <!-- Main content -->
          <div class="content">
            <div class="container-fluid">

<!-- FIN BREADCRUMB -->

						<div class="content" style="margin:10px;">

							<div class="row"  style="text-align:center;padding:auto">

								<div class="col-md-4 col-lg-4">
								</div>
								<div class="col-md-2 col-lg-2">
									<a href="<?php echo RUTA_URL ?>/analisis/analisisClientes">
										<div class="btn btn-primary">
											<h5 class="title analisisEnlaces selected">Clientes <i class="fa fa-user"></i> </h5>
										</div>
									</a>
								</div>
								<div class="col-md-2 col-lg-2">
									<a href="<?php echo RUTA_URL ?>/analisis/analisisAgenda">
										<div class="btn btn-primary">
											<h5 class="title analisisEnlaces">Agenda <i class="fa fa-calendar-alt"></i> </h5>
										</div>
									</a>
								</div>
								<!-- <div class="col-md-2 col-lg-2">
									<a href="<?php echo RUTA_URL ?>/analisis/analisisHistorico">
										<div class="box">
											<h5 class="title analisisEnlaces">Histórico</h5>
										</div>
									</a>
								</div> -->
								<div class="col-md-4 col-lg-4">
								</div>

							</div>

							<div class="row table-wrapper" style="padding-top:20px;">
								<!-- FILTROS -->
								<div class="col-sm-3">
								</div>
								<div class="col-sm-2">
									<input  class="filtrosClientes filtroFecha filtros_select" type="date" id="filtroFecha" name="filtroFecha" value="" style="width:100% !important">
								</div>
							  <div class="col-sm-2">
									<select class="filtrosClientes filtros_select" id="filtroCliente" name="filtroCliente[]" multiple="multiple" style="width:100% !important">
									</select>
								</div>
							  <div class="col-sm-2">
									<select class="filtrosClientes filtros_select" id="filtroEstadoCliente" name="filtroEstadoCliente[]" multiple="multiple" style="width:100% !important">
									</select>
								</div>
								<div class="col-sm-3">
								</div>

							</div>
							<div class="row loader" style="margin-left: 45%; margin-right:45%;"></div>

							<div class="row table-wrapper" style="margin-top:40px;">
								<div id="dashboardClientesEstados" class="chart" style="width:100% !important">
										<div class="col-sm-12" style="display:none">
											<div  class="seccionDatos" id="control_div_analisis_clientes_estados" style="margin-bottom: 10px;text-align:center; background-color:white; margin-left:30%; margin-right:30%;width: 40%"></div>
										</div>
										<div class="col-md-2 col-lg-2 wow chart6">
											<div class="box" style="color:black !important;">
												<div  class="seccionDatos" id="chart_div_today" style="margin-bottom: 10px;"></div>
											</div>
										</div>
										<div class="col-md-2 col-lg-2 wow chart6">
											<div class="box" style="color:black !important;">
												<div  class="seccionDatos" id="chart_div_yesterday" style="margin-bottom: 10px;"></div>
											</div>
										</div>
										<div class="col-md-2 col-lg-2 wow chart6">
											<div class="box" style="color:black !important;">
												<div  class="seccionDatos" id="chart_div_this_month" style="margin-bottom: 10px;"></div>
											</div>
										</div>
										<div class="col-md-2 col-lg-2 wow chart6">
											<div class="box" style="color:black !important;">
												<div  class="seccionDatos" id="chart_div_past_month" style="margin-bottom: 10px;"></div>
											</div>
										</div>
										<div class="col-md-2 col-lg-2 wow chart6">
											<div class="box" style="color:black !important;">
												<div  class="seccionDatos" id="chart_div_this_year" style="margin-bottom: 10px;"></div>
											</div>
										</div>
										<div class="col-md-2 col-lg-2 wow chart6">
											<div class="box" style="color:black !important;">
												<div  class="seccionDatos" id="chart_div_past_year" style="margin-bottom: 10px;"></div>
											</div>
										</div>
									</div>
								<div id="dashboardClientesMeses" class="chart" style="width:100% !important">
										<div class="col-sm-12" style="display:none">
											<div  class="seccionDatos" id="control_div_analisis_clientes_meses" style="margin-bottom: 10px;text-align:center; background-color:white; margin-left:30%; margin-right:30%;width: 40%"></div>
										</div>
										<div class="col-md-8 col-lg-8 wow chart" style="width:65%">
											<div class="box" style="color:black !important;">
												<div  class="seccionDatos" id="chart_div_clientes_dias" style="margin-bottom: 10px;padding-right:20px;"></div>
											</div>
										</div>
										<div class="col-md-4 col-lg-4 wow chart" style="width:33%">
											<div class="box" style="color:black !important;">
												<div  class="seccionDatos" id="chart_div_clientes_tiempos_dias" style="margin-bottom: 10px;"></div>
											</div>
										</div>
										<div class="col-md-8 col-lg-8 wow chart" style="width:65%">
											<div class="box" style="color:black !important;">
												<div  class="seccionDatos" id="chart_div_clientes_meses" style="margin-bottom: 10px;"></div>
											</div>
										</div>
										<div class="col-md-4 col-lg-4 wow chart" style="width:33%">
											<div class="box" style="color:black !important;">
												<div  class="seccionDatos" id="chart_div_clientes_tiempos_meses" style="margin-bottom: 10px;"></div>
											</div>
										</div>
										<h6 style="width:100;text-align:center">AÑO</h6>
										<div class="col-md-12 col-lg-12 wow chart">
											<div class="box" style="color:black !important;">
												<div  class="seccionDatos" id="table_div_analisis_clientes_year" style="margin-bottom: 10px;"></div>
											</div>
										</div>
										<div class="col-sm-12">
											<button  id="btn_table_div_analisis_clientes_dias" class="btn btn-success botonSeccion" type="button" name="button" data-toggle="collapse" data-target="#table_div_analisis_clientes_dias" aria-expanded="false" aria-controls="table_div_analisis_clientes_dias">ESTADOS DE CLIENTES DIARIO</button>
											<div  class="seccionDatos collapse" id="table_div_analisis_clientes_dias"></div>
										</div>
										<div class="col-sm-12">
											<button  id="btn_table_div_analisis_clientes_meses" class="btn btn-success botonSeccion" type="button" name="button" data-toggle="collapse" data-target="#table_div_analisis_clientes_meses" aria-expanded="false" aria-controls="table_div_analisis_clientes_meses">ESTADOS DE CLIENTES MENSUAL</button>
											<div  class="seccionDatos collapse" id="table_div_analisis_clientes_meses"></div>
										</div>
									</div>
							</div>

							<!-- <div class="row table-wrapper" style="margin-top:40px;">
								<div id="dashboardEstadosLeads" class="chart" style="width:100%">
									<div class="col-sm-12">
										<div id="control_div_analisis_estados_leads" style="margin-bottom: 20px;margin-top: 20px;background-color:white;"></div>
									</div>
									<div class="col-md-2 col-lg-2 wow chart6">
										<div class="box" style="color:black !important;">
											<div  class="seccionDatos" id="chart_div_pie_estados_leads_today" style="margin-bottom: 10px;"></div>
										</div>
									</div>
									<div class="col-md-2 col-lg-2 wow chart6">
										<div class="box" style="color:black !important;">
											<div  class="seccionDatos" id="chart_div_pie_estados_leads_yesterday" style="margin-bottom: 10px;"></div>
										</div>
									</div>
									<div class="col-md-2 col-lg-2 wow chart6">
										<div class="box" style="color:black !important;">
											<div  class="seccionDatos" id="chart_div_pie_estados_leads_this_month" style="margin-bottom: 10px;"></div>
										</div>
									</div>
									<div class="col-md-2 col-lg-2 wow chart6">
										<div class="box" style="color:black !important;">
											<div  class="seccionDatos" id="chart_div_pie_estados_leads_past_month" style="margin-bottom: 10px;"></div>
										</div>
									</div>
									<div class="col-md-2 col-lg-2 wow chart6">
										<div class="box" style="color:black !important;">
											<div  class="seccionDatos" id="chart_div_pie_estados_leads_this_year" style="margin-bottom: 10px;"></div>
										</div>
									</div>
									<div class="col-md-2 col-lg-2 wow chart6">
										<div class="box" style="color:black !important;">
											<div  class="seccionDatos" id="chart_div_pie_estados_leads_past_year" style="margin-bottom: 10px;"></div>
										</div>
									</div>
								</div>
								<div id="dashboardClientes" class="chart" style="width:100%">
										<div class="col-sm-12" style="display:none">
											<div  class="seccionDatos" id="control_div_analisis_clientes" style="margin-bottom: 10px;text-align:center; background-color:white; margin-left:30%; margin-right:30%;width: 40%"></div>
										</div>
										<div class="col-md-6 col-lg-6 wow chart2">
											<h6 style="width:100;text-align:center; margin-bottom:3px !important;">DÍA</h6>
											<div class="box" style="color:black !important;">
												<div  class="seccionDatos" id="table_div_analisis_clientes_dia" style="margin-bottom: 10px;"></div>
											</div>
										</div>
										<div class="col-md-6 col-lg-6 wow chart2">
										<h6 style="width:100;text-align:center; margin-bottom:3px !important;">AÑO</h6>
											<div class="box" style="color:black !important;">
												<div  class="seccionDatos" id="table_div_analisis_clientes_year" style="margin-bottom: 10px;"></div>
											</div>
										</div>
										<div class="col-md-7 col-lg-7 wow chart" style="width:60%">
											<div class="box" style="color:black !important;">
												<div  class="seccionDatos" id="chart_div_leads_mes" style="margin-bottom: 10px;padding-right:20px;"></div>
											</div>
										</div>
										<div class="col-md-5 col-lg-5 wow chart" style="width:40%">
											<div class="box" style="color:black !important;">
												<div  class="seccionDatos" id="chart_div_analisis_clientes_t_contacto" style="margin-bottom: 10px;"></div>
											</div>
										</div>
										<div class="col-md-7 col-lg-7 wow chart" style="width:60%">
											<div class="box" style="color:black !important;">
												<div  class="seccionDatos" id="chart_div_analisis_clientes_situacion" style="margin-bottom: 10px;"></div>
											</div>
										</div>
										<div class="col-md-5 col-lg-5 wow chart" style="width:40%">
											<div class="box" style="color:black !important;">
												<div  class="seccionDatos" id="chart_div_analisis_clientes_t_cliente" style="margin-bottom: 10px;"></div>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-6">
												<button  id="btn_table_div_analisis_clientes_leads_dia" class="btn btn-success botonSeccion" type="button" name="button" data-toggle="collapse" data-target="#table_div_analisis_clientes_leads_dia" aria-expanded="false" aria-controls="table_div_analisis_clientes_leads_dia">DETALLE LEADS DÍA</button>
												<div  class="seccionDatos collapse" id="table_div_analisis_clientes_leads_dia"></div>
											</div>
											<div class="col-sm-6">
												<button  id="btn_table_div_analisis_clientes_tiempos_dia" class="btn btn-success botonSeccion" type="button" name="button" data-toggle="collapse" data-target="#table_div_analisis_clientes_tiempos_dia" aria-expanded="false" aria-controls="table_div_analisis_clientes_tiempos_dia">DETALLE TIEMPOS DÍA</button>
												<div  class="seccionDatos collapse" id="table_div_analisis_clientes_tiempos_dia"></div>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-6">
												<button  id="btn_table_div_analisis_clientes_leads_mes" class="btn btn-success botonSeccion" type="button" name="button" data-toggle="collapse" data-target="#table_div_analisis_clientes_leads_mes" aria-expanded="false" aria-controls="table_div_analisis_clientes_leads_mes">DETALLE LEADS MES</button>
												<div  class="seccionDatos collapse" id="table_div_analisis_clientes_leads_mes"></div>
											</div>
											<div class="col-sm-6">
												<button  id="btn_table_div_analisis_clientes_tiempos_mes" class="btn btn-success botonSeccion" type="button" name="button" data-toggle="collapse" data-target="#table_div_analisis_clientes_tiempos_mes" aria-expanded="false" aria-controls="table_div_analisis_clientes_tiempos_mes">DETALLE TIEMPOS MES</button>
												<div  class="seccionDatos collapse" id="table_div_analisis_clientes_tiempos_mes"></div>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-6">
												<button  id="btn_table_div_analisis_clientes_leads_año" class="btn btn-success botonSeccion" type="button" name="button" data-toggle="collapse" data-target="#table_div_analisis_clientes_leads_año" aria-expanded="false" aria-controls="table_div_analisis_clientes_leads_año">DETALLE LEADS AÑO</button>
												<div  class="seccionDatos collapse" id="table_div_analisis_clientes_leads_año"></div>
											</div>
											<div class="col-sm-6">
												<button  id="btn_table_div_analisis_clientes_tiempos_año" class="btn btn-success botonSeccion" type="button" name="button" data-toggle="collapse" data-target="#table_div_analisis_clientes_tiempos_año" aria-expanded="false" aria-controls="table_div_analisis_clientes_tiempos_año">DETALLE TIEMPOS AÑO</button>
												<div  class="seccionDatos collapse" id="table_div_analisis_clientes_tiempos_año"></div>
											</div>
										</div>
								</div>
							</div> -->

						</div>




<?php require(RUTA_APP . '/views/includes/footer2.php'); ?>
