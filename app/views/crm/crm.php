<?php require(RUTA_APP . '/views/includes/header2.php'); ?>

<!-- EMPIEZA BREADCRUMB -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Agenda</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a
                                href="<?php echo RUTA_URL ?>/analisis/analisisClientes">Inicio</a></li>
                        <li class="breadcrumb-item active">Agenda</li>
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
            <!-- add calander in this div -->
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box bg-red">
                            <span class="info-box-icon"><i class="fas fa-exclamation-circle"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Pendientes</span>
                                <span class="info-box-number"
                                    id="tgPendientes"><?php echo $datos['pendientes'];  ?></span>
                                <div class="progress">
                                    <div class="progress-bar" id="tgWpendientes"
                                        style="width: <?php echo $datos['penPorcentaje'];  ?>%"></div>
                                </div>
                                <span class="progress-description"
                                    id="tgPenPorcentaje"><?php echo $datos['penPorcentaje'];  ?>% del total</span>
                            </div><!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box bg-yellow">
                            <span class="info-box-icon"><i class="fas fa-hourglass-half"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">En Proceso</span>
                                <span class="info-box-number" id="tgProceso"><?php echo $datos['proceso'];  ?></span>
                                <div class="progress">
                                    <div class="progress-bar" id="tgWproceso"
                                        style="width: <?php echo $datos['proPorcentaje'];  ?>%"></div>
                                </div>
                                <span class="progress-description"
                                    id="tgProPorcentaje"><?php echo $datos['proPorcentaje'];  ?>% del total</span>
                            </div><!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box bg-green">
                            <span class="info-box-icon"><i class="fa fa-thumbs-o-up"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Finalizadas</span>
                                <span class="info-box-number"
                                    id="tgFinalizadas"><?php echo $datos['finalizadas'];  ?></span>
                                <div class="progress">
                                    <div class="progress-bar" id="tgWfinalizadas"
                                        style="width: <?php echo $datos['finPorcentaje'];  ?>%"></div>
                                </div>
                                <span class="progress-description" id="tgFinPorcentaje">
                                    <?php echo $datos['finPorcentaje'];  ?>% del total
                                </span>
                            </div><!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box bg-blue">
                            <span class="info-box-icon"><i class="fa fa-bookmark-o"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Hoy</span>
                                <span class="info-box-number" id="tgHoy"><?php echo $datos['hoy'];  ?></span>
                                <div class="progress">
                                    <div class="progress-bar" id="tgWhoy"
                                        style="width: <?php echo $datos['hoyPorcentaje'];  ?>%"></div>
                                </div>
                                <span class="progress-description" id="tgHoyPorcentaje">
                                    <?php echo round(((($datos['hoy']*100)+1)/$datos['total']),0);  ?>% del total
                                </span>
                            </div><!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>

                    <!-- /.col -->
                </div>
        

                <div class="row">
                    <div class=" col-sm-12 col-xl-2 ">
                        <div class="panel panel-info " >
                            <div class="panel-heading">
                                <h3 class="panel-title">Filtros</h3>
                            </div>
                            <div class="panel-body" id="filtros">
                                <div class="control-group">
                                    <label class="control-label" for="">Usuario:</label>
                                    <div class="field desc">
                                        <select id="filtroUsuario"
                                            class="form-control form-control-sm select2 select_accion"
                                            name="filtroUsuario[]" style="width:100%" multiple="multiple">
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="">Tipo Cliente:</label>
                                    <div class="field desc" >
                                        <select id="filtroTipoCliente"
                                            class="form-control form-control-sm select2 select_accion"
                                            name="filtroTipoCliente[]" style="width:100%" multiple="multiple">
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="">Tipo Tarea:</label>
                                    <div class="field desc"  >
                                        <select id="filtroTipoAccion"
                                            class="form-control form-control-sm select2 select_accion"
                                            name="filtroTipoAccion[]" style="width:100%" multiple="multiple">
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="">Estado Tarea:</label>
                                    <div class="field desc" >
                                        <select id="filtroEstadoAccion"
                                            class="form-control form-control-sm select2 select_accion"
                                            name="filtroEstadoAccion[]"style="width:100%" multiple="multiple">
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- </div> -->
                    <!-- </div> -->
                    <div class="col-sm-12 col-xl-10 ">
                        <input type="hidden" id="cambioPersona" value="">
                        <div id="calendar"></div>
                    </div>

                    <!-- /.col -->
                </div>


                <!-- Modal  to Add Event -->
                <div class="modal fade shadow-lg p-3 mb-5  rounded" style="font-size:12px" id="createEventModal">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header bg-success" style="margin-top:5px !important; background-color:#DDDDDD">
                                <h4 class="modal-title" style="margin-top:5px !important;font-family:Arial;">AÑADIR EVENTO</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="control-group">
                                            <label class="control-label" for="inputPatient">Cliente:</label>
                                            <div class="field desc">
                                                <select id="idCliente" class="form-control form-control-sm" name="idCliente" required >

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="control-group">
                                            <label class="control-label" for="inputPatient">Tipo Accion:</label>
                                            <div class="field desc">
                                                <select id="idTipoAccion" class="form-control form-control-sm"
                                                    name="idTipoAccion">

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="control-group">
                                            <label class="control-label" for="inputPatient">Accion:</label>
                                            <div class="field desc">
                                                <input class="form-control form-control-sm" id="accion" name="accion"
                                                    placeholder="Evento" type="text" autocomplete="off" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="control-group">
                                            <label class="control-label" for="inputPatient">Estado:</label>
                                            <div class="field desc">
                                                <select id="idEstadoAccion" class="form-control form-control-sm"
                                                    name="idEstadoAccion">

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-md-3">
                                            <label class="control-label"
                                                style="position:relative; top:7px">Inicio:</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="date"  id="startDate"
                                                class="form-control form-control-sm " />
                                        </div>
                                        <div class="col-md-4">
                                            <input type="time"  id="startTime"
                                                class="form-control form-control-sm" />
                                        </div>
                                        <div class="col-md-3">
                                            <label class="control-label" style="position:relative; top:7px">Fin:</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="date"  id="endDate"
                                                class="form-control form-control-sm" />
                                        </div>
                                        <div class="col-md-4">
                                            <input type="time"  id="endTime"
                                                class="form-control form-control-sm " />
                                        </div>
                                    </div>
                                </div>
        

                            </div>
                            <div class="modal-footer justify-content-center">
                                <div class="row">
                
                                    <div class="col-sm-6">
                                        <button type="submit" class="btn btn-outline-success waves-effect " id="submitButton"
                                            title="Añadir evento">Añadir</button>
                                    </div>
                                    <div class="col-sm-6">
                                        <button class="btn btn-outline-secondary btn-radius waves-effect " data-dismiss="modal" title="Cerrar Modal">Cancelar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>

                    <!-- /.modal-dialog -->
                </div>
            
                <!-- /.modal -->
                <!-- Modal  to EDIT AND DELETE Event -->
                <div class="modal fade shadow-sm p-3 mb-5  rounded" id="calendarModal" style="font-size:12px">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header bg-info" style="margin-top:5px !important;">
                                <h4 class="modal-title" style="margin-top:5px !important;font-family:Arial;">Detalle Evento</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="control-group">
                                            <label class="control-label" for="inputPatient">Cliente:</label>
                                            <div class="field desc">
                                                <select id="idClienteEdit" class="form-control form-control-sm" name="idCliente"
                                                    required>

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="control-group">
                                            <label class="control-label" for="inputPatient">Tipo Accion:</label>
                                            <div class="field desc">
                                                <select id="idTipoAccionEdit" class="form-control form-control-sm"
                                                    name="idTipoAccion" required>

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="control-group">
                                            <label class="control-label" for="inputPatient">Accion:</label>
                                            <div class="field desc">
                                                <input class="form-control form-control-sm" id="accionEdit" name="accion"
                                                    placeholder="Evento" type="text" autocomplete="off" value="" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="control-group">
                                            <label class="control-label" for="inputPatient">Estado:</label>
                                            <div class="field desc">
                                                <select id="idEstadoAccionEdit" class="form-control form-control-sm"
                                                    name="idEstadoAccion" required>

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="control-group">
                                            <label class="control-label" for="inputPatient">Usuario:</label>
                                            <div class="field desc">
                                            <select id="idUsuarioEdit" class="form-control form-control-sm"
                                                    name="idUsuario" <?php if($_SESSION['rol'] > 1){ echo 'disabled';}?> required>
                                              
                                               </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-md-3">
                                            <label class="control-label"
                                                style="position:relative; top:7px">Inicio:</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" onfocus = "(this.type = 'date')"  id="startDateEdit"
                                                class="form-control form-control-sm " />
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" onfocus = "(this.type = 'time')" id="startTimeEdit"
                                                class="form-control form-control-sm" />
                                        </div>
                                        
                                        <div class="col-md-3">
                                            <label class="control-label" style="position:relative; top:7px">Fin:</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" onfocus = "(this.type = 'date')" id="endDateEdit"
                                                class="form-control form-control-sm " />
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" onfocus = "(this.type = 'time')" id="endTimeEdit"
                                                class="form-control form-control-sm " />
                                        </div>
                                    </div>
                                
                                </div>
                 
                                <div class="row">
                                    <div class="col-8 col-md-11 text-center">
                                        <div class="control-group">
                                            <label class="control-label" for="modalWhen">FlashBack:</label>
                                            <input type="text" id="flashBack" class="form-control" name="flashBack"
                                                placeholder="Informa de tu impresión con el cliente" required>
                                        </div>
                                    </div>
                                    <div class="col-4 col-md-1 text-center">
                                        <br>
                                        <a class="btn btn-sm btn-success" id="addMensaje"><i class="fa fa-plus"></i></a>
                                    </div>
                                </div> 

                                <input type="hidden" id="evento" />

                            </div>
                            <div class="modal-footer justify-content-center">
                                <div class="row text-center justify-content-center">
                                    <!--div class="col-4 col-md-3">
						<button class="btn btn-info" data-dismiss="modal" data-dismiss="modal">Ficha Cliente</button>
					</div-->
                                    <div class="col-3 col-md-3 justify-center">
                                        <button class="btn btn-info historico btn-md " id="historico" title="Histórico">
                                            Historico</button>
                                    </div>
                                    <div class="col-3 col-md-3 justify-content-center">
                                        <button type="submit" class="btn btn-outline-success btn-md" id="updateButton"
                                            title="Modificar">Editar</button>
                                    </div>
                                    <div class="col-3 col-md-3 justify-content-center">
                                        <button type="submit" class="btn btn-outline-danger btn-md" id="deleteButton"
                                            title="Eliminar Tarea">Eliminar</button>
                                    </div>
                                    <div class="col-3 col-md-3 justify-content-center">
                                        <button class="btn btn-danger btn-md" data-dismiss="modal" data-dismiss="modal"
                                            title="Cerrar Modal">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
                <!-- TIME LINE -->
                <div class="modal fade" id="timeLine">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header" style="margin-top:5px !important;">
                                <h4 class="modal-title" style="margin-top:5px !important;font-family:Arial; font-size:15px">Historico de cambios</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div id="modalBody" class="modal-body">
                                <!-- The timeline -->
                                <div class="timeline timeline-inverse" id="timeLineBody">

                                </div>
                            </div>
                            <div class="modal-footer justify-content-center" style="margin:2px !important;">
                                <button class="btn btn-danger" data-dismiss="modal" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
        </div>
    </div>
</div>
<?php require(RUTA_APP . '/views/includes/footer2.php'); ?>