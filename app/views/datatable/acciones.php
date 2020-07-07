<?php require(RUTA_APP . '/views/includes/header2.php'); ?>

<!-- EMPIEZA BREADCRUMB -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Acciones</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a
                                href="<?php echo RUTA_URL ?>/analisis/analisisClientes">Inicio</a></li>
                        <li class="breadcrumb-item active">Acciones</li>
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

            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="box">
                            <div class="box-header">
                                <div class="col-lg-10"
                                    style="margin-bottom:10px; border:solid 0.5px lightgrey; text-align:center; margin: 0 auto">
                                    <i class="fa fa-eye-slash fa-1x"></i> / <i class="fa fa-eye fa-1x"></i>
                                    <a class="toggle-vis btn" data-column="5">Usuario</a> -
                                    <a class="toggle-vis btn" data-column="6">Cliente</a> -
                                    <a class="toggle-vis btn" data-column="7">T.Cliente</a>-
                                    <a class="toggle-vis btn" data-column="8">Tipo</a> -
                                    <a class="toggle-vis btn" data-column="9">Estado</a> -
                                    <a class="toggle-vis btn" data-column="10">Accion</a> -
                                    <a class="toggle-vis btn" data-column="11">Creado</a> -
                                    <a class="toggle-vis btn" data-column="12">Inicio</a> -
                                    <a class="toggle-vis btn" data-column="13">Fin</a>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <a href="#ModalAdd" class="modalAddBtn btn btn-primary" data-toggle="modal"
                            style="margin-bottom:20px;"><span class="fa fa-plus"></span></a>
                        <div class="table-responsive">
                            <table id="table_acciones" class="table table-striped table-bordered" style="width:100%">
                                <thead style="background-color:#001f3f; color:#fff;">
                                    <tr>
                                        <th>ID</th>
                                        <th>idUsuario</th>
                                        <th>idCliente</th>
                                        <th>idTipoAccion</th>
                                        <th>idEstadoAccion</th>
                                        <th>Usuario</th>
                                        <th>Cliente</th>
                                        <th>T.Cliente</th>
                                        <th>Tipo</th>
                                        <th>Estado</th>
                                        <th>Accion</th>
                                        <th>Creada</th>
                                        <th>Inicio</th>
                                        <th>Fin</th>                       
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- ==================== Empieza la ventana modal para añadir un registro nuevo =========================== -->
                <div class="modal fade bd-example-modal-lg" id="ModalAdd" tabindex="-1" role="dialog"
                    aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-info">
                                <center>
                                    <h4 class="modal-title" id="myModalLabel">Agregar Acción</h4>
                                </center>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form method="POST" action="Acciones/agregarAccion">
                                <div class="modal-body">
                                    <div class="row form-group">
                                        <div class="col-sm-5">
                                            <label class="control-label"
                                                style="position:relative; top:7px;">Usuario:</label>
                                        </div>
                                        <div class="col-sm-7">
                                            <select type="text" class="form-control" name="idUsuario"
                                                id="selectUsuario">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-sm-5">
                                            <label class="control-label"
                                                style="position:relative; top:7px;">Cliente:</label>
                                        </div>
                                        <div class="col-sm-7">
                                            <select type="text" class="form-control" name="idCliente"
                                                id="selectCliente">
                                                <option value="">Ninguno</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-sm-5">
                                            <label class="control-label" style="position:relative; top:7px;">Tipo
                                                Accion:</label>
                                        </div>
                                        <div class="col-sm-7">
                                            <select type="text" class="form-control" name="idTipoAccion"
                                                id="selectTipoAccion">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-sm-5">
                                            <label class="control-label" style="position:relative; top:7px;">Estado
                                                Accion:</label>
                                        </div>
                                        <div class="col-sm-7">
                                            <select type="text" class="form-control" name="idEstadoAccion"
                                                id="selectEstadoAccion">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-sm-5">
                                            <label class="control-label"
                                                style="position:relative; top:7px;">Descripción:</label>
                                        </div>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" name="accion">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-sm-5">
                                            <label class="control-label"
                                                style="position:relative; top:7px;">Desde:</label>
                                        </div>
                                        <div class="col-sm-7">
                                            <input type="datetime-local" class="form-control" name="start">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-sm-5">
                                            <label class="control-label"
                                                style="position:relative; top:7px;">Hasta:</label>
                                        </div>
                                        <div class="col-sm-7">
                                            <input type="datetime-local" class="form-control" name="end">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal"><span
                                            class="fa fa-close"></span> Cancelar</button>
                                    <button type="submit" name="add" class="btn btn-primary"><span
                                            class="fa fa-save"></span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- ==================== Termina la ventana modal para añadir un registro nuevo =========================== -->

                <!-- ==================== Empieza la ventana modal para editar un registro =========================== -->
                <div class="modal fade  bd-example-modal-lg" id="ModalEdit" role="dialog" aria-labelledby="myModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header bg-info">
                                <center>
                                    <h4 class="modal-title" id="myModalLabel">Editar Acción</h4>
                                </center>
                                <button type="button" class="close" data-dismiss="modal"
                                    aria-hidden="true">&times;</button>
                            </div>
                            <form method="POST" action="Acciones/actualizarAccion">
                                <div class="modal-body">
                                    <div class="container-fluid">
                                        <input type="hidden" name="id">
                                        <div class="row form-group">
                                            <div class="col-sm-5">
                                                <label class="control-label"
                                                    style="position:relative; top:7px;">Usuario:</label>
                                            </div>
                                            <div class="col-sm-7">
                                                <select type="text" class="form-control" name="idUsuario"
                                                    id="selectUsuarioEdit">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-sm-5">
                                                <label class="control-label"
                                                    style="position:relative; top:7px;">Cliente:</label>
                                            </div>
                                            <div class="col-sm-7">
                                                <select type="text" class="form-control" name="idCliente"
                                                    id="selectClienteEdit">
                                                    <option value="">Ninguno</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-sm-5">
                                                <label class="control-label" style="position:relative; top:7px;">Tipo
                                                    Accion:</label>
                                            </div>
                                            <div class="col-sm-7">
                                                <select type="text" class="form-control" name="idTipoAccion"
                                                    id="selectTipoAccionEdit">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-sm-5">
                                                <label class="control-label" style="position:relative; top:7px;">Estado
                                                    Accion:</label>
                                            </div>
                                            <div class="col-sm-7">
                                                <select type="text" class="form-control" name="idEstadoAccion"
                                                    id="selectEstadoAccionEdit">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-sm-5">
                                                <label class="control-label"
                                                    style="position:relative; top:7px;">Descripción:</label>
                                            </div>
                                            <div class="col-sm-7">
                                                <input type="text" class="form-control" name="accion">
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-sm-5">
                                                <label class="control-label"
                                                    style="position:relative; top:7px;">fecha:</label>
                                            </div>
                                            <div class="col-sm-7">
                                                <input type="date" class="form-control" name="created">
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-sm-5">
                                                <label class="control-label"
                                                    style="position:relative; top:7px;">inicio:</label>
                                            </div>
                                            <div class="col-sm-7">
                                                <input type="datetime-local" class="form-control" name="start">
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-sm-5">
                                                <label class="control-label"
                                                    style="position:relative; top:7px;">Fin:</label>
                                            </div>
                                            <div class="col-sm-7">
                                                <input type="datetime-local" class="form-control" name="end">
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-sm-5">
                                                <label class="control-label"
                                                    style="position:relative; top:7px;">Terminado:</label>
                                            </div>
                                            <div class="col-sm-7">
                                                <input type="datetime-local" class="form-control" name="done">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal"><span
                                            class="fa fa-close"></span> Cancelar</button>
                                    <button type="submit" name="edit" class="btn btn-primary"><span
                                            class="fa fa-check"></span> Actualizar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- ==================== Termina la ventana modal para editar un registro =========================== -->
                <!-- ==================== Empieza la ventana modal para eliminar un registro =========================== -->
                <div class="modal fade" id="ModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-danger">
                                <center>
                                    <h4 class="modal-title" id="myModalLabel">Borrar Acción</h4>
                                </center>
                                <button type="button" class="close" data-dismiss="modal"
                                    aria-hidden="true">&times;</button>
                            </div>
                            <form method="POST" action="Acciones/borrarAccion">
                                <input type="hidden" id="id" name="id">
                                <div class="modal-body">
                                    <p class="text-center">¿Estas seguro en borrar los datos de?</p>
                                    <h2 class="text-center"><input type="text" class="form-control" name="accion"
                                            style="width:auto; margin: 0 auto; text-align:center" disabled></h2>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal"><span
                                            class="fa fa-close"></span></button>
                                    <button type="submit" name="delete" class="btn btn-danger"><span
                                            class="fa fa-trash"></span></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


                <?php require(RUTA_APP . '/views/includes/footer2.php'); ?>