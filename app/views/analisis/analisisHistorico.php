<?php require(RUTA_APP . '/views/includes/header2.php');  ?>

<!-- EMPIEZA BREADCRUMB -->
          <div class="content-wrapper">
          <!-- Content Header (Page header) -->
          <div class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                  <h1 class="m-0 text-dark">Histórico</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo RUTA_URL ?>/analisis/analisisClientes">Inicio</a></li>
                    <li class="breadcrumb-item active">Histórico</li>
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

								<div class="col-md-3 col-lg-3">
								</div>
								<div class="col-md-2 col-lg-2">
									<a href="<?php echo RUTA_URL ?>/analisis/analisisClientes">
										<div class="box">
											<h5 class="title analisisEnlaces">Leads</h5>
										</div>
									</a>
								</div>
								<div class="col-md-2 col-lg-2">
									<a href="<?php echo RUTA_URL ?>/analisis/analisisAgenda">
										<div class="box">
											<h5 class="title analisisEnlaces">Agenda</h5>
										</div>
									</a>
								</div>
								<div class="col-md-2 col-lg-2">
									<a href="<?php echo RUTA_URL ?>/analisis/analisisHistorico">
										<div class="box">
											<h5 class="title analisisEnlaces selected">Historico Leads</h5>
										</div>
									</a>
								</div>
								<div class="col-md-3 col-lg-3">
								</div>

							</div>

							<div class="row table-wrapper" style="padding-top:20px;">
								<!-- FILTROS -->
								<div class="col-sm-2">
									<input  class="filtrosClientes filtroFecha filtros_select" type="date" id="filtroFecha" name="filtroFecha" value="">
								</div>
							  <div class="col-sm-2">
									<select class="filtrosClientes filtros_select" id="filtroCliente" name="filtroCliente[]" multiple="multiple">
									</select>
								</div>
								<div class="col-sm-2">
									<select class="filtrosClientes filtros_select" id="filtroEstadoCliente" name="filtroEstadoCliente[]" multiple="multiple">
									</select>
								</div>

							</div>
							<div class="row loader" style="margin-left: 45%; margin-right:45%;"></div>

							<div class="row" style="margin-top:40px;">
								<div id="dashboardLeadsTabla" class="chart" style="width:100%">
									<div class="col-sm-12" style="display:none">
										<div class="time_control" id="control_div_analisis_leads_tabla"></div>
									</div>
									<div class="row">
										<div class="col-sm-12">
											<button  id="btn_table_div_analisis_leads" class="btn btn-success botonSeccion" type="button" name="button" data-toggle="collapse" data-target="#table_div_analisis_leads" aria-expanded="false" aria-controls="table_div_analisis_leads">SITUACIÓN ACTUAL LEADS</button>
											<div  class="collapse" id="table_div_analisis_leads"></div>
										</div>
									</div>
								</div>

							</div>
							<div class="row" style="margin-top:40px;">
								<div id="dashboardLeadsTablaDesglose" class="chart" style="width:100%">
									<div class="col-sm-12" style="display:none">
										<div class="time_control" id="control_div_analisis_leads_tabla_desglose"></div>
									</div>
									<div class="row">
										<div class="col-sm-12">
											<button  id="btn_table_div_analisis_leads_desglose" class="btn btn-success botonSeccion" type="button" name="button" data-toggle="collapse" data-target="#table_div_analisis_leads_desglose" aria-expanded="false" aria-controls="table_div_analisis_leads_desglose">HISTÓRICO DE LEADS</button>
											<div  class="collapse" id="table_div_analisis_leads_desglose"></div>
										</div>
									</div>
								</div>

							</div>

						</div>




<?php require(RUTA_APP . '/views/includes/footer2.php'); ?>
