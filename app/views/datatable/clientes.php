<?php require(RUTA_APP . '/views/includes/header2.php'); ?>

<!-- EMPIEZA BREADCRUMB -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Clientes</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a
                                href="<?php echo RUTA_URL ?>/analisis/analisisClientes">Inicio</a></li>
                        <li class="breadcrumb-item active">Clientes</li>
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
                                    style="margin-bottom:10px; border:solid 0.5px lightgrey; text-align:center; margin:0 auto">
                                    <i class="fa fa-eye-slash fa-1x"></i> / <i class="fa fa-eye fa-1x"></i>
                                    <a class="toggle-viss btn" data-column="1">Nombre</a> -
                                    <a class="toggle-viss btn" data-column="2">FechaAlta</a> -
                                    <a class="toggle-viss btn" data-column="3">Poblacion</a> -
                                    <a class="toggle-viss btn" data-column="4">Provincia</a> -
                                    <a class="toggle-viss btn" data-column="5">Telefono</a> -
                                    <a class="toggle-viss btn" data-column="6">Email</a> - -
                                    <a class="toggle-vis btn roj" style="color:red" data-column="7">Direccion</a> -
                                    <a class="toggle-vis btn roj" style="color:red" data-column="8">Cif</a> -
                                    <a class="toggle-vis btn roj" style="color:red" data-column="9">C.Postal</a> -
                                    <a class="toggle-vis btn roj" style="color:red" data-column="10">Contacto</a> -
                                    <a class="toggle-vis btn roj" style="color:red" data-column="11">C.Bancaria</a>-
                                    <a class="toggle-vis btn roj" style="color:red" data-column="12">Facturado</a> -
                                    <a class="toggle-vis btn roj" style="color:red" data-column="13">Objetivo</a>
                                    <a class="toggle-vis btn roj" style="color:red" data-column="14">T.Cliente</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center" style="margin-top:5px">
                        <a href="#modalAdd" class="btn  modalAddBtn" data-toggle="modal"
                            style="margin-bottom:20px; background-color:#001f3f; color:#fff;"><span class="fa fa-plus"></span></a>
               </div>
                        <div class="table-responsive ">
                            <table id="table_clientes" class="table table-striped table-bordered shadow" style="width:100%">
                                <thead style="background-color:#001f3f; color:#fff;">
                                    <tr>
                                        <th>Id</th>
                                        <th>Nombre</th>
                                        <th>FechAlta</th>
                                        <th>Poblacion</th>
                                        <th>Provincia</th>
                                        <th>Telefono</th>
                                        <th>Email</th>
                                        <th>Direccion</th>
                                        <th>Cif</th>
                                        <th>C.Postal</th>
                                        <th>Contacto</th>
                                        <th>C.Bancaria</th>
                                        <th>Facturado</th>
                                        <th>Objetivo</th>
                                        <th>T.Cliente</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ==================== Empieza la ventana modal para añadir un registro nuevo =========================== -->
            <div class="modal fade bd-example-modal-lg" style="font-size:12px;  box-shadow: 0 0 15px rgba(0, 1, 0, 1);" id="modalAdd" tabindex="-1" role="dialog"
                aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-info">                          
                            <div class="row" style="width:100%">
								<div class="col-sm-12">
									<center><h4 class="modal-title" id="myModalLabel" style = "font-family:Arial">AGREGAR CLIENTE</h4></center>
								</div>
							</div>                       
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="POST" action="Clientes/agregarCliente">
                            <div class="modal-body">
                                <div class="row form-group">
                                    <div class="col-sm-2">
                                        <label class="control-label" style="position:relative; top:7px;">Tipo
                                            Cliente:</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <select type="text" id="selectEstado" class="form-control form-control-sm" name="estado">
                                        </select>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-sm-2">
                                        <label class="control-label"
                                            style="position:relative; top:7px;">Denominacion:</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control form-control-sm" name="denominacion">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-sm-2">
                                        <label class="control-label"
                                            style="position:relative; top:7px;">Direccion:</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control form-control-sm" name="direccion">
                                    </div>
                                </div><hr>
                                <div class="row form-group">
                                    <div class="col-sm-2">
                                        <label class="control-label" style="position:relative; top:7px;">Cif:</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control form-control-sm" name="cif">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-sm-2">
                                        <label class="control-label" style="position:relative; top:7px;">Fecha
                                            Alta:</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control form-control-sm" name="fechaAlta">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-sm-2">
                                        <label class="control-label"
                                            style="position:relative; top:7px;">Poblacion:</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control form-control-sm" name="poblacion">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-sm-2">
                                        <label class="control-label"
                                            style="position:relative; top:7px;">Provincia:</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control form-control-sm" name="provincia">
                                    </div>
                                </div><hr>
                                <div class="row form-group">
                                    <div class="col-sm-2">
                                        <label class="control-label" style="position:relative; top:7px;">Codigo
                                            Postal:</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control form-control-sm" name="codigoPostal">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-sm-2">
                                        <label class="control-label"
                                            style="position:relative; top:7px;">Telefono:</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control form-control-sm" name="telefono">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-sm-2">
                                        <label class="control-label"
                                            style="position:relative; top:7px;">Contacto:</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control form-control-sm" name="contacto">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-sm-2">
                                        <label class="control-label" style="position:relative; top:7px;">Email:</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control form-control-sm" name="email">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-sm-2">
                                        <label class="control-label" style="position:relative; top:7px;">Cuenta
                                            Bancaria:</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control form-control-sm" name="cuentaBancaria">
                                    </div>
                                </div><hr >
                                <div class="row form-group">
                                    <div class="col-sm-2">
                                        <label class="control-label"
                                            style="position:relative; top:7px;">Facturado:</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control form-control-sm" name="facturado">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-sm-2">
                                        <label class="control-label"
                                            style="position:relative; top:7px;">Objetivo:</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control form-control-sm" name="objetivo">
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer justify-content-center">
                                <button type="button" class="btn btn-outline-info waves-effect btn-xl" data-dismiss="modal">
                                    Cancelar</button>
                                <button type="submit" name="add" class="btn btn-success waves-effect btn-xl">Añadir
                           </button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- ==================== Termina la ventana modal para añadir un registro nuevo =========================== -->

            <!-- ==================== Empieza la ventana modal para editar un registro =========================== -->
            <div class="modal fade  bd-example-modal-lg" style="font-size:12px" id="ModalEdit" role="dialog" aria-labelledby="myModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-info">
                        <div class="row" style="width:100%">
								<div class="col-sm-12">
									<center><h4 class="modal-title" id="myModalLabel" style = "font-family:Arial">EDITAR CLIENTE</h4></center>
								</div>
							</div>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <form method="POST" action="Clientes/actualizarCliente">
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <input type="hidden" name="id">
                                    <div class="row form-group">
                                        <div class="col-sm-5">
                                            <label class="control-label" style="position:relative; top:7px;">Tipo
                                                Cliente:</label>
                                        </div>
                                        <div class="col-sm-7">
                                            <select type="text" id="selectEstadoEdit" class="form-control"
                                                name="idEstado">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-sm-5">
                                            <label class="control-label"
                                                style="position:relative; top:7px;">Denominacion:</label>
                                        </div>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control form-control-sm" name="denominacion">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-sm-5">
                                            <label class="control-label"
                                                style="position:relative; top:7px;">Direccion:</label>
                                        </div>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control form-control-sm" name="direccion">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-sm-5">
                                            <label class="control-label"
                                                style="position:relative; top:7px;">Cif:</label>
                                        </div>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control form-control-sm" name="cif">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-sm-5">
                                            <label class="control-label" style="position:relative; top:7px;">Fecha
                                                Alta:</label>
                                        </div>
                                        <div class="col-sm-7">
                                            <input type="date" class="form-control form-control-sm" name="fechaAlta">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-sm-5">
                                            <label class="control-label"
                                                style="position:relative; top:7px;">Poblacion:</label>
                                        </div>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control form-control-sm" name="poblacion">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-sm-5">
                                            <label class="control-label"
                                                style="position:relative; top:7px;">Provincia:</label>
                                        </div>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control form-control-sm" name="provincia">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-sm-5">
                                            <label class="control-label" style="position:relative; top:7px;">Codigo
                                                Postal:</label>
                                        </div>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control form-control-sm" name="codigoPostal">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-sm-5">
                                            <label class="control-label"
                                                style="position:relative; top:7px;">Telefono:</label>
                                        </div>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control form-control-sm" name="telefono">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-sm-5">
                                            <label class="control-label"
                                                style="position:relative; top:7px;">Contacto:</label>
                                        </div>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control form-control-sm" name="contacto">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-sm-5">
                                            <label class="control-label"
                                                style="position:relative; top:7px;">Email:</label>
                                        </div>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control form-control-sm" name="email">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-sm-5">
                                            <label class="control-label" style="position:relative; top:7px;">Cuenta
                                                Bancaria:</label>
                                        </div>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control form-control-sm" name="cuentaBancaria">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-sm-5">
                                            <label class="control-label"
                                                style="position:relative; top:7px;">Facturado:</label>
                                        </div>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control form-control-sm" name="facturado">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-sm-5">
                                            <label class="control-label"
                                                style="position:relative; top:7px;">Objetivo:</label>
                                        </div>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control form-control-sm" name="objetivo">
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="modal-footer justify-content-center">
                                <button type="button" class="btn btn-outline-secondary waves-effect btn-xl" data-dismiss="modal">
                                    Cancelar</button>
                                <button type="submit" name="edit" class="btn btn-primary">
                                    Actualizar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- ==================== Termina la ventana modal para editar un registro =========================== -->
            <!-- ==================== Empieza la ventana modal para eliminar un registro =========================== -->
            <div class="modal fade" style="font-size:12ps" id="ModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-danger">
                        <div class="row" style="width:100%">
								<div class="col-sm-12">
									<center><h4 class="modal-title" id="myModalLabel" style = "font-family:Arial">ELIMINAR CLIENTE</h4></center>
								</div>
							</div>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <form method="POST" action="Clientes/borrarCliente">
                            <input type="hidden" name="id">
                            <div class="modal-body">
                                <p class="text-center">¿Estas seguro en borrar los datos de?</p>
                                <h2 class="text-center"><input type="text" class="form-control" name="denominacion"
                                        style="width:auto; margin: 0 auto; text-align:center" disabled></h2>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal"><span
                                        class="fa fa-close"></span></button>
                                <button type="submit" name="delete" class="btn btn-danger"><span
                                        class="fa fa-trash"></span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>





            <?php require(RUTA_APP . '/views/includes/footer2.php'); ?>