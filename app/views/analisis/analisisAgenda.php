<?php require(RUTA_APP . '/views/includes/header2.php'); ?>

<!-- EMPIEZA BREADCRUMB -->
          <div class="content-wrapper">
          <!-- Content Header (Page header) -->
          <div class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                  <h1 class="m-0 text-dark">Análisis Agenda</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo RUTA_URL ?>/analisis/analisisClientes">Inicio</a></li>
                    <li class="breadcrumb-item active">Análisis Agenda</li>
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
											<h5 class="title analisisEnlaces">Clientes <i class="fa fa-user"></i> </h5>
										</div>
									</a>
								</div>
								<div class="col-md-2 col-lg-2">
									<a href="<?php echo RUTA_URL ?>/analisis/analisisAgenda">
										<div class="btn btn-primary">
											<h5 class="title analisisEnlaces selected">Agenda <i class="fa fa-calendar-alt"></i> </h5>
										</div>
									</a>
								</div>
								<!-- <div class="col-md-2 col-lg-2">
									<a href="<?php echo RUTA_URL ?>/analisis/analisisHistorico">
										<div class="btn btn-outline-primary">
											<h5 class="title analisisEnlaces">Histórico</h5>
										</div>
									</a>
								</div> -->
								<div class="col-md-4 col-lg-4">
								</div>

							</div>

							<div class="row table-wrapper" style="padding-top:20px;">
								<!-- FILTROS -->
								<div class="col-sm-1">
								</div>
								<div class="col-sm-2">
									<input  class="filtrosAcciones filtroFecha filtros_select" type="date" id="filtroFecha" name="filtroFecha" value="" style="width:100% !important">
								</div>
								<div class="col-sm-2">
									<select class="filtrosAcciones filtros_select" id="filtroUsuario" name="filtroUsuario[]" multiple="multiple" style="width:100% !important">
									</select>
								</div>
							  <div class="col-sm-2">
									<select class="filtrosAcciones filtros_select" id="filtroCliente" name="filtroCliente[]" multiple="multiple" style="width:100% !important">
									</select>
								</div>
								<div class="col-sm-2">
									<select class="filtrosAcciones filtros_select" id="filtroTipoAccion" name="filtroTipoAccion[]" multiple="multiple" style="width:100% !important">
									</select>
								</div>
								<div class="col-sm-2">
									<select class="filtrosAcciones filtros_select" id="filtroEstadoAccion" name="filtroEstadoAccion[]" multiple="multiple" style="width:100% !important">
									</select>
								</div>
								<div class="col-sm-1">
								</div>
							</div>
							<div class="row loader" style="margin-left: 45%; margin-right:45%;"></div>

							<div class="row table-wrapper" style="margin-top:40px;">
								<div id="dashboardAccionesEstados" class="chart" style="width:100% !important">
										<div class="col-sm-12" style="display:none">
											<div  class="seccionDatos" id="control_div_analisis_acciones_estados" style="margin-bottom: 10px;text-align:center; background-color:white; margin-left:30%; margin-right:30%;width: 40%"></div>
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
								<div id="dashboardAccionesMeses" class="chart" style="width:100% !important">
										<div class="col-sm-12" style="display:none">
											<div  class="seccionDatos" id="control_div_analisis_acciones_meses" style="margin-bottom: 10px;text-align:center; background-color:white; margin-left:30%; margin-right:30%;width: 40%"></div>
										</div>
										<div class="col-md-8 col-lg-8 wow chart" style="width:65%">
											<div class="box" style="color:black !important;">
												<div  class="seccionDatos" id="chart_div_acciones_dias" style="margin-bottom: 10px;padding-right:20px;"></div>
											</div>
										</div>
										<div class="col-md-4 col-lg-4 wow chart" style="width:33%">
											<div class="box" style="color:black !important;">
												<div  class="seccionDatos" id="chart_div_acciones_tiempos_dias" style="margin-bottom: 10px;"></div>
											</div>
										</div>
										<div class="col-md-8 col-lg-8 wow chart" style="width:65%">
											<div class="box" style="color:black !important;">
												<div  class="seccionDatos" id="chart_div_acciones_meses" style="margin-bottom: 10px;"></div>
											</div>
										</div>
										<div class="col-md-4 col-lg-4 wow chart" style="width:33%">
											<div class="box" style="color:black !important;">
												<div  class="seccionDatos" id="chart_div_acciones_tiempos_meses" style="margin-bottom: 10px;"></div>
											</div>
										</div>
										<h6 style="width:100;text-align:center">AÑO</h6>
										<div class="col-md-12 col-lg-12 wow chart">
											<div class="box" style="color:black !important;">
												<div  class="seccionDatos" id="table_div_analisis_acciones_year" style="margin-bottom: 10px;"></div>
											</div>
										</div>
										<div class="col-sm-12">
											<button  id="btn_table_div_analisis_acciones_dias" class="btn btn-success botonSeccion" type="button" name="button" data-toggle="collapse" data-target="#table_div_analisis_acciones_dias" aria-expanded="false" aria-controls="table_div_analisis_acciones_dias">ESTADOS DE ACCIONES DIARIO</button>
											<div  class="seccionDatos collapse" id="table_div_analisis_acciones_dias"></div>
										</div>
										<div class="col-sm-12">
											<button  id="btn_table_div_analisis_acciones_meses" class="btn btn-success botonSeccion" type="button" name="button" data-toggle="collapse" data-target="#table_div_analisis_acciones_meses" aria-expanded="false" aria-controls="table_div_analisis_acciones_meses">ESTADOS DE ACCIONES MENSUAL</button>
											<div  class="seccionDatos collapse" id="table_div_analisis_acciones_meses"></div>
										</div>
									</div>
							</div>

						</div>

<?php require(RUTA_APP . '/views/includes/footer2.php'); ?>
